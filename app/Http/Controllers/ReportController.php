<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function report1($pid)
    {
        $payment = Payment::findOrFail($pid); // Use `findOrFail` to handle missing records
       
        $print = "<div style='margin:20px;padding:20px;'>";
        $print .= "<h1 align='center'> Payment Receipt </h1>";
        $print .= "<hr/>";
        $print .= "<p>Receipt No: <b>" . $pid . "</b></p>";
        $print .= "<p>Date: <b>" . $payment->paid_date . "</b></p>";
        $print .= "<p>Enrollment No: <b>" . $payment->enrollment->enroll_no . "</b></p>";
        $print .= "<p>Student Name: <b>" . $payment->enrollment->student->name . "</b></p>";
        $print .= "<hr/>";
        
        // Table Header
        $print .= "<table style='width:100%; border-collapse: collapse;'>";
        $print .= "<tr><th>Description</th><th>Amount</th></tr>";

        // Payment Details
        $print .= "<tr>";
        $print .= "<td> <h3>" . $payment->enrollment->batch->name . "</h3></td>";
        $print .= "<td> <h3>" . $payment->amount . "</h3></td>";
        $print .= "</tr>";
        $print .= "</table>";

        $print .= "<hr/>";

        // Footer Information
        $print .= "<p>Printed By: <b>" . (Auth::check() ? Auth::user()->name : 'Guest') . "</b></p>";

        $print .= "<p>Printed Date: <b>" . date('Y-m-d') . "</b></p>";

        $print .= "</div>";

        // Generate PDF
        $pdf = Pdf::loadHTML($print);
        return $pdf->stream('receipt.pdf');
    }
}
