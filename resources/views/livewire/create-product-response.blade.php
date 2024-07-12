@props(['product'])



<div class="md:px-5 md:py-5 ">
    {{-- <button x-data x-on:click="trigger">
            X
        </button> --}}
    @csrf

    @livewire('notifications')


    <form wire:submit="create" wire:confirm="Are you sure you want to submit this application?">

                <div class="mb-5">

                    <span class="text-base md:text-2xl text-bold font-semibold text-gray-600 dark:text-white">Product Inquiry</span>
                    <input type="text" wire:model="product_title" @readonly(true) name="product_title" hidden>
                    <div>
                        @error('product_title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <table class="w-full">

                    <tbody>
                        <tr>
                            <td style="width:25%"><label class="text-sm md:text-base dark:text-white">Date</label></td>
                            <td><input type="text" wire:model="date_response" @readonly(true) name="date_response"
                                    class="!border-none !w-full !mb-4 text-sm md:text-base">
                                <div>
                                    @error('date_response')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base  dark:text-white">Full Name</label></td>

                            <td>

                                <div>
                                    @error('full_name')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="full_name" name="full_name"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base" autofocus>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base  dark:text-white">Contact</label></td>
                            <td>
                                <div>
                                    @error('contact')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="contact" name="contact"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base  dark:text-white">Email</label></td>
                            <td>
                                <div>
                                    @error('email_address')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="email_address" name="email_address"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base dark:text-white">Inquiry</label></td>
                            <td>
                                <div>
                                    @error('message')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <textarea type="text" wire:model.change="message" name="message" rows="5"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>







                <div class="float-right">
                    <button wire:loading.class="opacity-50" type="submit"
                        class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-blue-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
                        <span wire:loading.remove>Submit</span>
                        
                    </button>
                </div>

           
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success text-green-700 font-bold py-2">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
       

    </form>


<x-filament-actions::modals />
</div>
