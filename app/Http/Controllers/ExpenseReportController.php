<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseReport;
use Illuminate\Support\Facades\Mail;
use App\Mail\SummaryReport;

class ExpenseReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return view('expenseReport.index', ['expenseReports'=>expenseReport::all()]);
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenseReport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validData= $request->validate([
            'title'=>'required|min:3'
       ]);
        $report= new ExpenseReport();
        $report->title = $request->get('title');
        $report->save();

        return redirect('/expense_reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseReport $expenseReport)
    {
        return view('expenseReport.show', ['report'=>$expenseReport]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $report=expenseReport::findOrFail($id);
        return view('expenseReport.edit', ['report'=>$report]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validData= $request->validate([
            'title'=>'required|min:3'
       ]);

        $report=Expensereport::find($id);
        $report->title=$request->get('title');
        $report->save();

        return redirect('/expense_reports');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report=Expensereport::find($id);
        $report->delete();
        return redirect('/expense_reports');
    }

    public function confirmDelete($id){
        $report=expenseReport::find($id);
        return view('expenseReport.confirmDelete', [
           'report'=>$report
        ]);
    }

    public function confirmSendMail($id){
        $report=ExpenseReport::find($id);
        return view('expenseReport.confirmSendMail', [
           'report'=>$report
        ]);
    }

    public function sendMail(Request $request, $id)
    {
        $report = ExpenseReport::find($id);

        // Retrieve sender email and name from the form
        $senderEmail = $request->input('sender_email');
        $senderName = $request->input('sender_name');

        // Create the email message
        $email = new SummaryReport($report);

        // Set the sender address
        $email->from($senderEmail, $senderName);

        // Send the email
        Mail::to('expenses@company.com')->send($email);

        return redirect('/expense_reports/'.$id);
    }
        

}