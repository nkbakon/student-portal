<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>NEXTGENEDU</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">
        <!-- Tailwind CSS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/monolith.min.css"/>

        <!-- font-awesome icons -->
        <script src="https://kit.fontawesome.com/2d49de291b.js" crossorigin="anonymous"></script>
        
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100"> 
            <div class="md:flex md:bg-white">
                <div class="hidden md:block md:flex w-2/5 md:w-1/5 h-screen sticky text-white top-0 bg-blue-700 border-r hidden">
                    <div class="mx-auto py-5">
                        <ul>
                            <div class="flex items-center justify-center">
                                <a href="{{ route('dashboard') }}"><li class="">					
                                    <img class="justify-center" width="125px" height="125px" src="{{ asset('assets/logo.png') }}" alt="logo"/>
                                </li></a>
                            </div>                            
                            <a href="{{ route('dashboard') }}"><li class="{{ (request()->segment(1) == 'dashboard') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-10 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                <img src="{{ asset('assets/home.svg') }}" alt="Dashboard Icon" class="w-5 h-5">
                                <span class="font-semibold">Dashboard</span>
                            </li></a>                            
                            <a href="{{ route('classes.index') }}"><li class="{{ (request()->segment(1) == 'classes') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                <img src="{{ asset('assets/class.svg') }}" alt="Class Icon" class="w-5 h-5">
                                <span class="font-semibold">Classes</span>
                            </li></a>
                            @if(auth()->user()->type == '1')
                            <a href="{{ route('subjects.index') }}"><li class="{{ (request()->segment(1) == 'subjects') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                <img src="{{ asset('assets/subject.svg') }}" alt="Subject Icon" class="w-5 h-5">
                                <span class="font-semibold">Subjects</span>
                            </li></a>
                            <a href="{{ route('payments.index') }}"><li class="{{ (request()->segment(1) == 'payments') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                <img src="{{ asset('assets/payment.svg') }}" alt="Payments Icon" class="w-5 h-5">
                                <span class="font-semibold">Payments</span>
                            </li></a>
                            @endif
                            @if(auth()->user()->type != '3')
                            <a href="{{ route('cashouts.index') }}"><li class="{{ (request()->segment(1) == 'cashouts') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                <img src="{{ asset('assets/cashout.svg') }}" alt="Cash Icon" class="w-5 h-5">
                                <span class="font-semibold">Cash Out</span>
                            </li></a>
                            @endif
                            @if(auth()->user()->type == '3')
                            <a href="{{ route('assignments.index') }}"><li class="{{ (request()->segment(1) == 'assignments') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                <img src="{{ asset('assets/assignments.svg') }}" alt="Cash Icon" class="w-5 h-5">
                                <span class="font-semibold">Assignments</span>
                            </li></a>
                            @endif
                            <a href="{{ route('profile.index') }}"><li class="{{ (request()->segment(1) == 'profile') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                <img src="{{ asset('assets/profile.svg') }}" alt="Profile Icon" class="w-5 h-5">
                                <span class="font-semibold">Profile</span>
                            </li></a>
                            @if(auth()->user()->type == '1')
                            <a href="{{ route('users.index') }}"><li class="{{ (request()->segment(1) == 'users') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                <img src="{{ asset('assets/users.svg') }}" alt="Users Icon" class="w-5 h-5">    
                                <span class="font-semibold">Users</span>
                            </li></a>
                            @endif
                            <a href="{{ route('logout') }}"><li class="{{ (request()->segment(1) == 'logout') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                <img src="{{ asset('assets/logout.svg') }}" alt="Log Out Icon" class="w-5 h-5">
                                <span class="font-semibold">Log Out</span>
                            </li></a>          
                        </ul>
                    </div>
                </div>

                <div class="block md:hidden">
                    <div class="bg-blue-700 text-white">
                        <div class="sticky container mx-auto px-6 py-4 flex justify-end items-center text-gray-900">                    
                            <div class="block md:hidden">
                                <button id="menu-toggle" class="text-white focus:outline-none">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                </button>
                            </div>
                        </div> 
                        <div id="mobile-menu" class="hidden md:hidden">
                            <nav class="flex flex-col items-center font-semibold text-white space-y-2 py-2">
                                <ul>
                                    <div class="flex items-center justify-center">
                                        <a href="{{ route('dashboard') }}"><li class="">					
                                            <img class="justify-center" width="100px" height="100px" src="{{ asset('assets/logo.png') }}" alt="logo"/>
                                        </li></a>
                                    </div>                            
                                    <a href="{{ route('dashboard') }}"><li class="{{ (request()->segment(1) == 'dashboard') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-10 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                        <img src="{{ asset('assets/home.svg') }}" alt="Dashboard Icon" class="w-5 h-5">
                                        <span class="font-semibold">Dashboard</span>
                                    </li></a>                            
                                    <a href="{{ route('classes.index') }}"><li class="{{ (request()->segment(1) == 'classes') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                        <img src="{{ asset('assets/class.svg') }}" alt="Class Icon" class="w-5 h-5">
                                        <span class="font-semibold">Classes</span>
                                    </li></a>
                                    @if(auth()->user()->type == '1')
                                    <a href="{{ route('subjects.index') }}"><li class="{{ (request()->segment(1) == 'subjects') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                        <img src="{{ asset('assets/subject.svg') }}" alt="Subject Icon" class="w-5 h-5">
                                        <span class="font-semibold">Subjects</span>
                                    </li></a>
                                    <a href="{{ route('payments.index') }}"><li class="{{ (request()->segment(1) == 'payments') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                        <img src="{{ asset('assets/payment.svg') }}" alt="Payments Icon" class="w-5 h-5">
                                        <span class="font-semibold">Payments</span>
                                    </li></a>
                                    @endif
                                    @if(auth()->user()->type != '3')
                                    <a href="{{ route('cashouts.index') }}"><li class="{{ (request()->segment(1) == 'cashouts') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                        <img src="{{ asset('assets/cashout.svg') }}" alt="Cash Icon" class="w-5 h-5">
                                        <span class="font-semibold">Cash Out</span>
                                    </li></a>
                                    @endif
                                    @if(auth()->user()->type == '3')
                                    <a href="{{ route('assignments.index') }}"><li class="{{ (request()->segment(1) == 'assignments') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                        <img src="{{ asset('assets/assignments.svg') }}" alt="Cash Icon" class="w-5 h-5">
                                        <span class="font-semibold">Assignments</span>
                                    </li></a>
                                    @endif
                                    <a href="{{ route('profile.index') }}"><li class="{{ (request()->segment(1) == 'profile') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                        <img src="{{ asset('assets/profile.svg') }}" alt="Profile Icon" class="w-5 h-5">
                                        <span class="font-semibold">Profile</span>
                                    </li></a>
                                    @if(auth()->user()->type == '1')
                                    <a href="{{ route('users.index') }}"><li class="{{ (request()->segment(1) == 'users') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                        <img src="{{ asset('assets/users.svg') }}" alt="Users Icon" class="w-5 h-5">    
                                        <span class="font-semibold">Users</span>
                                    </li></a>
                                    @endif
                                    <a href="{{ route('logout') }}"><li class="{{ (request()->segment(1) == 'logout') ? 'bg-blue-900 border-blue-900': '' }} px-3 py-1 flex space-x-2 mt-4 rounded-md border-blue-800 cursor-pointer hover:bg-blue-900 hover:border-blue-900">					
                                        <img src="{{ asset('assets/logout.svg') }}" alt="Log Out Icon" class="w-5 h-5">
                                        <span class="font-semibold">Log Out</span>
                                    </li></a>         
                                </ul>
                            </nav>                
                        </div>               
                    </div>
                </div>

                <main class="min-h-screen w-full bg-white border-l" style="overflow: auto;"> 
                    
                    @yield('bodycontent')		
                </main>
            </diV>               
        </div> 
               
        <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
        @stack('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('menu-toggle').addEventListener('click', function() {
                    var menu = document.getElementById('menu');
                    var mobileMenu = document.getElementById('mobile-menu');
                    if (mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.remove('hidden');
                    } else {
                        mobileMenu.classList.add('hidden');
                    }
                });
            });
        </script>
    </body>
</html>