<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;
use App\Models\Supplier;
use Intervention\Image\Facades\Image;

class ExpenseController extends Controller
{
    public function AddExpense()
    {
        return view('backend.expense.add_expense');
    }

    public function StoreExpense(Request $request)
    {
        Expense::insert([
            'details' => $request->details,
            'amount' => $request->amount,
            'date' => $request->date,
            'month' => $request->month,
            'year' => $request->year,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Expense Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function TodayExpense(){
        // get current date
        $date = date("d-m-Y");
        $today = Expense::where('date', $date)->get();
        return view('backend.expense.today_expense', compact('today'));
    }

    public function EditExpense($id){
        $expense = Expense::findOrFail($id);
        return view('backend.expense.edit_expense', compact('expense'));
    }

    public function UpdateExpense(Request $request){
        $expense_id = $request->id;

        Expense::findOrFail($expense_id)->update([
            'details' => $request->details,
            'amount' => $request->amount,
            'date' => $request->date,
            'month' => $request->month,
            'year' => $request->year,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Expense Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('today.expense')->with($notification);
    }


    public function MonthExpense(){
        $month = date("F");
        $monthexpense = Expense::where('month',$month)->get();
        return view('backend.expense.month_expense',compact('monthexpense'));
    }
}
