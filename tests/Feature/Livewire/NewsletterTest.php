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

todo('field name cannot has more than 255 characters', function () {

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'name' => str_repeat('a', 256),
        ])
        ->call('subscribe');

    // Assert
    $lw->assertHasErrors(['name' => 'max'])
        ->assertSeeHtml(__('validation.max.string', ['attribute' => 'name', 'max' => 255]));

});

todo('field email is required', function () {

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'email' => null,
        ])
        ->call('subscribe');

    // Assert
    $lw->assertHasErrors(['email' => 'required'])
        ->assertSeeHtml(__('validation.required', ['attribute' => 'email']));

});

todo('field email must be a valid email address', function () {

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'email' => 'invalid-email',
        ])
        ->call('subscribe');

    // Assert
    $lw->assertHasErrors(['email' => 'email'])
        ->assertSeeHtml(__('validation.email', ['attribute' => 'email']));

});

todo('field email cannot has more than 255 characters', function () {

    // Act
    $lw = livewire(Newsletter::class)
        ->fillForm([
            'email' => str_repeat('a', 256),
        ])
        ->call('subscribe');

    // Assert
    $lw->assertHasErrors(['email' => 'max'])
        ->assertSeeHtml(__('validation.max.string', ['attribute' => 'email', 'max' => 255]));

});
