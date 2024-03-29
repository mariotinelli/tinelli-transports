<?php

namespace Tests\Feature\Livewire;

use App\Livewire\{Home, Newsletter};
use App\Mail\SubscribedNewsletter;
use App\Models\Newsletter as NewsletterModel;
use Filament\Notifications\Notification;
use Mail;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

it('can render newsletter in home page', function () {

    livewire(Home::class)
        ->assertSeeLivewire(Newsletter::class);

});

it('can subscribes to the newsletter', function () {

    // Arrange
    Mail::fake();

    $newsletter = NewsletterModel::factory()->make();

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'name'  => $newsletter->name,
            'email' => $newsletter->email,
        ])
        ->call('subscribe');

    // Assert
    $lw
        ->assertPropertyWired('data.name')
        ->assertPropertyWired('data.email')
        ->assertMethodWiredToForm('subscribe')
        ->assertHasNoFormErrors()
        ->assertFormSet([
            'name'  => '',
            'email' => '',
        ])
        ->assertDispatched('subscribed')
        ->assertNotified(
            Notification::make()
                ->success()
                ->title('Newsletter')
                ->body('Inscrição realizada com sucesso.'),
        );

    assertDatabaseHas('newsletters', [
        'name'  => $newsletter->name,
        'email' => $newsletter->email,
    ]);

    Mail::assertQueued(SubscribedNewsletter::class, function ($mail) use ($newsletter) {
        return $mail->hasTo($newsletter->email);
    });

});

it('can subscribe only one time', function () {

    // Arrange
    $newsletter = NewsletterModel::factory()->create();

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'name'  => $newsletter->name,
            'email' => $newsletter->email,
        ])
        ->call('subscribe');

    // Assert
    $lw
        ->assertHasErrors(['data.email' => 'unique'])
        ->assertSeeHtml(__('validation.unique', ['attribute' => 'e-mail']));

});

test('field name is required', function () {

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'name' => null,
        ])
        ->call('subscribe');

    // Assert
    $lw
        ->assertHasErrors(['data.name' => 'required'])
        ->assertSeeHtml(__('validation.required', ['attribute' => 'nome']));

});

test('field name cannot has more than 255 characters', function () {

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'name' => str_repeat('a', 256),
        ])
        ->call('subscribe');

    // Assert
    $lw->assertHasErrors(['data.name' => 'max'])
        ->assertSeeHtml(__('validation.max.string', ['attribute' => 'nome', 'max' => 255]));

});

test('field email is required', function () {

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'email' => null,
        ])
        ->call('subscribe');

    // Assert
    $lw->assertHasErrors(['data.email' => 'required'])
        ->assertSeeHtml(__('validation.required', ['attribute' => 'e-mail']));

});

test('field email must be a valid email address', function () {

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'email' => 'invalid-email',
        ])
        ->call('subscribe');

    // Assert
    $lw->assertHasErrors(['data.email' => 'email'])
        ->assertSeeHtml(__('validation.email', ['attribute' => 'e-mail']));

});

test('field email cannot has more than 255 characters', function () {

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'email' => str_repeat('a', 256) . fake()->email,
        ])
        ->call('subscribe');

    // Assert
    $lw->assertHasErrors(['data.email' => 'max'])
        ->assertSeeHtml(__('validation.max.string', ['attribute' => 'e-mail', 'max' => 255]));

});
