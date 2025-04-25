<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cashout;

class CashOutController extends Controller
{
    public function index()
    {
        if(auth()->user()->type == '1'){
            $cashouts = Cashout::orderBy('id', 'desc')->paginate(25);
        }else{
            $cashouts = Cashout::where('teacher_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(25);
        }

        return view('cashouts.index', compact('cashouts'));
    }

    public function create()
    {
        return view('cashouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'amount' => 'required',
        ]);

        $cashout = new Cashout();
        $cashout->teacher_id = $request->teacher_id;
        $cashout->amount = $request->amount;
        $cashout->note = $request->note;
        $cashout->save();

        $teacher = User::find($request->teacher_id);
        $teacher->last_payment_date = now()->toDateString();
        $teacher->save();

        if($cashout){
            return redirect()->route('cashouts.index')->with('status', 'Cash out stored successfully.');        
        }
        return redirect()->route('cashouts.index')->with('delete', 'Cash out store faild, try again!');
    }

    public function edit(Cashout $cashout)
    {
        return view('cashouts.edit', compact('cashout'));
    }

    public function update(Request $request, Cashout $cashout)
    {
        $request->validate([
            'teacher_id' => 'required',
            'amount' => 'required',
        ]);

        $cashout->teacher_id = $request->teacher_id;
        $cashout->amount = $request->amount;
        $cashout->note = $request->note;
        $cashout->save();
        
        return redirect()->route('cashouts.index')->with('success', 'Cash out updated successfully.');
    }

    public function destroy(Request $request)
    {
        $cashout = Cashout::find($request->data_id);
        if($cashout)
        {
            $cashout->delete();

            $last_payment = Cashout::where('teacher_id', $cashout->teacher_id)->orderBy('id', 'desc')->first();
            if($last_payment != null){
                $last_payment_date = $last_payment->created_at->format('Y-m-d');
            }else{
                $last_payment_date = null;
            }
        
            $teacher = User::find($payment->teacher_id);
            if($teacher){
                $teacher->last_payment_date = $last_payment_date;
                $teacher->save();
            }

            return redirect()->route('cashouts.index')->with('delete', 'Cash out deleted successfully.');
        }
        else
        {
            return redirect()->route('cashouts.index')->with('delete', 'No cash out found!.');
        }    
    }

    public function view(Cashout $cashout)
    {
        return view('cashouts.view', compact('cashout'));
        
    }
}
