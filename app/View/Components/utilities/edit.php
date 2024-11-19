<?php

namespace App\View\Components\utilities;

use App\Models\Utility;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class edit extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Utility $selectedUtility)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utilities.edit');
    }
}