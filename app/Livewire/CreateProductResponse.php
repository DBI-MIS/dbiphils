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
    #[Validate('required', message:'Please fill out with your full name.')]
    #[Validate('min:5', message:'Your name is too short.')]
    public ?string $full_name;
    #[Validate('required', message:'Please fill out with your contact number.')]
    #[Validate('min:11', message:'Your contact number is invalid.')]
    public ?string $contact;
    #[Validate('required', message:'Please fill out with your email address.')]
    #[Validate('email', message:'Your email is invalid.')]
    public ?string $email_address;
    #[Validate('required', message:'Please fill out with your message.')]
    #[Validate('min:20', message:'Your message cannot be less than 20 characters.')]
    public ?string $message;

    protected $casts = [
        'date_response' => 'datetime',
    ];


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
        // session()->flash('message', 'Product Inquiry submitted successfully.');

        $this->form->fill();
    }

    public function render() 
    {
        return view('livewire.create-product-response');
        
    }
}
