<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('id', 'desc')->paginate(25);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'amount' => 'required',
        ]);

        $payment = new Payment();
        $payment->student_id = $request->student_id;
        $payment->amount = $request->amount;
        $payment->note = $request->note;
        $payment->save();

        $student = User::find($request->student_id);
        $student->last_payment_date = now()->toDateString();
        $student->status = 1;
        $student->save();

        if($payment){
            return redirect()->route('payments.index')->with('status', 'Payment stored successfully.');        
        }
        return redirect()->route('payments.index')->with('delete', 'Payment store faild, try again!');
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'student_id' => 'required',
            'amount' => 'required',
        ]);

        $payment->student_id = $request->student_id;
        $payment->amount = $request->amount;
        $payment->note = $request->note;
        $payment->save();
        
        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Request $request)
    {
        $payment = Payment::find($request->data_id);
        if($payment)
        {
            $payment->delete();

            $last_payment = Payment::where('student_id', $payment->student_id)->orderBy('id', 'desc')->first();
            if($last_payment != null){
                $last_payment_date = $last_payment->created_at->format('Y-m-d');
            }else{
                $last_payment_date = null;
            }
        
            $student = User::find($payment->student_id);
            if($student){
                $student->last_payment_date = $last_payment_date;
                $student->save();
            }

            return redirect()->route('payments.index')->with('delete', 'Payment deleted successfully.');
        }
        else
        {
            return redirect()->route('payments.index')->with('delete', 'No payment found!.');
        }    
    }

    public function view(Payment $payment)
    {
        return view('payments.view', compact('payment'));
        
    }
}
