<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Unit;

class Units extends Component
{

    use WithPagination;

    public $page = 1;

    public function render()
    {
        return view('livewire.units', [
            'units' => Unit::orderBy('id', 'asc')
                          ->paginate(9)
                          ->onEachSide(1), // Optional: to adjust page links before and after the current page
        ]);
    }

}
