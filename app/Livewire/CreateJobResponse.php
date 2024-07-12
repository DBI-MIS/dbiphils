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
    #[Validate('required', message:'Please fill out with your full name.')]
    #[Validate('min:5', message:'Your name is too short.')]
    public ?string $full_name;
    #[Validate('required', message:'Please fill out with your contact number.')]
    #[Validate('min:11', message:'Your contact number is invalid.')]
    public ?string $contact;
    #[Validate('required', message:'Please fill out with your email address.')]
    #[Validate('email', message:'Your email is invalid.')]
    #[Validate('regex:/(.*)@(gmail|yahoo)\.com/i', message:'Your email is invalid.')]
    public ?string $email_address;
    #[Validate('required', message:'Please fill out with your current address.')]
    #[Validate('min:5', message:'Your current address format is invalid.')]
    public ?string $current_address;
    #[Validate('required', message:'Please attached your resume.')]
    #[Validate('file|mimes:pdf, doc, docx', message:'Your file must be in PDF or MS Word Format.')]
    #[Validate('max:5120', message:'Your file must have maximum size of 5MB.')]
    public $attachment;

    public $captcha = null;
    

    protected $casts = [
        'date_response' => 'datetime',
        // 'attachment' => 'array',
       
    ];


    public function mount(JobResponse $response): void
    {
       
        $this->form->fill($response->toArray());
        
    }

   
    
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('post_title')
                ->relationship('post', 'title')
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
                ->unique()
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
                // ->downloadable()
                // ->fetchFileInformation(true)
                // ->moveFiles()
                // ->storeFiles(true)
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

        $this->form->fill();

        $this->attachment=null;

       
        
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
