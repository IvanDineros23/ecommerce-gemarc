<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\PollOption;

class MarketingPollController extends Controller
{
    public function __construct()
    {
    $this->middleware(['auth', 'verified', \App\Http\Middleware\EnsureEmployee::class, \App\Http\Middleware\EnsureDepartment::class . ':marketing']);
    }

    public function index()
    {
        $polls = Poll::with('options')->orderBy('sort_order')->get();
        return view('employee.marketing_polls', compact('polls'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'question' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);
        $poll = Poll::create([
            'title' => $data['title'] ?? null,
            'question' => $data['question'],
            'is_active' => $request->has('is_active') ? (bool)$request->is_active : true,
        ]);
        // options: accept array or newline-separated string
        $optionsInput = $request->input('options');
        $options = [];
        if (is_array($optionsInput)) {
            $options = $optionsInput;
        } elseif (is_string($optionsInput)) {
            // accept single textarea where lines are options
            $lines = preg_split('/\r?\n/', $optionsInput);
            $options = array_map('trim', $lines);
        }

        foreach ($options as $opt) {
            if (is_string($opt) && trim($opt) !== '') {
                PollOption::create(['poll_id' => $poll->id, 'text' => $opt]);
            }
        }
        return back()->with('success', 'Poll created');
    }

    public function update(Request $request, Poll $poll)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'question' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);
        $poll->update(['title' => $data['title'] ?? null, 'question' => $data['question'], 'is_active' => $request->has('is_active') ? (bool)$request->is_active : true]);
        return back()->with('success', 'Poll updated');
    }

    public function destroy(Poll $poll)
    {
        $poll->delete();
        return back()->with('success', 'Poll removed');
    }

    // Add or update options
    public function addOption(Request $request, Poll $poll)
    {
        $data = $request->validate(['text' => 'required|string']);
        $option = PollOption::create(['poll_id' => $poll->id, 'text' => $data['text']]);
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'option' => $option]);
        }
        return back()->with('success', 'Option added');
    }

    public function removeOption(Poll $poll, PollOption $option)
    {
        $option->delete();
        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Option removed');
    }

    // rename an option (AJAX)
    public function updateOption(Request $request, Poll $poll, PollOption $option)
    {
        $this->authorize('update', $poll);
        $data = $request->validate(['text' => 'required|string']);
        $option->update(['text' => $data['text']]);
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'option' => $option]);
        }
        return back()->with('success', 'Option updated');
    }

    // reorder options: accept array of option ids in new order
    public function reorderOptions(Request $request, Poll $poll)
    {
        $data = $request->validate(['order' => 'required|array']);
        $order = $data['order'];
        foreach ($order as $i => $id) {
            PollOption::where('poll_id', $poll->id)->where('id', $id)->update(['updated_at' => now()]);
            // not using a specific sort column; could add 'sort_order' if needed
        }
        return response()->json(['success' => true]);
    }
}
