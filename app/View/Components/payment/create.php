<?php

namespace App\View\Components\payment;

use App\Models\Contract;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class create extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Contract $contract)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.payment.create');
    }
}
