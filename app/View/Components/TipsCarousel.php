<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Tip;

class TipsCarousel extends Component
{
    public function render()
    {
        $activeTips = Tip::where('is_active', true)
                         ->orderBy('sort_order')
                         ->get();
        
        return view('components.tips-carousel', [
            'tips' => $activeTips
        ]);
    }
}