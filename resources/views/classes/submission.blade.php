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
                <a href="{{ route('classes.view_assignment', $assignment->class) }}" title="back" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" ><i class="fa-solid fa-arrow-left-long"></i></a><br><br>
                <br>
                <h1 class="text-center text-xl text-gray-700">Assignment</h1>
                <p class="text-left text-xl text-gray-700 font-bold">{{ $assignment->name }}</p><br>
                <div class="py-5 bg-gray-200 px-5 rounded-lg">
                    <p class="text-base font-bold text-gray-700">Due Date: {{ $assignment->due_date }}</p>
                    <p class="text-gray-700">Status: 
                        @if($assignment->status == 1)
                        <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Active</span>
                        @else
                        <span class="bg-gradient-to-tl from-red-600 to-pink-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Deactivated</span>
                        @endif
                    </p> 
                </div><br>
                <div class="flex justify-between"> 
                    <div>
                        @if($assignment->attachment != null)
                        <p class="text-gray-700">Attachment</p>
                        <div class="py-5 bg-gray-100 px-5 rounded-lg w-96">                                
                            @php
                                $fileExtension = pathinfo($assignment->file_name, PATHINFO_EXTENSION);
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
                            <a href="{{ asset('storage') }}/{{ $assignment->attachment }}" target="_blank"><p class="text-gray-700 text-sm mb-2">{{ $assignment->file_name }}</p></a>
                        </div><br>
                        @endif
                    </div>
                    <div>
                        @if($assignment->note != null)
                        <div class="py-5 bg-gray-100 px-5 rounded-lg w-96">
                            <p class="text-gray-700">Note: {{ $assignment->note }}</p>
                        </div><br>
                        @endif
                    </div>
                </div><br>
                <div>
                    @if(auth()->user()->type == '3' && $my_submission->status != '2' && $my_submission->status != '3')
                    <div class="relative inline-block w-full">
                        <form action="{{ route('classes.storeSubmission', $my_submission) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <label for="" class="text-md font-semibold px-1 text-gray-800 mb-2">My Submission</label>
                            <div>
                                <div>
                                    <input type="file" name="submission" class="w-96 ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" required>
                                </div>
                                @error('submission') <span class="text-red-500 error mb-2">{{ $message }}</span><br> @enderror
                                <div>
                                    <button type="submit" title="submit assignment" class="mt-4 ml-4 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Submit Assignment</button>
                                </div>
                            </div>                            
                        </form>
                    </div><br><br>
                    @endif
                    @if(sizeof($student_assignments) > 0)
                    <div class="overflow-x-auto">
                        <h1 class="text-center text-xl text-gray-700">Submissions</h1>
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                            <thead class="text-sm text-gray-800 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Email
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
                                @foreach($student_assignments as $student_assignment)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-3 px-6">
                                        {{ $student_assignment->student->name }}
                                    </td>
                                    <td class="py-3 px-6">
                                        {{ $student_assignment->student->email }}
                                    </td>
                                    <td class="py-3 px-6">
                                        @if($student_assignment->status == 1)
                                        <span class="bg-gradient-to-tl from-yellow-600 to-yellow-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Pending</span>
                                        @elseif($student_assignment->status == 2)
                                        <span class="bg-gradient-to-tl from-purple-700 to-purple-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Delivered</span>
                                        @elseif($student_assignment->status == 3)
                                        <span class="bg-gradient-to-tl from-green-600 to-green-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Completed</span>
                                        @else
                                        <span class="bg-gradient-to-tl from-red-600 to-pink-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Modification Requested</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6">
                                        <a href="{{ route('classes.submission', $assignment) }}" title="view" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"><img src="{{ asset('assets/folder_open.svg') }}" alt="View Icon" class="w-3 h-3"></a>
                                        <button type="button" value="{{ $assignment->id }}" data-modal-toggle="deletePost" class="deleteBtn inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"><img src="{{ asset('assets/trash.svg') }}" alt="Delete Icon" class="w-3 h-3"></button>                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $student_assignments->links() }}
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
                <form method="POST" action="{{ route('classes.destroyAssign', $assignment) }}">
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