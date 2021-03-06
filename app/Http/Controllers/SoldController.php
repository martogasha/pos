<?php

namespace App\Http\Controllers;
use App\Models\Expense;
use App\Models\Finalsale;
use App\Models\recordedExpense;
use App\Models\Sale;
use App\Models\Sold;
use Facade\FlareClient\Glows\Recorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldController extends Controller
{
    public function index(){
        return view('backend.soldRecord',[
        ]);
    }
    public function recordSale(Request $request){
        $getSales = Sale::all();
        foreach ($getSales as $getSale){
            if ($getSale->quantity>0) {
                if ($getSale->barcode=='NA'){
                    $sold = Sold::create([
                        'barcode' => $getSale->barcode,
                        'name' => $getSale->name,
                        'price' => $getSale->price,
                        'quantity' => $getSale->quantity,
                        'total' => $getSale->total_for_services,
                        'profit' => $getSale->profit_of_services,
                        'date' => $request->date,
                        'user_id'=> Auth::id(),
                        'payment_method' => $getSale->payment_method,
                        'image' => $getSale->image,
                    ]);
                }
                else{
                    $sold = Sold::create([
                        'barcode' => $getSale->barcode,
                        'name' => $getSale->name,
                        'price' => $getSale->price,
                        'quantity' => $getSale->quantity,
                        'total' => $getSale->total,
                        'profit' => $getSale->profit,
                        'date' => $request->date,
                        'user_id'=> Auth::id(),
                        'payment_method' => $getSale->payment_method,
                        'image' => $getSale->image,
                    ]);
                }

                $updatePrice = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['price'=>0]);
                $updateQuantity = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['quantity'=>0]);
                $updateTotal = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['total'=>0]);
                $updateServiceTotal = Sale::where('barcode','NA')->where('user_id',Auth::id())->delete();
                $updateProfit = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['profit'=>0]);
                $updateServiceProfit = Sale::where('barcode','NA')->where('user_id',Auth::id())->delete();
                $updatePayment = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['payment_method'=>null]);
                $updateUser = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['user_id'=>null]);
            }
        }
        $recordExpenses = Expense::all();
        foreach ($recordExpenses as $recordExpens){
            $record = recordedExpense::create([
               'name'=>$recordExpens->name,
               'desc'=>$recordExpens->desc,
               'price'=>$recordExpens->price,
               'user_id'=>$recordExpens->user_id,
               'date'=>$request->date,
            ]);
        }
        $expenses = Expense::truncate();
    }
    public function filterRecord(Request $request){
        if ($request->ajax()) {
            $output = "";
            $solds = Finalsale::where('date',$request->date)->get();
        }
            foreach ($solds as $sold) {
                if ($sold->quantity > 0) {
                    $output .= '
             <tr>
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox2">
                                        <label for="checkbox2" class="mb-0"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="' . asset('uploads/product/' . $sold->image) . '" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            ' . $sold->name . '
                                        </div>
                                    </div>
                                </td>
                                <td>'.$sold->quantity.'</td>
                                <td>'.$sold->total.'</td>

                                <td style="color: green">' . $sold->profit . '</td>
                                <td>' . $sold->payment_method . '</td>
                                <td>' . $sold->user->first_name . ' ' . $sold->user->last_name . '</td>
                                <td>' . $sold->phone . '</td>
                                <td>
                                    <div class="d-flex align-items-center list-action">
                             <button class="btn btn-success id" data-toggle="modal" id="'.$sold->id.'" data-target="#salesModal">Return</button>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#salesModal">Edit</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#salesModal">Delete</button>
                                    </div>
                                </td>
                            </tr>
        ';
                }
            }
            return response($output);


    }
    public function filterPrice(Request $request){
        if ($request->ajax()){
            $output="";
        }
        $output = Finalsale::where('date',$request->date)->sum('total');
        return response($output);
    }
    public function filterProfit(Request $request){
        if ($request->ajax()){
            $output="";
        }
        $profit = Finalsale::where('date',$request->date)->sum('profit');
        $profit1 = Finalsale::where('date',$request->date)->sum('profit_of_services');
        $output = $profit+$profit1;
        return response($output);
    }
    public function filterHeader(Request $request){
        if ($request->ajax()){
            $output="";
        }
        $getSold = Finalsale::where('date',$request->date)->first();
        $output = $getSold->date;
        return response($output);
    }
    public function filterExpense(Request $request){
        if ($request->ajax()){
            $output="";
        }
        $getSold = Expense::where('date',$request->date)->sum('price');
        $output = $getSold;
        return response($output);
    }
    public function finalProfit(Request $request){
        if ($request->ajax()){
            $output="";
        }
        $profit = Finalsale::where('date',$request->date)->sum('profit');
        $profit1 = Finalsale::where('date',$request->date)->sum('profit_of_services');
        $output = $profit+$profit1;
        $getExpense = Expense::where('date',$request->date)->sum('price');
        $output = $output - $getExpense;
        return response($output);
    }
}
