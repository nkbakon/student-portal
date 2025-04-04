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
                <a href="{{ route('classes.index') }}" title="back" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" ><i class="fa-solid fa-arrow-left-long"></i></a><br><br>
                <br>
                <h1 class="text-center text-xl text-gray-700">Class Details</h1>
                <p class="text-left text-xl text-gray-700 font-bold">{{ $class->name }}</p><br>
                <div class="py-5 bg-gray-200 px-5 rounded-lg">
                    <p class="text-base font-bold text-gray-700">Teacher: {{ $class->teacher->name }}</p>
                    <p class="text-gray-700">Subject: {{ $class->subject->name }}</p> 
                </div><br>
                <nav class="bg-gray-200 dark:bg-gray-700">
                    <div class="max-w-screen-xl px-4 py-3 mx-auto md:px-6 flex justify-center">
                        <div class="flex items-center">
                            <ul class="flex flex-row mt-0 mr-6 space-x-4 text-sm font-medium">
                                <li>
                                    <a href="{{ route('classes.view', $class) }}" class="px-3 py-1 flex space-x-2 rounded-md border border-blue-500 cursor-pointer hover:bg-blue-500 hover:border-blue-500 hover:text-white">Students</a>
                                </li>
                                <li>
                                    <a href="{{ route('classes.view_assignment', $class) }}" class="bg-blue-800 border-blue-800 text-white px-3 py-1 flex space-x-2 rounded-md border border-blue-500 cursor-pointer hover:bg-blue-500 hover:border-blue-500 hover:text-white">Assignments</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav><br>
                <div id="assignment_section">
                    <a href="{{ route('classes.assignment', $class) }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 focus:bg-blue-900 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 transition ease-in-out duration-150">Add Assignment</a><br><br>
                    @if($assignment_count > 0)
                    <div class="overflow-x-auto">
                        <h1 class="text-center text-xl text-gray-700">Assignments</h1>
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                            <thead class="text-sm text-gray-800 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        #
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Due Date
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Status
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignments as $assignment)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">                                    
                                    <td class="py-3 px-6">
                                        {{ $assignment->id }}
                                    </td>
                                    <td class="py-3 px-6">
                                        {{ $assignment->name }}
                                    </td>
                                    <td class="py-3 px-6">
                                        {{ $assignment->due_date }}
                                    </td>
                                    <td class="py-3 px-6">
                                        @if($assignment->status == 1)
                                        <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Active</span>
                                        @else
                                        <span class="bg-gradient-to-tl from-red-600 to-pink-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Deactivated</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6">
                                        <a href="{{ route('classes.view', $assignment) }}" title="view" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"><img src="{{ asset('assets/folder_open.svg') }}" alt="View Icon" class="w-3 h-3"></a>
                                        <a href="{{ route('classes.edit', $class) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150"><img src="{{ asset('assets/edit.svg') }}" alt="Edit Icon" class="w-3 h-3"></a> 
                                        <button type="button" value="{{ $assignment->id }}" data-modal-toggle="deletePost" class="deleteBtn inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"><img src="{{ asset('assets/trash.svg') }}" alt="Delete Icon" class="w-3 h-3"></button>                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $assignments->links() }}
                    </div>       
                    @endif 
                </div>                                                                   
            </div>
        </div>
    </div>
</div>

<!-- Delete modal -->
<div id="deletePost" tabindex="-1" class="bg-opacity-50 fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="deletePost">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <form method="POST" action="{{ route('classes.destroyAssign', $class) }}">
                    @csrf
                    @method('DELETE')
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this data?</h3>
                    <input type="hidden" name="data_id"  id="data_id"> 
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, Delete
                    </button>
                    <button data-modal-toggle="deletePost" type="button" class="text-white bg-gray-400 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('.deleteBtn').click(function (e){
            e.preventDefault();
            
            var data_id = $(this).val();
            $('#data_id').val(data_id);
        });
    });
</script>
@endpush