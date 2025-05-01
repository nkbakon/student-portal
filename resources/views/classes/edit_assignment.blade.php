@extends('layouts.app')
@section('bodycontent')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <a href="{{ route('classes.view_assignment', $assignment->class) }}" title="back" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" ><i class="fa-solid fa-arrow-left-long"></i></a><br><br>
                <h5 class="font-bold text-center text-gray-900 text-xl">Edit Assignment</h5><br>                
                <form action="{{ route('classes.update_assignment', $assignment) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="md:flex">
                        <div>
                            <div>
                                <label for="name">Assignment Name</label><br>
                                <input type="text" name="name" value="{{ $assignment->name }}" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="assignment name" required>
                            </div>
                            @error('name') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="zoom">Zoom Link</label><br>
                                <input type="text" name="zoom" value="{{ $assignment->zoom }}" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="zoom link">
                            </div>
                            @error('zoom') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="whatsapp">WhatsApp Link</label><br>
                                <input type="text" name="whatsapp" value="{{ $assignment->whatsapp }}" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="whatsapp link">
                            </div>
                            @error('whatsapp') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>                              
                            <div>
                                <label for="note">Note</label><br>
                                <textarea name="note" id="note" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="note">{{ $assignment->note }}</textarea>
                            </div>
                            @error('note') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>                              
                        </div>
                        <div class="md:ml-24">
                            <div>
                                <label for="due_date">Due Date</label><br>
                                <input type="date" name="due_date" id="due_date" value="{{ $assignment->due_date }}" class="block w-48 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
                            </div>
                            @error('due_date') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="youtube">YouTube Link</label><br>
                                <input type="text" name="youtube" value="{{ $assignment->youtube }}" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="youtube link">
                            </div>
                            @error('youtube') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            @if($assignment->attachment != null)
                            <div class="existothers">
                                <label>Assignment Attachment</label><br>
                                <div class="flex overflow-x-auto space-x-2">                              
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
                                    <p class="text-gray-700 text-sm">{{ $assignment->file_name }}</p>
                                </div><br>
                                @if(auth()->user()->type != '3')
                                <div>
                                    <button type="button" id="removeOthers" title="change attachment" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">
                                        Remove
                                    </button>
                                </div>
                                @endif
                            </div>
                            <div class="addothers hidden">
                                <div>
                                    <label for="update_attachment">Assignment Attachment</label><br>
                                    <input type="file" name="update_attachment" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                </div>
                                @error('update_attachment') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            </div>
                            @else
                            <div>
                                <label for="update_attachment">Assignment Attachment</label><br>
                                <input type="file" name="update_attachment" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            </div>
                            @error('update_attachment') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            @endif
                            <input type="hidden" name="attachments_remove" id="attachments_remove" value="">
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
    // Get today's date in YYYY-MM-DD format
    let today = {{ $assignment->due_date }};
    // Set the min attribute of the date input
    document.getElementById("due_date").setAttribute("min", today);

    $('#removeOthers').on('click', function()
    {
        $('.existothers').hide();
        $('.addothers').show();
        $('#attachments_remove').val(1);
    });
</script>
@endpush