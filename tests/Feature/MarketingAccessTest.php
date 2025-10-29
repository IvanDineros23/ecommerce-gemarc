<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class MarketingAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_marketing_employee_cannot_access_marketing_pages()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $user = User::factory()->create(['role' => 'employee', 'department' => 'sales']);
        $this->actingAs($user)->get('/employee/marketing/faqs')->assertStatus(403);
    }

    public function test_marketing_employee_can_access_marketing_pages()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $user = User::factory()->create(['role' => 'employee', 'department' => 'marketing']);
        $this->actingAs($user)->get('/employee/marketing/faqs')->assertStatus(200);
    }
}
