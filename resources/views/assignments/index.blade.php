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
        <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                        <thead class="text-sm text-gray-800 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Class
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Subject
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Date Date
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
                            @foreach($my_assignments as $my_assignment)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-3 px-6">
                                    @if(isset($my_assignment->assignment->class))
                                        {{ $my_assignment->assignment->class->name }}
                                    @endif
                                </td>
                                <td class="py-3 px-6">
                                    @if(isset($my_assignment->assignment->class->subject))
                                        {{ $my_assignment->assignment->class->subject->name }}
                                    @endif
                                </td>
                                <td class="py-3 px-6">
                                    @if(isset($my_assignment->assignment))
                                        {{ $my_assignment->assignment->name }}
                                    @endif
                                </td>
                                <td class="py-3 px-6">
                                    @if(isset($my_assignment->assignment))
                                        {{ $my_assignment->assignment->due_date }}
                                    @endif
                                </td>
                                <td class="py-3 px-6">
                                    @if($my_assignment->status == 1)
                                    <span class="bg-gradient-to-tl from-yellow-600 to-yellow-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Pending</span>
                                    @elseif($my_assignment->status == 2)
                                    <span class="bg-gradient-to-tl from-purple-700 to-purple-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Delivered</span>
                                    @elseif($my_assignment->status == 3)
                                    <span class="bg-gradient-to-tl from-green-600 to-green-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Completed</span>
                                    @else
                                    <span class="bg-gradient-to-tl from-red-600 to-pink-400 px-2 text-xs rounded py-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Modification Requested</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6"> 
                                    <a href="{{ route('classes.submission', $my_assignment->assignment) }}" title="view" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"><img src="{{ asset('assets/folder_open.svg') }}" alt="View Icon" class="w-3 h-3"></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $my_assignments->links() }}
                </div>                                                                       
            </div>
        </div>
    </div>
</div>
@endsection
