<?php

namespace App\Livewire;

use App\Models\MainResponse;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Notifications\Notifiable;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
// use Livewire\Form;

class CreateMainResponse extends Component implements HasForms
{

    use InteractsWithForms;
    // use Notifiable;
    
    // public ?array $form = [];

    public MainResponse $response;
 
    #[Validate('required', message:'Please fill out with your full name.')]
    #[Validate('min:5', message:'Your name is too short.')]
    public ?string $name = "";

    #[Validate('required', message:'Please Select the Subject.')]
    public ?string $subject = "";

    #[Validate('required', message:'Please fill out with your contact number.')]
    #[Validate('min:11', message:'Your contact number is invalid.')]
    public ?string $contact  = "";

    #[Validate('required', message:'Please fill out with your email address.')]
    #[Validate('email', message:'Your email is invalid.')]
    public ?string $email  = "";

    #[Validate('required', message:'Please fill out with your message.')]
    #[Validate('min:20', message:'Your message cannot be less than 20 characters.')]
    public ?string $message  = "";

    public function mount(MainResponse $response): void
    {
        $this->form->fill($response->toArray());
    
    }
    
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('name')
                ->label(__('Full Name'))
                ->minValue(5)
                ->required()
                ->live()
                ->columnSpan(3),

                TextInput::make('contact')
                ->label(__('Contact Number'))
                ->required()
                ->minValue(11)
                ->live()
                ->columnSpan(1),

                Select::make('subject')
                ->options([
                    'General Inquiry' => 'General Inquiry',
                    'Product Inquiry' => 'Product Inquiry',
                    'Concern/Issue' => 'Concern/Issue',
                    'Careers/Hiring' => 'Careers/Hiring',
                    'Feedback' => 'Feedback',
                ])
                ->default('General Inquiry')
                ->required()
                ->live()
                ,

                TextInput::make('email')
                ->label(__('Email'))
                ->live()
                ->required(),

                Textarea::make('message')
                ->label(__('Inquiry'))
                ->minLength(20)
                ->required()
                ->live()
                ->columnSpan(3),

                ])
                
            // ->statePath('data')
            ->model(MainResponse::class);
            
            
    }
    
    
    
    public function create(): void
    {
        $this->validate();

        MainResponse::create($this->form->getState());

        $this->dispatch('post-created');
        
    }
    
    #[On('post-created')] 
    public function updatePostList()
    {
        session()->flash('message', 'Form Submitted Successfully.');

        $this->form->fill();

    }

    public function render()
    {
        return view('livewire.create-main-response');
    }
}
