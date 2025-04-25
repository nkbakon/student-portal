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
                <a href="{{ route('cashouts.index') }}" title="back" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" ><i class="fa-solid fa-arrow-left-long"></i></a><br><br>
                <br>
                <h1 class="text-center text-xl text-gray-700">Cash Out Details</h1>
                <p class="text-left text-xl text-gray-700 font-bold">#: {{ $cashout->id }}</p><br>
                <div class="py-5 bg-gray-200 px-5 rounded-lg">
                    <p class="text-base font-bold text-gray-700">Teacher: @if(isset($cashout->teacher)) {{ $cashout->teacher->name }} @endif</p>
                    <p class="text-gray-700">Email: @if(isset($cashout->teacher)) {{ $cashout->teacher->email }} @endif</p> 
                    <p class="text-gray-700">Date: {{ $cashout->created_at->format('Y-m-d') }}</p> 
                    <p class="text-gray-700">Amount: {{ $cashout->amount }}</p> 
                    <p class="text-gray-700">Note: {{ $cashout->note }}</p> 
                    <p class="text-gray-700">Last Payment Date: @if(isset($cashout->teacher)) {{ $cashout->teacher->last_payment_date }} @endif</p> 
                </div><br>
            </div>
        </div>
    </div>
</div>
@endsection
