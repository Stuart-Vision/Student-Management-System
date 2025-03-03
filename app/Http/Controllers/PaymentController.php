<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $payments = Payment::all(); 
         return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $enrollments = Enrollment::pluck('enroll_no','id');
        return view('payments.create', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Payment::create($input);

        return redirect('payments')->with('flash_message', 'payment Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::findOrFail($id);
        return view('payments.show', ['payment' => $payment]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
       
        $payment= Payment::findOrFail($id);
        $enrollments = Enrollment::pluck('enroll_no','id');
        return view('payments.edit', compact('payment','enrollments'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id); 
        
        $payment->update($request->all());

        return redirect('payments')->with('flash_message', 'payment Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Payment::destroy($id);
        return redirect('payments')->with('flash_message', 'payment deleted!');
    }
}
