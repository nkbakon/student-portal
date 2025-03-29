@extends('layouts.app')
@section('bodycontent')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <a href="{{ route('users.staff') }}" title="back" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" ><i class="fa-solid fa-arrow-left-long"></i></a><br><br>
                <h5 class="font-bold text-center text-gray-900 text-xl">Edit Staff</h5><br>                 
                <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="flex">
                        <div>
                            <div>
                                <label for="name">Full Name</label><br>
                                <input type="text" name="name" value="{{ $user->name }}" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="full name" required>
                            </div>
                            @error('name') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>                            
                            <div>
                                <label for="email">Email</label><br>
                                <input type="text" name="email" id="email" value="{{ $user->email }}" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="email" required>
                            </div>
                            <p id="danger_alert1" class="text-sm text-red-500 mb-2" style="display:none;"></p>
                            @error('email') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="district">District</label><br>
                                <select name="district" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="" disabled selected>Select a district from here</option>
                                    <option value="Ampara" @if($user->district == "Ampara") selected @endif>Ampara</option>
                                    <option value="Anuradhapura" @if($user->district == "Anuradhapura") selected @endif>Anuradhapura</option>
                                    <option value="Badulla" @if($user->district == "Badulla") selected @endif>Badulla</option>
                                    <option value="Batticaloa" @if($user->district == "Batticaloa") selected @endif>Batticaloa</option>
                                    <option value="Colombo" @if($user->district == "Colombo") selected @endif>Colombo</option>
                                    <option value="Galle" @if($user->district == "Galle") selected @endif>Galle</option>
                                    <option value="Gampaha" @if($user->district == "Gampaha") selected @endif>Gampaha</option>
                                    <option value="Hambantota" @if($user->district == "Hambantota") selected @endif>Hambantota</option>
                                    <option value="Jaffna" @if($user->district == "Jaffna") selected @endif>Jaffna</option>
                                    <option value="Kalutara" @if($user->district == "Kalutara") selected @endif>Kalutara</option>
                                    <option value="Kandy" @if($user->district == "Kandy") selected @endif>Kandy</option>
                                    <option value="Kegalle" @if($user->district == "Kegalle") selected @endif>Kegalle</option>
                                    <option value="Kilinochchi" @if($user->district == "Kilinochchi") selected @endif>Kilinochchi</option>
                                    <option value="Kurunegala" @if($user->district == "Kurunegala") selected @endif>Kurunegala</option>
                                    <option value="Mannar" @if($user->district == "Mannar") selected @endif>Mannar</option>
                                    <option value="Matale" @if($user->district == "Matale") selected @endif>Matale</option>
                                    <option value="Matara" @if($user->district == "Matara") selected @endif>Matara</option>
                                    <option value="Monaragala" @if($user->district == "Monaragala") selected @endif>Monaragala</option>
                                    <option value="Mullaitivu" @if($user->district == "Mullaitivu") selected @endif>Mullaitivu</option>
                                    <option value="Nuwara Eliya" @if($user->district == "Nuwara Eliya") selected @endif>Nuwara Eliya</option>
                                    <option value="Polonnaruwa" @if($user->district == "Polonnaruwa") selected @endif>Polonnaruwa</option>
                                    <option value="Puttalam" @if($user->district == "Puttalam") selected @endif>Puttalam</option>
                                    <option value="Ratnapura" @if($user->district == "Ratnapura") selected @endif>Ratnapura</option>
                                    <option value="Trincomalee" @if($user->district == "Trincomalee") selected @endif>Trincomalee</option>
                                    <option value="Vavuniya" @if($user->district == "Vavuniya") selected @endif>Vavuniya</option>
                                </select>  
                            </div>
                            @error('district') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="address">Address</label><br>
                                <input type="text" name="address" value="{{ $user->address }}" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="address" required>
                            </div>
                            @error('address') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="status">Account Status</label><br>
                                <select name="status" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="" disabled>Select an account stauts from here</option>
                                    <option value="3" @if($user->status === 3) selected @endif>Pending</option>
                                    <option value="1" @if($user->status === 1) selected @endif>Active</option>
                                    <option value="2" @if($user->status === 2) selected @endif>Deactivated</option>
                                </select> 
                            </div>
                            @error('status') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                        </div>
                        <div class="ml-24">
                            <div>
                                <label for="type">Select Staff Type</label><br>
                                <select name="type" id="type" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required onchange="toggleUser()">
                                    <option value="" disabled selected>Select type from here</option>
                                    <option value="1" @if($user->type === 1) selected @endif>Admin</option>
                                    <option value="2" @if($user->type === 2) selected @endif>Teacher</option>
                                </select> 
                            </div>
                            @error('type') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="contact">Contact Number</label><br>
                                <input type="number" name="contact" id="contact" value="{{ $user->contact }}" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="contact number" required>
                            </div>
                            <p id="danger_alert2" class="text-sm text-red-500 mb-2" style="display:none;"></p>
                            @error('contact') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>                            
                            <div>
                                <label for="gender">Gender</label><br>
                                <select name="gender" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="" disabled selected>Select a gender from here</option>
                                    <option value="1" @if($user->gender === 1) selected @endif>Male</option>
                                    <option value="2" @if($user->gender === 2) selected @endif>Female</option>
                                    <option value="3" @if($user->gender === 3) selected @endif>Other</option>
                                </select> 
                            </div>
                            @error('gender') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>                            
                            <div id="teach_subjects">
                                <label for="subjects" class="mb-4">Subjects to Teach</label><br>
                                @php
                                    $subjects = App\Models\Subject::all();
                                    $teach_subjects = App\Models\TeacherSubject::where('teacher_id', $user->id)->pluck('subject_id')->toArray(); 
                                @endphp
                                <div class="flex flex-wrap">
                                    @foreach($subjects as $subject)
                                        <div class="w-1/3 p-2 flex items-center">
                                            <input id="subject-{{ $subject->id }}" 
                                                type="checkbox" 
                                                name="subjects[]" 
                                                value="{{ $subject->id }}" 
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                {{ in_array($subject->id, $teach_subjects) ? 'checked' : '' }}>
                                            <label for="subject-{{ $subject->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                {{ $subject->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="passwordvalid disabled:opacity-25 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 focus:bg-blue-900 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">Update</button>                        
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        function toggleUser() {
            var type = document.getElementById('type').value;
            
            if (type == "1") {
                $('#teach_subjects').hide();
            } else {
                $('#teach_subjects').show();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleUser();
        });
    </script>
@endpush