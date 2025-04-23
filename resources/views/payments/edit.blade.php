@extends('layouts.app')
@section('bodycontent')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <a href="{{ route('payments.index') }}" title="back" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" ><i class="fa-solid fa-arrow-left-long"></i></a><br><br>
                <h5 class="font-bold text-center text-gray-900 text-xl">Edit Payment</h5><br>                
                <form action="{{ route('payments.update', $payment) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="md:flex">
                        <div>
                            <div>
                                @php
                                    $students = App\Models\User::where('type', 3)->where('status', '!=', '3')->get();
                                @endphp
                                <label for="student_id">Student</label><br>
                                <select name="student_id" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="" disabled selected>Select a student from here</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}" @if($payment->student_id == $student->id) selected @endif>{{ $student->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                            @error('student_id') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="amount">Amount</label><br>
                                <input type="number" min="0" step="0.01" name="amount" id="amount" value="{{ $payment->amount }}" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="amount" required>
                                @error('amount') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            </div>
                            <br>   
                        </div>
                        <div class="md:ml-24">
                            <div>
                                <label for="note">Note</label><br>
                                <textarea name="note" id="note" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="note">{{ $payment->note}}</textarea>
                                @error('note') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            </div>
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

@push('js')
<script>
    document.getElementById('amount').addEventListener('input', function() {
        if (this.value < 0) {
            this.value = 0;
        }
    });
</script>
@endpush