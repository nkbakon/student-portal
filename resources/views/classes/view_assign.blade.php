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
                <a href="{{ route('classes.view', $class) }}" title="back" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" ><i class="fa-solid fa-arrow-left-long"></i></a><br><br>
                <br>
                <h1 class="text-center text-xl text-gray-700">Student Details</h1>
                <p class="text-left text-xl text-gray-700 font-bold">Class: {{ $class->name }}</p><br>
                <div class="py-5 bg-gray-200 px-5 rounded-lg">
                    <p class="text-base font-bold text-gray-700">Teacher: {{ $class->teacher->name }}</p>
                    <p class="text-gray-700">Subject: {{ $class->subject->name }}</p> 
                </div><br>
                <div class="py-5 bg-gray-200 px-5 rounded-lg md:flex">
                    <div>
                        <p class="text-base font-bold text-gray-700">Name: {{ $assign->student->name }}</p>
                        <p class="text-gray-700">Gender: @if($assign->student->gender === 1) Male @elseif($assign->student->gender === 2) Female @else Other @endif</p> 
                        <p class="text-gray-700">Contact: {{ $assign->student->contact }}</p> 
                        <p class="text-gray-700">Date of Birth: {{ $assign->student->dob }}</p> 
                        <p class="text-gray-700">District: {{ $assign->student->district }}</p> 
                        <p class="text-gray-700">Address: {{ $assign->student->address }}</p> 
                    </div>
                    <div class="md:ml-24">
                        <p class="text-base font-bold text-gray-700">Email: {{ $assign->student->email }}</p> 
                        <p class="text-gray-700">Exam: @if($assign->student->exam === 1) O/L @elseif($assign->student->exam === 2) A/L @else Other @endif</p>                         
                        <p class="text-gray-700">Parent Name: {{ $assign->student->parent_name }}</p> 
                        <p class="text-gray-700">Parent Contact Number: {{ $assign->student->parent_contact }}</p> 
                        <p class="text-gray-700">Parent Name (Optional): {{ $assign->student->parent_name2 }}</p> 
                        <p class="text-gray-700">Parent Contact Number (Optional): {{ $assign->student->parent_contact2 }}</p>
                    </div>
                </div><br>
            </div>
        </div>
    </div>
</div>
@endsection
