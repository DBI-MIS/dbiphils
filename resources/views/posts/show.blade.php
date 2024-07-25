
<x-app-layout :title="$post->title">

    {!! seo()->for($post) !!}

    <style>
    div#social-links {
        margin: 0 ;
        max-width: 500px;
    }

    div#social-links ul li {
        display: inline-block;
    }   

    div#social-links ul li a {
        padding: 5px;
        margin: 1px;
        font-size: 20px;       
    }
    </style>
 
    <article class="col-span-8 md:col-span-3 md:mt-8 mx-auto w-full h-full py-4" style="max-width:900px">
       

                <div class="inline cursor-pointer"
                wire:navigate href="{{ route('posts.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd" d="M10.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L12.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M4.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L6.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z" clip-rule="evenodd" />
                  </svg>
            </div>
                
            <div class="w-full py-6">
        
                <h1 class="text-3xl md:text-4xl font-bold text-left text-gray-800">
                    {{ $post->title }}
                </h1>
                <div class="inline"><span>Posted: </span>{{ $post->published_at->diffForHumans() }}</div>
            </div>
            <div class="w-full inline-flex items-center mb-10" >
                <span>Share | </span> 
                {!!$shareComponent!!}
            </div>
            
        <div class="w-full relative">
            @if ($post->img === null)
            <tr>
                <td><img src="{{asset('/default-slide-1.webp')}}" alt="Post Image" class="w-full max-h-48"></td>
            </tr>
            @endif
            <img class="h-auto mx-auto z-0" src="/storage/{{ $post->img }}" alt="{{ $post->title }}">

            <div class="absolute inset-0 bg-no-repeat bg-cover bg-fixed bg-center -z-10 blur-xl"
            style="background-image: url('/storage/{{ $post->img }}');">
        </div>
        </div>

        <div class="grid grid-cols-3 gap-3 flex-grow">        
            <div class="col-span-3 w-full py-5 px-5 mb-5 p-2">             
                
                    
                    <div class="mb-4 text-base items-center justify-between border-t border-b border-gray-200 px-2 mt-4 py-4" >
                        @if ($post->content === null)
                        <tr>
                            <td>No Content to display.</td>
                        </tr>
                        @endif
                        
                        @markdown($post->content)
                        
                    </div>


            </div>

        </div>
        </div>

      

   
        <div class="flex flex-col md:flex-row md:items-center items-start gap-5 w-full justify-between py-4 px-5 md:px-10 border-y-2 border-blue-200">
            <div class="flex flex-row items-center gap-2">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0 6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                      </svg>
                </div>
                
                  <div class="text-sm text-nowrap">
                    <span>For More Info:</span>
                    <p>Contact Us @ </p>
                    <p>Tel: +632 8723 4461 to 64</p>
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
                        <p>corporate@dbiphils.com,</p>
                        <p>sales@dbiphils.com</p>
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
                  <div><a href="https://facebook.com/DBIntPhilippines" target="_blank">DBIntPhilippines</a></div>
                    
                </div>
                <div class="flex gap-1 mt-1">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32"><path d="M26.111,3H5.889c-1.595,0-2.889,1.293-2.889,2.889V26.111c0,1.595,1.293,2.889,2.889,2.889H26.111c1.595,0,2.889-1.293,2.889-2.889V5.889c0-1.595-1.293-2.889-2.889-2.889ZM10.861,25.389h-3.877V12.87h3.877v12.519Zm-1.957-14.158c-1.267,0-2.293-1.034-2.293-2.31s1.026-2.31,2.293-2.31,2.292,1.034,2.292,2.31-1.026,2.31-2.292,2.31Zm16.485,14.158h-3.858v-6.571c0-1.802-.685-2.809-2.111-2.809-1.551,0-2.362,1.048-2.362,2.809v6.571h-3.718V12.87h3.718v1.686s1.118-2.069,3.775-2.069,4.556,1.621,4.556,4.975v7.926Z" fill-rule="evenodd"></path></svg>
                    </div>
                    
                    <div><a href="https://www.linkedin.com/company/db-international-sales?originalSubdomain=ph" target="_blank">DBInternational</a></div> 
                </div>
                </div>
            </div>
            
            </div>
        </div>
            
           
    </article>
    

  
   

</x-app-layout>