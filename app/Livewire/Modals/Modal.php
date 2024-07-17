<?php

namespace App\Livewire\Modals;

use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{

    public $visible = true;

    #[On('open')]
    public function open() {
        $this->visible = true;
    }

    #[On('hide')]
    public function hide() {
        $this->visible = false;
    }

    public function render()
    {
        return view('livewire.modals.modal');
    }
}
