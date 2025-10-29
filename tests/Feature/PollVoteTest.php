<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;

class PollVoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_vote_once()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $user = User::factory()->create();
        $poll = Poll::create(['question' => 'Test poll', 'is_active' => 1]);
        $opt = PollOption::create(['poll_id' => $poll->id, 'text' => 'One']);

        $this->actingAs($user)->postJson('/polls/'.$poll->id.'/vote', ['option_id' => $opt->id])
            ->assertStatus(200)->assertJson(['success' => true]);

        // second vote should fail
        $this->actingAs($user)->postJson('/polls/'.$poll->id.'/vote', ['option_id' => $opt->id])
            ->assertStatus(422);

        $this->assertDatabaseHas('poll_votes', ['poll_id' => $poll->id, 'user_id' => $user->id]);
    }

    public function test_guest_vote_is_limited_by_ip()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $poll = Poll::create(['question' => 'Guest poll', 'is_active' => 1]);
        $opt = PollOption::create(['poll_id' => $poll->id, 'text' => 'One']);

        $this->postJson('/polls/'.$poll->id.'/vote', ['option_id' => $opt->id], ['REMOTE_ADDR' => '123.123.123.1'])
            ->assertStatus(200)->assertJson(['success' => true]);

        // second guest vote from same IP should fail
        $this->postJson('/polls/'.$poll->id.'/vote', ['option_id' => $opt->id], ['REMOTE_ADDR' => '123.123.123.1'])
            ->assertStatus(422);

        $this->assertDatabaseCount('poll_votes', 1);
    }
}
