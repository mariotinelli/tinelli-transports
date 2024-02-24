<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Contact;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Livewire\Livewire;
use Tests\TestCase;

class ContactTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Contact::class)
            ->assertStatus(200);
    }
}
