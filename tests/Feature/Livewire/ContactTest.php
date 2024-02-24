<?php

namespace Tests\Feature\Livewire;

use App\Livewire\{Contact, Home};
use App\Mail\ContactMessage;
use Filament\Notifications\Notification;
use Mail;

use function Pest\Livewire\livewire;

it('can render contact in home page', function () {

    livewire(Home::class)
        ->assertSeeLivewire(Contact::class);

});

it('can send email for contact', function () {

    // Arrange
    Mail::fake();

    $data = collect([
        'name'    => fake()->name,
        'email'   => fake()->email,
        'subject' => fake()->sentence,
        'message' => fake()->paragraph,
    ]);

    // Act
    $lw = livewire(Contact::class)
        ->fillForm([
            'name'    => $data->get('name'),
            'email'   => $data->get('email'),
            'subject' => $data->get('subject'),
            'message' => $data->get('message'),
        ])
        ->call('send');

    // Assert
    $lw
        ->assertPropertyWired('data.name')
        ->assertPropertyWired('data.email')
        ->assertPropertyWired('data.subject')
        ->assertMethodWiredToForm('send')
        ->assertHasNoFormErrors()
        ->assertFormSet([
            'name'    => '',
            'email'   => '',
            'subject' => '',
            'message' => '',
        ])
        ->assertDispatched('contact::message::sent')
        ->assertNotified(
            Notification::make()
                ->success()
                ->title('Contato')
                ->body('Confirmamos o recebimento da sua mensagem. Em breve entraremos em contato.'),
        );

    Mail::assertQueued(ContactMessage::class, function ($mail) use ($data) {
        return $mail->hasSubject($data->get('subject'))
            && $mail->hasFrom($data->get('email'))
            && $mail->hasTo(config('mail.from.address'));
    });

});

test('field name is required', function () {

    // Act
    $lw = livewire(Contact::class)
        ->fillForm([
            'name' => null,
        ])
        ->call('send');

    // Assert
    $lw
        ->assertHasErrors(['data.name' => 'required'])
        ->assertSeeHtml(__('validation.required', ['attribute' => 'nome']));

});

test('field name cannot has more than 255 characters', function () {

    // Act
    $lw = livewire(Contact::class)
        ->fillForm([
            'name' => str_repeat('a', 256),
        ])
        ->call('send');

    // Assert
    $lw->assertHasErrors(['data.name' => 'max'])
        ->assertSeeHtml(__('validation.max.string', ['attribute' => 'nome', 'max' => 255]));

});

test('field email is required', function () {

    // Act
    $lw = livewire(Contact::class)
        ->fillForm([
            'email' => null,
        ])
        ->call('send');

    // Assert
    $lw->assertHasErrors(['data.email' => 'required'])
        ->assertSeeHtml(__('validation.required', ['attribute' => 'e-mail']));

});

test('field email must be a valid email address', function () {

    // Act
    $lw = livewire(Contact::class)
        ->fillForm([
            'email' => 'invalid-email',
        ])
        ->call('send');

    // Assert
    $lw->assertHasErrors(['data.email' => 'email'])
        ->assertSeeHtml(__('validation.email', ['attribute' => 'e-mail']));

});

test('field email cannot has more than 255 characters', function () {

    // Act
    $lw = livewire(Contact::class)
        ->fillForm([
            'email' => str_repeat('a', 256) . fake()->email,
        ])
        ->call('send');

    // Assert
    $lw->assertHasErrors(['data.email' => 'max'])
        ->assertSeeHtml(__('validation.max.string', ['attribute' => 'e-mail', 'max' => 255]));

});

test('field subject is required', function () {

    // Act
    $lw = livewire(Contact::class)
        ->fillForm([
            'subject' => null,
        ])
        ->call('send');

    // Assert
    $lw
        ->assertHasErrors(['data.subject' => 'required'])
        ->assertSeeHtml(__('validation.required', ['attribute' => 'assunto']));

});

test('field subject cannot has more than 255 characters', function () {

    // Act
    $lw = livewire(Contact::class)
        ->fillForm([
            'subject' => str_repeat('a', 256),
        ])
        ->call('send');

    // Assert
    $lw->assertHasErrors(['data.subject' => 'max'])
        ->assertSeeHtml(__('validation.max.string', ['attribute' => 'assunto', 'max' => 255]));

});

test('field message is required', function () {

    // Act
    $lw = livewire(Contact::class)
        ->fillForm([
            'message' => null,
        ])
        ->call('send');

    // Assert
    $lw
        ->assertHasErrors(['data.message' => 'required'])
        ->assertSeeHtml(__('validation.required', ['attribute' => 'mensagem']));

});
