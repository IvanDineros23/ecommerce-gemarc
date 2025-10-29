<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Support\Facades\DB;

class PollController extends Controller
{
    // Publicly list active polls with options and aggregated vote counts
    public function index()
    {
        $polls = Poll::where('is_active', true)->orderBy('sort_order')->with('options')->get();
        return response()->json($polls);
    }

    // Vote on a poll option (auth required)
    public function vote(Request $request, Poll $poll)
    {
        $request->validate(['option_id' => 'required|integer|exists:poll_options,id']);
        $option = PollOption::where('poll_id', $poll->id)->where('id', $request->option_id)->firstOrFail();

        // prevent duplicate votes:
        // - if user is authenticated: one vote per user per poll
        // - if guest: one vote per IP per poll
        $user = $request->user();
        $ip = $request->ip();

        if ($user) {
            $already = PollVote::where('poll_id', $poll->id)->where('user_id', $user->id)->exists();
            if ($already) {
                return response()->json(['success' => false, 'message' => 'You have already voted on this poll.'], 422);
            }
        } else {
            // allow guest voting but prevent duplicate by IP
            $alreadyIp = PollVote::where('poll_id', $poll->id)->where('ip_address', $ip)->exists();
            if ($alreadyIp) {
                return response()->json(['success' => false, 'message' => 'A vote from this device/network has already been recorded.'], 422);
            }
        }

        DB::transaction(function () use ($option, $poll, $user, $request, $ip) {
            // record vote
            PollVote::create([
                'poll_id' => $poll->id,
                'option_id' => $option->id,
                'user_id' => $user ? $user->id : null,
                'ip_address' => $ip,
            ]);

            // increment counter
            $option->increment('votes_count');
        });

        return response()->json(['success' => true, 'message' => 'Thank you for voting']);
    }

    // Marketing-only aggregated results
    public function results()
    {
        $polls = Poll::with('options')->orderBy('sort_order')->get()->map(function ($p) {
            $total = $p->options->sum('votes_count');
            return [
                'id' => $p->id,
                'title' => $p->title,
                'question' => $p->question,
                'total_votes' => $total,
                'options' => $p->options->map(function ($o) use ($total) {
                    return [
                        'id' => $o->id,
                        'text' => $o->text,
                        'votes' => $o->votes_count,
                        'pct' => $total ? round(($o->votes_count / $total) * 100, 1) : 0,
                    ];
                }),
            ];
        });

        return response()->json($polls);
    }
}
