<?php

namespace App\Livewire;

use App\Mail\SubscribedNewsletter;
use App\Models\Newsletter as NewsletterModel;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Component;

/**
 * @property Form $form
 */
class Newsletter extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function render(): View
    {
        return view('livewire.newsletter');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([

            TextInput::make('name')
                ->label('Nome')
                ->placeholder('Seu nome')
                ->maxLength(255)
                ->required(),

            TextInput::make('email')
                ->label('E-mail')
                ->placeholder('Seu e-mail')
                ->email()
                ->unique('newsletters', 'email')
                ->maxLength(255)
                ->required(),

        ])->statePath('data');
    }

    public function subscribe(): void
    {
        $data = $this->form->getState();

        NewsletterModel::query()->create($data);

        $this->dispatch('subscribed');

        Notification::make()
            ->success()
            ->title('Newsletter')
            ->body('Inscrição realizada com sucesso.')
            ->send();

        Mail::to($data['email'])->send(new SubscribedNewsletter());

        $this->form->fill();
    }
}
