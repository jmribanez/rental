<?php

namespace App\View\Components\property;

use App\Models\Property;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class showcard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Property $property)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.property.showcard');
    }
}
