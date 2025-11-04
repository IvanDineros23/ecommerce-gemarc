<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tip;
use Illuminate\Http\JsonResponse;

class TipsController extends Controller
{
    public function index(): JsonResponse
    {
        $tips = Tip::where('is_active', 1)
                   ->orderBy('sort_order')
                   ->select(['id', 'title', 'content', 'sort_order'])
                   ->get();
        
        return response()->json($tips);
    }
}