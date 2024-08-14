@props(['job', 'response'])

<div class="text-slate-800 dark:text-white">
    {{-- <button x-data x-on:click="trigger">
            X
        </button> --}}
    @livewire('notifications')
    @csrf



    <form wire:submit="create" wire:confirm="Are you sure you want to submit this application?"
        enctype="multipart/form-data">

        {{-- {{ $this->form }} --}}
        
        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
            x-on:livewire-upload-finish="uploading = false; progress = 0;"
            x-on:livewire-upload-progress="progress = $event.detail.progress">


            <div>

                <div class="mb-5">

                    <span class="text-base md:text-2xl text-bold font-semibold text-gray-600 dark:text-white block">Job
                        Application</span>
                        <span class="text-sm italic text-gray-600 block mt-2 dark:text-white">Note: Fill up all required fields to complete the form.</span>
                    <input type="text" wire:model="post_title" @readonly(true) name="post_title" hidden>
                    <div>
                        @error('post_title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-2">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-gray-500 font-bold py-2 bg-lime-400 text-center rounded-md">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                </div>


                <table class="w-full">

                    <tbody>
                        <tr>
                            <td style="width:25%"><label class="text-sm md:text-base">Date</label></td>
                            <td><input type="text" wire:model="date_response" @readonly(true) name="date_response"
                                    class="!border-none !w-full !mb-4 text-sm md:text-base dark:text-slate-800">
                                <div>
                                    @error('date_response')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base">Full Name</label></td>

                            <td>

                                <div>
                                    @error('full_name')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="full_name" name="full_name"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base  dark:text-slate-800"
                                    autofocus>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base">Contact</label></td>
                            <td>
                                <div>
                                    @error('contact')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="contact" name="contact"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base  dark:text-slate-800">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base">Email</label></td>
                            <td>
                                <div>
                                    @error('email_address')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="email_address" name="email_address"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base  dark:text-slate-800">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base">Current Address</label></td>
                            <td>
                                <div>
                                    @error('current_address')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="current_address" name="current_address"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base  dark:text-slate-800">
                            </td>
                        </tr>
                    </tbody>
                </table>



                <div class="flex gap-8 mt-5">
                <div class="text-sm md:text-base">*Attach File Here</div>
                <div x-data="{ isUploading: false, progress: 0 }" 
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                    class=""
                    >
                    
                    <!-- File Input -->
                    <input type="file" wire:model="attachment">

                    <!-- Progress Bar -->
                    <div x-show="isUploading" >
                        <progress max="100" x-bind:value="progress" class="w-full">AAA</progress>
                    </div>
                </div>
                </div>

                <div>
                    @error('attachment')
                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

              
                <div id="recaptchaToken" class="g-recaptcha mt-4" data-sitekey='6LdOzxgqAAAAAG-HijnnRLOVdiLKEn8BCP7_exhO' wire:ignore></div>
                
 

                @error('recaptchaToken')
        
                    <p class="mt-3 text-sm text-red-600 text-left">
        
                        {{ $message }}
        
                    </p>
        
                @enderror
              



                <div class="float-right">
                    @if ($isValid)
                    <button wire:loading.class="opacity-50" type="submit"
                        class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-blue-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
                        <span wire:loading.remove>Submit</span>
                        <span wire:loading>Loading</span>
                    </button>
                    @endif
                </div>

            </div>
          
        </div>
        
    </form>

    <script async src="https://www.google.com/recaptcha/api.js" defer></script>



<x-filament-actions::modals />



</div>

