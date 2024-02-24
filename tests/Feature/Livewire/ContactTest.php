<?php

namespace Tests\Feature\Livewire;

use App\Livewire\{Contact, Home, Newsletter};
use App\Mail\ContactMessage;
use App\Models\Newsletter as NewsletterModel;
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

todo('can subscribe only one time', function () {

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

todo('field name is required', function () {

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
    $lw->assertHasErrors(['data.name' => 'max'])
        ->assertSeeHtml(__('validation.max.string', ['attribute' => 'nome', 'max' => 255]));

});

todo('field email is required', function () {

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

todo('field email must be a valid email address', function () {

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

todo('field email cannot has more than 255 characters', function () {

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
