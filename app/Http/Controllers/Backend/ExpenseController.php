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
        
    }
}
