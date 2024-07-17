<?php

namespace App\Livewire;

use App\Models\ProductResponse;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Notifications\Notifiable;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateProductResponse extends Component implements HasForms
{
    use InteractsWithForms;
    use Notifiable;
    
    #[Locked]
    public  $product_title;
    public  $date_response;
    public ?string $full_name = "";
    public ?string $contact = "";
    public ?string $email_address = "";
    public ?string $message = "";

    public bool $isValid = false;

    protected $casts = [
        'date_response' => 'datetime',
    ];

    protected $rules = [
        'full_name' => 'required|min:5',
        'contact' => 'required|min:11',
        'email_address' => 'required|email',
        'message' => 'required|min:20',
    ];

    protected $messages = [
        'full_name.required' => 'Please fill out with your full name.',
        'full_name.min' => 'Your name is too short.',
        'contact.required' => 'Please fill out with your contact number.',
        'contact.min' => 'Your contact number is invalid.',
        'email_address.required' => 'Please fill out with your email address.',
        'email_address.email' => 'Your email is invalid.',
        'message.required' => 'Please fill out with your message.',
        'message.min' => 'Your message cannot be less than 20 characters.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->isValid = $this->isFormValid();
    }

    protected function isFormValid()
    {
        try {
            $this->validate();
            return true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            return false;
        }
    }

    public function mount(ProductResponse $response): void
    {
        $this->form->fill($response->toArray());
    
    }
    
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_title')
                ->relationship('product', 'title')
                // ->readOnly()
                ->label(__('Position'))
                // ->required()
                ->columnSpan(3),

                TextInput::make('full_name')
                ->label(__('Full Name'))
                ->minValue(5)
                ->required()
                ->live()
                ->columnSpan(3),

                DatePicker::make('date_response')
                ->label(__('Date'))
                ->default(now())
                ->readOnly()
                ->required()
                ->columnSpan(1),

                TextInput::make('contact')
                ->label(__('Contact Number'))
                ->required()
                ->minValue(11)
                ->live()
                ->columnSpan(1),

                TextInput::make('email_address')
                ->label(__('Email'))
                ->email()
                ->live()
                ->required()
                ->columnSpan(1),

                Textarea::make('message')
                ->label(__('Inquiry'))
                ->minLength(20)
                ->required()
                ->live()

                ->columnSpan(3),
                

                ])
                
            // ->statePath('data')
            ->model(ProductResponse::class);
            
            
    }
    
    
    
    public function create(): void
    {
        $this->validate();
        $response = ProductResponse::create($this->form->getState());
      
        $this->form->model($response)->saveRelationships();

        // $response->notify(new ResponseUpdate($response));
        
        $this->dispatch('post-created');
        
    }
    #[On('post-created')] 
    public function updatePostList()
    {
        session()->flash('message', 'Product Inquiry submitted successfully.');

        $this->form->fill();
    }

    public function render() 
    {
        return view('livewire.create-product-response');
        
    }
}
