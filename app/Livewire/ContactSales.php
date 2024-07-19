<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;



class ContactSales extends Component
{

    public $show = false;

    #[On('openModal')]
    public function openModal()
    {
        $this->show = true;
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->show = false;
    }
    
    public function render()
    {
        return view('livewire.contact-sales');
    }
}
