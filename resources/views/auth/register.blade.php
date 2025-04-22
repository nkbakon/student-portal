<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>NEXTGENEDU - Register</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <!-- font-awesome icons -->
        <script src="https://kit.fontawesome.com/2d49de291b.js" crossorigin="anonymous"></script>
        {!! NoCaptcha::renderJs() !!}
    </head>
    <body>
        <div class="min-w-screen min-h-screen bg-gradient-to-r from-blue-800 to-blue-400 flex items-center justify-center px-5 py-5">
            <div class="bg-gray-100 rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
                <div class="md:flex w-full">
                    <div class="hidden md:flex w-1/2 bg-white py-10 px-10 justify-center">                        
                        <div class="w-full mt-8">
                            <div class="flex items-center justify-center">
                                <img width="150px" height="150px" src="{{ asset('assets/logo.png') }}" alt="logo"/>
                            </div>                            
                            <img src="{{ asset('assets/form1.png') }}" alt="form">
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                        <div class="flex items-center justify-center md:hidden">
                            <img width="100px" height="100px" src="{{ asset('assets/logo.png') }}" alt="logo"/>
                        </div>   
                        <div class="text-center mb-10">
                            <h1 class="font-bold text-3xl text-gray-900">REGISTER</h1>
                            <h1 class="font-bold text-md text-gray-900">OR <a href="{{ route('login') }}" class="text-sky-500">SIGN IN</a></h1>
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
                        <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                            <div>
                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Full Name</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <input type="text" name="name" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="full name" required>
                                        </div>
                                    </div>
                                </div>
                                @error('name') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Personal Contact Number</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <input type="number" name="contact" id="contact" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="contact number" required>
                                        </div>
                                    </div>                                
                                </div>
                                <p id="danger_alert" class="text-sm text-red-500 mb-2" style="display:none;"></p>                                
                                @error('contact') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                
                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Email</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <input type="email" name="email" id="email" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="email address" required>
                                        </div>
                                    </div>
                                </div>
                                <p id="danger_alert1" class="text-sm text-red-500 mb-2" style="display:none;"></p>
                                @error('email') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                
                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">District</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <select name="district" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" required>
                                                <option value="" disabled selected>Select a district from here</option>
                                                <option value="Ampara">Ampara</option>
                                                <option value="Anuradhapura">Anuradhapura</option>
                                                <option value="Badulla">Badulla</option>
                                                <option value="Batticaloa">Batticaloa</option>
                                                <option value="Colombo">Colombo</option>
                                                <option value="Galle">Galle</option>
                                                <option value="Gampaha">Gampaha</option>
                                                <option value="Hambantota">Hambantota</option>
                                                <option value="Jaffna">Jaffna</option>
                                                <option value="Kalutara">Kalutara</option>
                                                <option value="Kandy">Kandy</option>
                                                <option value="Kegalle">Kegalle</option>
                                                <option value="Kilinochchi">Kilinochchi</option>
                                                <option value="Kurunegala">Kurunegala</option>
                                                <option value="Mannar">Mannar</option>
                                                <option value="Matale">Matale</option>
                                                <option value="Matara">Matara</option>
                                                <option value="Monaragala">Monaragala</option>
                                                <option value="Mullaitivu">Mullaitivu</option>
                                                <option value="Nuwara Eliya">Nuwara Eliya</option>
                                                <option value="Polonnaruwa">Polonnaruwa</option>
                                                <option value="Puttalam">Puttalam</option>
                                                <option value="Ratnapura">Ratnapura</option>
                                                <option value="Trincomalee">Trincomalee</option>
                                                <option value="Vavuniya">Vavuniya</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                                @error('district') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror

                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Address</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <input type="text" name="address" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="address" required>
                                        </div>
                                    </div>
                                </div>
                                @error('address') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror

                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Date of Birth</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <input type="date" name="dob" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="date of birth" required>
                                        </div>
                                    </div>
                                </div>
                                @error('dob') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                
                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Exam</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <select name="exam" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" required>
                                                <option value="" disabled selected>Select a exam from here</option>
                                                <option value="1">O/L</option>
                                                <option value="2">A/L</option>
                                                <option value="3">Other</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                                @error('exam') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror

                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Gender</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <select name="gender" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" required>
                                                <option value="" disabled selected>Select a gender from here</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                                <option value="3">Other</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                                @error('gender') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror

                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Parent Name</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <input type="text" name="parent_name" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="parent name" required>
                                        </div>
                                    </div>
                                </div>
                                @error('parent_name') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror

                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Parent Contact Number</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <input type="text" name="parent_contact" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="parent contact number" required>
                                        </div>
                                    </div>
                                </div>
                                @error('parent_contact') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror

                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Parent Name (Optional)</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <input type="text" name="parent_name2" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="parent name">
                                        </div>
                                    </div>
                                </div>
                                @error('parent_name2') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror

                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Parent Contact Number (Optional)</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                            <input type="number" name="parent_contact2" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="parent contact number">
                                        </div>
                                    </div>
                                </div>
                                @error('parent_contact2') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror

                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Expected Subjects</label>
                                        @php
                                            $subjects = App\Models\Subject::all();
                                        @endphp
                                        <div class="flex flex-wrap">
                                            @foreach($subjects as $subject)
                                                <div class="w-1/3 p-2 flex items-center">
                                                    <input id="subject-{{ $subject->id }}" type="checkbox" name="subjects[]" value="{{ $subject->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="subject-{{ $subject->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $subject->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @error('address') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror

                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-2">
                                        <label for="password" class="text-xs font-semibold px-1 text-black">Password</label>
                                        <div class="relative flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                                            </div>
                                            <input type="password" name="password" id="password" class="w-full -ml-10 pl-10 pr-10 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="password" required>
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                <button type="button" id="togglePassword" class="hidden text-gray-600 focus:outline-none">
                                                    <img src="{{ asset('assets/eye.svg') }}" id="eye" alt="Eye Icon" class="w-5 h-5">
                                                    <img src="{{ asset('assets/eye-slash.svg') }}" id="eye_slash" style="display:none;" alt="Eye Slash Icon" class="w-5 h-5">
                                                </button>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>  
                                <p class="text-sm text-gray-600 mb-2 text-black">*The password must contain at least one uppercase letter, <br> one number, and one special character.</p>
                                @error('password') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                <div class="flex -mx-3">
                                    <div class="w-full px-3 mb-8">
                                        <label for="" class="text-xs font-semibold px-1 text-black">Confirm Password</label>
                                        <div class="flex">
                                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                            <input type="password" name="confirm_password" id="cmpassword" autocomplete="new-password" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="confirm password" required>
                                        </div>
                                        <span id='passwordcheck'></span>
                                    </div>
                                </div>                                
                                @error('confirm_password') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                <!-- Honeypot field -->
                                <input type="text" name="website" style="display:none;" tabindex="-1" autocomplete="off">
                                    
                                <!-- Google reCAPTCHA -->
                                <div class="flex -mx-3 mb-4 mt-4">
                                    <div class="w-full px-3 mb-2">
                                        {!! NoCaptcha::display() !!}
                                        @error('g-recaptcha-response')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex -mx-3 mt-4">
                                    <div class="w-full px-3 mb-5">
                                        <button type="submit" class="passwordvalid disabled:opacity-25 block w-full max-w-xs mx-auto bg-blue-800 hover:bg-blue-900 focus:bg-blue-800 text-white rounded-lg px-3 py-3 font-semibold">REGISTER NOW</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#contact').change(function() {
                    document.getElementById('danger_alert').style.display = "none";
                    var contact = $(this).val();
                    if (contact.length >= 3){
                        $.ajax({
                            type: 'GET',
                            url: '/register/contact/check',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "contact": contact
                            },
                            success: function(response) {
                                if (response.success) {
                                    $(".passwordvalid").attr('disabled', false);

                                } else {
                                    document.getElementById('danger_alert').innerHTML = "Already Registered Number!"
                                    document.getElementById('danger_alert').style.display = "block";
                                    $(".passwordvalid").attr('disabled', true);
                                }


                            },
                            error: function(data) {
                                console.log('Something went wrong!');
                                document.getElementById('danger_alert').innerHTML = "Already Registered Number!"
                                document.getElementById('danger_alert').style.display = "block";
                                $(".passwordvalid").attr('disabled', true);
                            }
                        });
                    }
                });

                $('#email').change(function() {
                    document.getElementById('danger_alert1').style.display = "none";
                    var email = $(this).val();
                    if (email.length >= 3){
                        $.ajax({
                            type: 'GET',
                            url: '/register/email/check',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "email": email
                            },
                            success: function(response) {
                                if (response.success) {
                                    $(".passwordvalid").attr('disabled', false);

                                } else {
                                    document.getElementById('danger_alert1').innerHTML = "Already Registered User!"
                                    document.getElementById('danger_alert1').style.display = "block";
                                    $(".passwordvalid").attr('disabled', true);
                                }


                            },
                            error: function(data) {
                                console.log('Something went wrong!');
                                document.getElementById('danger_alert1').innerHTML = "Already Registered User!"
                                document.getElementById('danger_alert1').style.display = "block";
                                $(".passwordvalid").attr('disabled', true);
                            }
                        });
                    }
                });
            });
        </script>
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
            $('#password, #cmpassword').on('keyup', function () { 
            var password = $('#password').val();
            if (password.length >= 1){
                document.getElementById('togglePassword').style.display = "block";
            }
            else{
                document.getElementById('togglePassword').style.display = "none";
            }
            if ($('#password').val() == $('#cmpassword').val()) {
                $('#passwordcheck').html('');
                $(".passwordvalid").attr('disabled', false);
            }
            else if($('#cmpassword').val() == ''){
                $('#passwordcheck').html('');
            }
            else { 
                $('#passwordcheck').html('Passwords Not Matching').css('color', 'red');
                $(".passwordvalid").attr('disabled', true);
            }
            if ($('#password').val() == '' && $('#cmpassword').val() == '') {
                $('#passwordcheck').html('');
            }  
            });
        </script>
    </body>
</html>