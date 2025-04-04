@extends('layouts.app')
@section('bodycontent')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <a href="{{ route('classes.index') }}" title="back" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" ><i class="fa-solid fa-arrow-left-long"></i></a><br><br>
                <h5 class="font-bold text-center text-gray-900 text-xl">Edit Class</h5><br>                
                <form action="{{ route('classes.update', $class) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="md:flex">
                        <div>
                            <div>
                                @php
                                    $teachers = App\Models\User::where('type', 2)->where('status', 1)->get();
                                @endphp
                                <label for="teacher_id">Teacher</label><br>
                                <select name="teacher_id" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="" disabled selected>Select a teacher from here</option>
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" @if($teacher->id == $class->teacher_id) selected @endif>{{ $teacher->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                            @error('teacher_id') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="name">Class Name</label><br>
                                <input type="text" name="name" value="{{ $class->name }}" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="class name" required>
                            </div>
                            @error('name') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                        </div>
                        <div class="md:ml-24">
                            <div>
                                @php
                                    $subjects = App\Models\Subject::all();
                                @endphp
                                <label for="subject_id">Subject</label><br>
                                <select name="subject_id" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="" disabled selected>Select a subject from here</option>
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" @if($subject->id == $class->subject_id) selected @endif>{{ $subject->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                            @error('subject_id') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="status">Status</label><br>
                                <select name="status" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="" disabled>Select a stauts from here</option>
                                    <option value="1" @if($class->status === 1) selected @endif>Active</option>
                                    <option value="2" @if($class->status === 2) selected @endif>Deactivated</option>
                                </select> 
                            </div>
                            @error('status') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 focus:bg-blue-900 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">Update</button>                        
                </form>
            </div>
        </div>
    </div>
</div>
@endsection