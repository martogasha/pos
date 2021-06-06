<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\Hash;

class SaleController extends Controller
{
    public function index(){
        if (Auth::check()){
            $sales = Sale::all();
            $totalSale = Sale::sum('total');
            $totalServiceSale = Sale::sum('total_for_services');
            $totalProfit = Sale::sum('profit');
            $totalProfitForSale = Sale::sum('profit_of_services');
            $expense = Expense::sum('price');
            return view('backend.sales',[
                'sales'=>$sales,
                'totalSale'=>$totalSale,
                'totalServiceSale'=>$totalServiceSale,
                'totalProfit'=>$totalProfit,
                'totalProfitForSale'=>$totalProfitForSale,
                'expense'=>$expense,
            ]);
        }
       else{
           return redirect(url('login'));
       }

    }
    public function sold(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            if ($request->barcode !='NA'){
                $gets = Purchase::all();
                foreach ($gets as $get) {
                    $getSale = Sale::where('barcode', $get->barcode)->first();
                    $getProduct = Product::where('product_barcode', $get->barcode)->first();
                    $newQuantity = $getSale->quantity + $get->quantity;
                    $newPrice = $request->price;
                    $subTotal = $request->price * $get->quantity;
                    $newTotal = $getSale->total + $subTotal;
                    $calculateProfit = $request->price - $getProduct->buying_price;
                    $getProfit = $calculateProfit * $get->quantity;
                    $newProfit = $getSale->profit + $getProfit;
                    $productQuantity = $getProduct->product_quantity;
                    $newProductQuantity = $productQuantity - $get->quantity;
                    if ($getProduct->number_of_pack != null) {
                        $numberOfPack = intdiv($getProduct->product_quantity, $getProduct->number_of_pack);
                    }
                    $updateUserId = Sale::where('barcode', $get->barcode)->update(['user_id' => Auth::id()]);
                    $updatePrice = Sale::where('barcode', $get->barcode)->update(['price' => $newPrice]);
                    $updateQuantity = Sale::where('barcode', $get->barcode)->update(['quantity' => $newQuantity]);
                    $updateProductQuantity = Product::where('product_barcode', $get->barcode)->update(['product_quantity' => $newProductQuantity]);
                    if ($getProduct->number_of_pack != null) {
                        $updatePacks = Product::where('product_barcode', $get->barcode)->update(['number_of_pack' => $numberOfPack]);
                    }
                    $updateTotal = Sale::where('barcode', $get->barcode)->update(['total' => $newTotal]);
                    $updateProfit = Sale::where('barcode', $get->barcode)->update(['profit' => $newProfit]);
                    $updatePayment = Sale::where('barcode', $get->barcode)->update(['payment_method' => $request->payment_method]);
                }
                $detele = Purchase::where('barcode','!=','NA')->delete();
                $username = 'bull'; // use 'sandbox' for development in the test environment
                $apiKey   = '647148b58869f60dcc240168a55edf3bae3057c52d7fdc343dd6f2525879562d'; // use your sandbox app API key for development in the test environment
                $AT       = new AfricasTalking($username, $apiKey);
                // Get one of the services
                $sms      = $AT->sms();
                $getProds = Sale::where('quantity','>',0)->where('user_id',Auth::id())->get();
                // Use the service
                $res   = $sms->send([
                    'to'      => '0790268795',
                    'message' => 'Activity has happened'
                ]);

                $result   = $sms->send([
                    'to'      => ''.$request->customer_phone.'',
                    'message' => 'Thank you for reaching icons computer shop, for more info contact www.iconztech.com or 0727995279!'
                ]);
                $createUser = User::create([
                    'first_name'=>'Icons',
                    'last_name'=>'Customer',
                    'phone'=>$request->customer_phone,
                    'role'=>5,
                    'email'=>''.$request->customer_phone.'@gmail.com',
                    'password'=>Hash::make('password'),
                ]);

            }
            else{
                $sss = new Sale();
                $sss->barcode = $request->barcode;
                $sss->name = $request->name;
                $sss->price = $request->price;
                $sss->quantity = $request->quantityOfPurchase;
                $sss->total_for_services = $request->total;
                $sss->profit_of_services = $request->total*0.5;
                $sss->payment_method = $request->payment_method;
                $sss->user_id = Auth::id();
                $sss->total =0;
                $sss->profit =0;
                $sss->save();
                $username = 'bull'; // use 'sandbox' for development in the test environment
                $apiKey   = '647148b58869f60dcc240168a55edf3bae3057c52d7fdc343dd6f2525879562d'; // use your sandbox app API key for development in the test environment
                $AT       = new AfricasTalking($username, $apiKey);
                // Get one of the services
                $sms      = $AT->sms();
                $detele = Purchase::where('barcode','NA')->delete();
                // Use the service
                $res   = $sms->send([
                    'to'      => '0790268795',
                    'message' => 'Activity has happened'
                ]);
                $result   = $sms->send([
                    'to'      => ''.$request->customer_phone.'',
                    'message' => 'Thank you for reaching icons computer shop, for more info contact www.iconztech.com or 0727995279!'
                ]);
                $createUser = User::create([
                    'first_name'=>'Icons',
                    'last_name'=>'Customer',
                    'phone'=>$request->customer_phone,
                    'role'=>5,
                    'email'=>''.$request->customer_phone.'@gmail.com',
                    'password'=>Hash::make('password'),
                ]);

            }

            $purchases = Purchase::all();
            foreach ($purchases as $purchase) {
                $output .= '
          <tr>
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox2">
                                        <label for="checkbox2" class="mb-0"></label>
                                    </div>
                                </td>
                                <td>' . $purchase->barcode . '</td>
                                <input type="hidden" value="' . $purchase->barcode . '" id="barcode">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="' . asset('uploads/product/' . $purchase->image) . '" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            ' . $purchase->name . '
                                        </div>
                                    <input type="hidden" value="' . $purchase->image . '" id="image">
                                    <input type="hidden" value="' . $purchase->name . '" id="name">

                                    </div>
                                </td>
                                <td>' . $purchase->price . '</td>
                                <input type="hidden" value="' . $purchase->price . '" id="price">
                                <td>' . $purchase->quantity . '</td>
                                 <input type="hidden" value="' . $purchase->price . '" id="quantityOfPurchase">
                                <td id="totalPrice">' . $purchase->total . ' /=</td>
                                <input type="hidden" value="' . $purchase->total . '" id="total">
                                <input type="hidden" value="' . $purchase->id . '" id="purchaseId">
                                <td>
                                    <div class="d-flex align-items-center list-action">

                                        <button class="badge bg-primary mr-2 edit" id="' . $purchase->id . '" data-toggle="modal" data-target="#editPurchase">Edit</button>

                                           <a class="badge bg-danger mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                           href="#" id="deleteProduct">Delete</a>
                                    </div>
                                </td>

                            </tr>

        ';
            }
            return response($output);
        }
    }

}
