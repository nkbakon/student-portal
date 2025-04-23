@extends('layouts.app')
@section('bodycontent')

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

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <a href="{{ route('classes.submission', $student_assignment->assignment) }}" title="back" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" ><i class="fa-solid fa-arrow-left-long"></i></a><br><br>
                <br>
                <h1 class="text-center text-xl text-gray-700">Submission</h1>
                <p class="text-left text-xl text-gray-700 font-bold">Student: {{ $student_assignment->student->name }}</p><br>
                <div class="py-5 bg-gray-200 px-5 rounded-lg">
                    <p class="text-base font-bold text-gray-700">Email: {{ $student_assignment->student->email }}</p>
                    <p class="text-gray-700">Status: 
                        @if($student_assignment->status == 1)
                        <span class="bg-gradient-to-tl from-yellow-600 to-yellow-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Pending</span>
                        @elseif($student_assignment->status == 2)
                        <span class="bg-gradient-to-tl from-purple-700 to-purple-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Delivered</span>
                        @elseif($student_assignment->status == 3)
                        <span class="bg-gradient-to-tl from-green-600 to-green-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Completed</span>
                        @else
                        <span class="bg-gradient-to-tl from-red-600 to-pink-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Modification Requested</span>
                        @endif
                    </p> 
                </div><br>
                <div class="flex justify-between"> 
                    <div>
                        @if($student_assignment->submission != null)
                        <p class="text-gray-700">Submission</p>
                        <div class="py-5 bg-gray-100 px-5 rounded-lg w-96">                                
                            @php
                                $fileExtension = pathinfo($student_assignment->file_name, PATHINFO_EXTENSION);
                            @endphp
                            @if ($fileExtension == "pdf")
                                <img class="h-6 w-6" src="{{ asset('assets/pdf.png') }}">
                            @elseif ($fileExtension == "xls" || $fileExtension == "xlsx")
                                <img class="h-6 w-6" src="{{ asset('assets/xls.png') }}">
                            @elseif ($fileExtension == "doc" || $fileExtension == "docx")
                                <img class="h-6 w-6" src="{{ asset('assets/doc.png') }}">
                            @elseif ($fileExtension == "jpg" || $fileExtension == "jpeg")
                                <img class="h-6 w-6" src="{{ asset('assets/jpg.png') }}">
                            @elseif ($fileExtension == "png")
                                <img class="h-6 w-6" src="{{ asset('assets/png.png') }}">
                            @elseif ($fileExtension == "ppt" || $fileExtension == "pptx")
                                <img class="h-6 w-6" src="{{ asset('assets/ppt.png') }}">
                            @elseif ($fileExtension == "txt")
                                <img class="h-6 w-6" src="{{ asset('assets/txt.png') }}">
                            @else
                                <img class="h-6 w-6" src="{{ asset('assets/file.png') }}">
                            @endif
                            <a href="{{ asset('storage') }}/{{ $student_assignment->submission }}" target="_blank"><p class="text-gray-700 text-sm mb-2">{{ $student_assignment->file_name }}</p></a>
                        </div><br>
                        @endif
                    </div>
                    <div>
                        @if($student_assignment->comment != null)
                        <div class="py-5 bg-gray-100 px-5 rounded-lg w-96">
                            <p class="text-gray-700">Comment: {{ $student_assignment->comment }}</p>
                        </div><br>
                        @endif
                    </div>
                </div><br>
                <div>
                    @if(auth()->user()->type != '3')
                        <div class="relative inline-block w-full">
                            <form action="{{ route('classes.checkSubmission', $student_assignment) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <label for="" class="text-md font-semibold px-1 text-gray-800 mb-4">Check Submission</label>
                                <div class="mt-2">
                                    <div>
                                        <label for="comment">Teacher's Comment</label><br>
                                        <textarea name="comment" id="comment" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="comment..."></textarea>
                                    </div>
                                    @error('comment') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                    <div>
                                        <label for="status">Status</label><br>
                                        <select name="status" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
                                            <option value="" disabled selected>Select a status from here</option>
                                            <option value="3">Complete</option>
                                            <option value="4">Request Modification</option>
                                        </select> 
                                    </div>
                                    @error('status') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                    <div>
                                        <button type="submit" title="mark checked" class="mt-4 ml-4 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Mark Checked</button>
                                    </div>
                                </div>                            
                            </form>
                        </div><br><br>
                    @endif
                </div>                                                                   
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush