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
            ['component' => 'principal', 'ref' => 'principal', 'text' => 'Início'],
            ['component' => 'resources', 'ref' => 'resources', 'text' => 'Recursos'],
            ['component' => 'benefits', 'ref' => 'benefits', 'text' => 'Benefícios'],
            ['component' => 'who-we-are', 'ref' => 'whoWeAre', 'text' => 'Quem somos'],
            ['component' => 'newsletter', 'ref' => 'newsletter', 'text' => 'Newsletter'],
            ['component' => 'contact', 'ref' => 'contact', 'text' => 'Contato'],
        ];
    }
}
