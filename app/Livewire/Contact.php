<?php

namespace App\Livewire;

use App\Mail\ContactMessage;
use Filament\Forms\Components\{Grid, RichEditor, TextInput};
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\View\View;
use Livewire\Component;
use Mail;

/**
 * @property Form $form
 */
class Contact extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function render(): View
    {
        return view('livewire.contact');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([

            Grid::make()
                ->columns([
                    'default' => 1,
                    'lg'      => 2,
                ])
                ->schema([

                    TextInput::make('name')
                        ->label('Nome')
                        ->placeholder('Seu nome')
                        ->maxLength(255)
                        ->required(),

                    TextInput::make('email')
                        ->label('E-mail')
                        ->placeholder('Seu e-mail')
                        ->email()
                        ->maxLength(255)
                        ->required(),

                ]),

            TextInput::make('subject')
                ->label('Assunto')
                ->placeholder('Digite o assunto')
                ->maxLength(255)
                ->required(),

            RichEditor::make('message')
                ->label('Mensagem')
                ->placeholder('Digite sua mensagem')
                ->required(),

        ])->statePath('data');

    }

    public function send(): void
    {
        $data = $this->form->getState();

        Mail::to(config('mail.from.address'))
            ->send(new ContactMessage($data));

        $this->dispatch('contact::message::sent');

        Notification::make()
            ->success()
            ->title('Contato')
            ->body('Confirmamos o recebimento da sua mensagem. Em breve entraremos em contato.')
            ->send();

        $this->form->fill();
    }

}
