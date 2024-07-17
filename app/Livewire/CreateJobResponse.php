<?php

namespace App\Livewire;

use App\Models\JobResponse;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Notifications\Notifiable;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateJobResponse extends Component implements HasForms, HasActions
{

    use InteractsWithActions;
    use InteractsWithForms;
    use Notifiable;
    
   

    // public ?array $data = [];
    #[Locked]
    public  $post_title;
    public  $date_response;
    public ?string $full_name = "";
    public ?string $contact = "";
    public ?string $email_address = "";
    public ?string $current_address = "";
    public $attachment = [];
    
    public bool $isValid = false;

    public $captcha = null;
    

    protected $casts = [
        'date_response' => 'datetime',
        // 'attachment' => 'array',
       
    ];

    protected $rules = [
        'full_name' => 'required|min:5',
        'contact' => 'required|min:11',
        'email_address' => 'required|email',
        'current_address' => 'required|min:5',
        'attachment' => 'required|max:5120|file|mimes:pdf, doc, docx',
    ];

    protected $messages = [
        'full_name.required' => 'Please fill out with your full name.',
        'full_name.min' => 'Your name is too short.',
        'contact.required' => 'Please fill out with your contact number.',
        'contact.min' => 'Your contact number is invalid.',
        'email_address.required' => 'Please fill out with your email address.',
        'email_address.email' => 'Your email is invalid.',
        'current_address.required' => 'Please fill out with your current address.',
        'current_address.min' => 'Your address is invalid.',
        'attachment.required' => 'Please attach your CV or Resume.',
        'attachment.max' => 'Your file must have maximum size of 5MB.',
        'attachment.file' => 'Your file must be in PDF or MS Word Format.',
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


    public function mount(JobResponse $response): void
    {
       
        $this->form->fill($response->toArray());
        
    }

   
    
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('post_title')
                ->relationship('job_post', 'title')
                // ->readOnly()
                ->label(__('Position'))
                ->required()
                ->columnSpan(3),

                TextInput::make('full_name')
                ->label(__('Full Name'))
                ->minValue(5)
                ->required()
                ->columnSpan(3),

                DatePicker::make('date_response')
                ->label(__('Date'))
                ->default(now())
                ->readOnly()
                ->columnSpan(1),

                TextInput::make('contact')
                ->label(__('Contact Number'))
                ->minValue(11)
                ->required()
                ->columnSpan(1),

                TextInput::make('email_address')
                ->label(__('Email'))
                ->email()
                ->required()
                ->endsWith(['.com,.org,.ph'])
                ->columnSpan(1),

                TextInput::make('current_address')
                ->label(__('Current Addresss'))
                ->minValue(5)
                ->required()
                ->columnSpan(3),
                
                FileUpload::make('attachment')
                ->uploadingMessage('Uploading attachment...')
                ->directory('form-attachments')
                ->visibility('public')
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->maxSize(5120)
                ->getUploadedFileNameForStorageUsing(
                    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                        ->prepend('job_response-'),)
                ->openable()
                ->live()
                ->columnSpan(3)
                ->id('attachment')
                ->required()


    
                ,

                ])
                
            // ->statePath('data')
            ->model(JobResponse::class);
            
            
    }
    
//     public function updatedCaptcha($token)

// {

//     $response = Http::post(

//         'https://www.google.com/recaptcha/api/siteverify?secret='.

//         env('CAPTCHA_SECRET_KEY').

//         '&response='.$token

//     );

 

//     $success = $response->json()['success'];

 

//     if (! $success) {

//         throw ValidationException::withMessages([

//             'captcha' => __('Google thinks, you are a bot, please refresh and try again!'),

//         ]);

//     } else {

//         $this->captcha = true;

//     }

// }

 

// validate the captcha rule

// protected function rules()

// {

//     return [

//         'captcha' => ['required'],

//         // ...

//     ];

// }
    
    public function create(): void
    {
        $this->validate();
        $response = JobResponse::create($this->form->getState());

        $this->form->model($response)->saveRelationships();

        // Mail::to('zhenjin666@gmail.com')->queue(new EmailResponse($response));
        
        $this->dispatch('post-created');
        
    }

    #[On('post-created')] 
    public function updatePostList()
    {
        session()->flash('message', 'Job Application submitted successfully.');

        $this->form->fill();
        $this->attachment=null;

       
    }

    public function render()
    {
        return view('livewire.create-job-response');
    }
}
