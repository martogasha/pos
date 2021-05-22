<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    public function expenses(){
        $products = Expense::all();
        $totalExpense = Expense::sum('price');
        return view('backend.expenses',[
            'products'=>$products,
            'totalExpense'=>$totalExpense
        ]);
    }
    public function addExpense(Request $request){
        $add = Expense::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'desc'=>$request->desc,
            'user_id'=>Auth::id(),
            'date'=>$request->date,
        ]);
        return redirect()->back()->with('success','Expense Added Successfully');
    }
    public function deleteExpense(Request $request){
        if ($request->ajax()){
            $delete = Expense::find($request->product);
            $delete->delete();
        }
    }
}
