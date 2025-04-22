<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>NEXTGENEDU</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <!-- font-awesome icons -->
        <script src="https://kit.fontawesome.com/2d49de291b.js" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="min-w-screen min-h-screen bg-gradient-to-r from-blue-800 to-blue-400 flex items-center justify-center px-5 py-5">
            <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
                <div class="md:flex w-full">
                    <div class="hidden md:flex w-1/2 bg-white py-10 px-10 justify-center">
                        <div>                            
                            <img src="{{ asset('assets/form1.png') }}" alt="login">
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                        <div class="text-center mb-10">
                            <div class="flex items-center justify-center">
                                <img width="100px" height="100px" src="{{ asset('assets/logo.png') }}" alt="logo"/>
                            </div><br>
                            <h1 class="font-bold text-3xl text-gray-900">Update Your Password</h1>
                        </div>
                        @if (session('status'))
                            <div class="text-black m-2 p-4 bg-green-200">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="text-black m-2 p-4 bg-yellow-200">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('delete'))
                            <div class="text-black m-2 p-4 bg-red-200">
                                {{ session('delete') }}
                            </div>
                        @endif
                        <form action="{{route('password.resetpost')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                            <div>
                                <span class="text-sm">User: {{ $email }}</span>
                                <br>
                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="password" class="text-xs font-semibold px-1">New Password</label>
                                        <div class="relative flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                                            </div>
                                            <input type="password" name="password" id="password" class="w-full -ml-10 pl-10 pr-10 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-neutral-900" placeholder="enter new password" required autocomplete="new-password">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                <button type="button" id="togglePassword" class="hidden text-gray-600 focus:outline-none">
                                                    <img src="{{ asset('assets/eye.svg') }}" id="eye" alt="Eye Icon" class="w-5 h-5">
                                                    <img src="{{ asset('assets/eye-slash.svg') }}" id="eye_slash" style="display:none;" alt="Eye Slash Icon" class="w-5 h-5">
                                                </button>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">*The password must contain at least one uppercase letter, one number, and one special character.</p>                            
                                @error('password') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="password_confirmation" class="text-xs font-semibold px-1">Confirm Password</label>
                                        <div class="relative flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                                            </div>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full -ml-10 pl-10 pr-10 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-neutral-900" placeholder="confirm new password" required autocomplete="new-password">
                                            
                                        </div>                                    
                                    </div>
                                </div>                            
                                @error('password_confirmation') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                <input type="text" name="token" value="{{ $token }}" hidden>
                                <input type="text" name="email" value="{{ $email }}" hidden>
                                <div class="flex -mx-3 mt-4">                                    
                                    <div class="w-full px-3 mb-5">
                                        <button type="submit" class="disabled:opacity-25 block w-full max-w-xs mx-auto bg-blue-800 hover:bg-blue-900 focus:bg-blue-800 text-white rounded-lg px-3 py-3 font-semibold">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
        <script>
            document.getElementById('togglePassword').addEventListener('click', function () {
                const passwordField = document.getElementById('password');
                const passwordIcon = document.getElementById('eye');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    $('#eye').hide();
                    $('#eye_slash').show();
                } else {
                    passwordField.type = 'password';
                    $('#eye').show();
                    $('#eye_slash').hide();
                }
            });
        </script>
        <script>
            $('#password').on('keyup', function () { 
                var password = $('#password').val();
                if (password.length >= 1){
                    document.getElementById('togglePassword').style.display = "block";
                }
                else{
                    document.getElementById('togglePassword').style.display = "none";
                }
            });
        </script>
    </body>
</html>