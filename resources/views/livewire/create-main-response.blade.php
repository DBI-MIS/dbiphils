<div class="md:px-5 py-5 ">
    @livewire('notifications')
    
    {{-- <button x-data x-on:click="trigger">
            X
        </button> --}}
    @csrf
    

    <form wire:submit="create" wire:confirm="Are you sure you want to submit this application?">

                <div class="mb-5">

                    <span class="text-2xl text-bold font-semibold text-gray-600 block">Send Us A Message</span>
                    <span class="text-sm italic text-gray-600 block mt-2">Note: Fill up all required fields to complete the form.</span>

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
                            <td><label class="text-sm md:text-base text-gray-600">Name</label></td>

                            <td>

                                <div>
                                    @error('name')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.defer="name" name="name"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base">
                            </td>
                        </tr>

                        <tr>
                            <td><label class="text-sm md:text-base text-gray-600">Subject</label></td>
                            <td>
                                <div>
                                    @error('subject')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <select type="text" wire:model.defer="subject" name="subject"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base">
                                    <option value="" disabled selected>Select Subject</option>
                                        <option value="General Inquiry">General Inquiry</option>
                                        <option value="Product Inquiry">Product Inquiry</option>
                                        <option value="Concern/Issue">Concern/Issue</option>
                                        <option value="Careers/Hiring">Careers/Hiring</option>
                                        <option value="Feedback">Feedback</option>
                                   	
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label class="text-sm md:text-base text-gray-600">Contact</label></td>
                            <td>
                                <div>
                                    @error('contact')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.defer="contact" name="contact"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base  text-gray-600">Email</label></td>
                            <td>
                                <div>
                                    @error('email')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.defer="email" name="email"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base text-gray-600">Message</label></td>
                            <td>
                                <div>
                                    @error('message')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <textarea type="text" wire:model.live="message" name="message" rows="5"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               
                            </td>
                            <td>
                                
                                <div class="inline float-right">
                                    @if ($isValid)
                                    <button wire:loading.class="opacity-50" type="submit"
                                        class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-blue-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
                                        <span wire:loading.remove>Submit</span>
                                    </button>
                                    @endif
                                </div>
                                
                            </td>
                        </tr>
                        
                    </tbody>
                    
                </table>

    </form>


</div>
