<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Home extends Component
{
    public array $sections = [];

    public function render(): View
    {
        return view('livewire.home')->layout('layouts.home');
    }

    public function mount(): void
    {
        $this->loadMenus();
    }

    public function loadMenus(): void
    {
        $this->sections = [
            ['ref' => 'resources', 'text' => 'Recursos'],
            ['ref' => 'benefits', 'text' => 'Benefícios'],
            ['ref' => 'about', 'text' => 'Sobre'],
            ['ref' => 'who-we-are', 'text' => 'Quem somos'],
            ['ref' => 'contact', 'text' => 'Contato'],
        ];
    }
}
