
<x-app-layout :title="$product->title">

 

@section('meta_title', ($product->title))
@section('meta_type', 'website')
@section('meta_description', ($product->getExcerpt()))
@section('meta_image', $product->product_img ? asset("/storage/$product->product_img") : asset('/Product_Default.png'))
@section('meta_keywords', $product->title . ', ' . $product->product_brand?->name . ', ' . $product->product_categories->pluck('title')->implode(', ') . ', HVAC Equipment, Chiller, AHU, FCU')


     

 
        <article class="col-span-8 md:col-span-3 md:mt-10 mx-auto py-5 w-full h-full min-h-[560px]" style="max-width:900px">
            <div class="flex flex-col md:flex-row items-start gap-x-2 w-full">
            <div class="flex-grow-0 py-5 px-5 mb-5 rounded-md border-opacity-10 p-2 bg-white border-blue-800" 
            style="min-width:280px; max-width:280px"
            >
                <img class="w-full" 
                src="{{ $product->product_img ? asset('storage/' . $product->product_img) : asset('/Product_Default.png') }}" 
                alt="{{ $product->title }}">
           
                
            </div>
            <div class="grid grid-cols-3 gap-3 flex-grow">        
                <div class="col-span-3 w-full py-5 px-5 mb-5 rounded-xl border-l-4 border-opacity-10 p-2 bg-white border-blue-800">

                    <div class="flex flex-row justify-between w-full">
            
                        <h3 class="text-2xl md:text-4xl font-bold text-left text-gray-800">
                            {{ $product->title }}
                        </h3>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5 text-gray-500 hover:text-gray-800">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                      
                        <div class="gap-x-2 mt-4">
                                <span class="mr-1 rounded-xl px-2 py-1 text-sm bg-sky-200">{{ $product->product_brand?->name }}</span>
                                {{-- <span class="mr-1 rounded-xl px-3 py-1 text-base bg-green-200">{{ $product->equipment_header }}</span> --}}
                        </div>

                        <div class="w-full inline-flex items-center mb-10 mt-4" >
            <span>Share | </span> 
            {!!$shareComponent!!}
        </div>

                        <div class="flex flex-row gap-x-2 mt-2">
                            <div class="topics flex flex-wrap justify-start gap-1 my-auto py-1">
                                @foreach ($product->product_categories as $category)
                                    <x-badge wire:navigate href="{{ route('products.index', ['category' => $category->slug])}}"
                                             :textColor="$category->text_color" :bgColor="$category->bg_color" >
                                        {{ $category->title }}
                                    </x-badge>
                                @endforeach
                            </div>
                        </div>
                        
                        <h3 class="font-light mt-4 mb-2">Description</h3>
                        <div class="mb-2 text-base items-center justify-between border-t border-b border-gray-100 px-2 text-balance">
                            @if ($product->description === null)
                            <tr>
                                <td>No Description to display.</td>
                            </tr>
                            @endif
                            <p>
                        {!! $product->description !!}
                    </p>
                        </div>

                        <h3 class="font-light mt-4 mb-2">Features</h3>
                        <div class="mb-2 text-base items-center justify-between border-t border-b border-gray-100 px-2 text-balance">
                            @if ($product->features === null)
                            <tr>
                                <td>No Feature to Display</td>
                            </tr>
                            @endif
                        {!! $product->features !!}
                        </div>

                        <h3 class="font-light mt-4 mb-2">Technical Specification</h3>
                        <div class="mb-2 text-base items-center justify-between border-t border-b border-gray-100 px-2 text-balance">
                            @if ($product->technical_specs === null)
                            <tr>
                                <td>No Data to Display</td>
                            </tr>
                            @endif
                        {!! $product->technical_specs !!}
                        </div>

                        <h3 class="font-light mt-4 mb-2">Capacity</h3>
                        <div class="mb-2 text-base items-center justify-between border-t border-b border-gray-100 px-2 text-balance">
                            @if ($product->capacity === null)
                            <tr>
                                <td>No Data to Display</td>
                            </tr>
                            @endif
                        {!! $product->capacity !!}
                        </div>

                        <h3 class="font-light mt-4 mb-2">Application</h3>
                        <div class="mb-2 text-base items-center justify-between border-t border-b border-gray-100 px-2 text-balance">
                            @if ($product->equipment_application === null)
                            <tr>
                                <td>No Data to Display</td>
                            </tr>
                            @endif
                        {!! $product->equipment_application !!}
                        </div>
                        
                        <x-filament::modal width="2xl">
                            <x-slot name="trigger">
                                <x-filament::button class="w-full mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-blue-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
                                    Inquire Here
                                </x-filament::button>
                            </x-slot>
                            <livewire:create-product-response :product_title="$product->id" :date_response="Carbon\Carbon::now()->format('M-d-Y')"/>
                        </x-filament::modal>
                      
                       
                </div>
                

            </div>
            </div>

          
   
       
            <div class="flex flex-col md:flex-row md:items-center items-start gap-5 w-full justify-between py-4 px-5 md:px-10 border-y-2 border-blue-200 mt-24" data-nosnippet>
                <div class="flex flex-row items-center gap-2">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0 6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                          </svg>
                    </div>
                    
                    <div class="flex flex-col text-sm text-nowrap">
                        <span>For More Info:</span>
                    <span>Contact Us @ </span>
                    <span>Tel: +632 8723 4461 to 64</span>
                    </div>
                </div>
            
                <div class="flex flex-row items-center gap-2">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                          </svg>
                          
                    </div>
                    
                      <div class="text-sm">
                        <span>Email</span>
                        <div class="flex flex-col">
                            <span>sales@dbiphils.com,</span>
                            <span>corporate@dbiphils.com,</span>
                            <span>rtg@dbiphils.com</span>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="flex flex-row items-center gap-2">
                    <div>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                          </svg> --}}
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                          </svg>
                          
                    </div>
                    
                      <div class="text-sm">
                        <span>Follow, Like & Subscribe to Our Socials</span>
                        <div class="flex flex-row md:flex-col lg:flex-row">
                        
                       <div class="flex gap-1 mt-1 mr-5">
                        <div>
                           
                              
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32"><path d="M16,2c-7.732,0-14,6.268-14,14,0,6.566,4.52,12.075,10.618,13.588v-9.31h-2.887v-4.278h2.887v-1.843c0-4.765,2.156-6.974,6.835-6.974,.887,0,2.417,.174,3.043,.348v3.878c-.33-.035-.904-.052-1.617-.052-2.296,0-3.183,.87-3.183,3.13v1.513h4.573l-.786,4.278h-3.787v9.619c6.932-.837,12.304-6.74,12.304-13.897,0-7.732-6.268-14-14-14Z"></path></svg>
                        </div>
                      <div><a href="https://facebook.com/DBIntPhilippines" target="_blank" rel="noopener noreferrer">DBIntPhilippines</a></div>
                        
                    </div>
                    <div class="flex gap-1 mt-1">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32"><path d="M26.111,3H5.889c-1.595,0-2.889,1.293-2.889,2.889V26.111c0,1.595,1.293,2.889,2.889,2.889H26.111c1.595,0,2.889-1.293,2.889-2.889V5.889c0-1.595-1.293-2.889-2.889-2.889ZM10.861,25.389h-3.877V12.87h3.877v12.519Zm-1.957-14.158c-1.267,0-2.293-1.034-2.293-2.31s1.026-2.31,2.293-2.31,2.292,1.034,2.292,2.31-1.026,2.31-2.292,2.31Zm16.485,14.158h-3.858v-6.571c0-1.802-.685-2.809-2.111-2.809-1.551,0-2.362,1.048-2.362,2.809v6.571h-3.718V12.87h3.718v1.686s1.118-2.069,3.775-2.069,4.556,1.621,4.556,4.975v7.926Z" fill-rule="evenodd"></path></svg>
                        </div>
                        
                        <div><a href="https://www.linkedin.com/company/db-international-sales?originalSubdomain=ph" target="_blank" rel="noopener noreferrer">DBInternational</a></div> 
                    </div>
                    </div>
                </div>
                
                </div>
            </div>
                
               
        </article>
        

      
       

    </x-app-layout>