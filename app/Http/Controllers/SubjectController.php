<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::paginate(25);
        return view('subjects.index', compact('subjects'));
    }

    public function store(Request $request)
    {
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->save();

        return redirect()->route('subjects.index')->with('status', 'New subject created successfully.');
    }

    public function update(Request $request)
    {
        $subject = Subject::find($request->id);
        $subject->name = $request->name;
        $subject->save();

        return redirect()->route('subjects.index')->with('success', 'Subject edited successfully.');
    }

    public function destroy(Request $request)
    {
        $subject = Subject::find($request->data_id);
        if($subject)
        {
            $subject->delete();
            return redirect()->route('subjects.index')->with('delete', 'Subject deleted successfully.');
        }
        else
        {
            return redirect()->route('subjects.index')->with('delete', 'No subject found!.');
        }
    }

}
