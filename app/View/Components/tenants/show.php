<?php

namespace App\View\Components\tenants;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class show extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public User $selectedTenant, public string $status, public $paymentHistory)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenants.show');
    }
}
