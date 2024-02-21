<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Newsletter;
use Livewire\Livewire;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Newsletter::class)
            ->assertStatus(200);
    }
}
