<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Finalsale;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isNull;

class SaleController extends Controller
{
    public function index(){
        $currentDate = date('Y/m/d');
        if (Auth::check()){
            $sales = Finalsale::where('date', $currentDate)->get();
            $totalSale = Finalsale::where('date', $currentDate)->sum('total');
            $totalServiceSale = Finalsale::where('date', $currentDate)->sum('total_for_services');
            $totalProfit = Finalsale::where('date', $currentDate)->sum('profit');
            $totalProfitForSale = Finalsale::where('date', $currentDate)->sum('profit_of_services');
            $expense = Expense::where('date', $currentDate)->sum('price');
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
                    $newPrice = $getProduct->selling_price;
                    $subTotal = $newPrice * $get->quantity;
                    $newTotal = $getSale->total + $subTotal;
                    $calculateProfit = $newPrice - $getProduct->buying_price;
                    $getProfit = $calculateProfit * $get->quantity;
                    $getServiceProfit = $newPrice*$newQuantity;
                    $serviceProfit = $getServiceProfit*0.5;
                    $newProfit = $getSale->profit + $getProfit;
                    $productQuantity = $getProduct->product_quantity;
                    $newProductQuantity = $productQuantity - $get->quantity;
                    if ($getProduct->number_of_pack != null) {
                        $numberOfPack = intdiv($getProduct->product_quantity, $getProduct->number_of_pack);
                    }
                    $updateUserId = Sale::where('barcode', $get->barcode)->update(['user_id' => Auth::id()]);
                    $updateUserId = Sale::where('barcode', $get->barcode)->update(['phone' => $request->customer_phone]);
                    $updatePrice = Sale::where('barcode', $get->barcode)->update(['price' => $newPrice]);
                    $updateQuantity = Sale::where('barcode', $get->barcode)->update(['quantity' => $newQuantity]);
                    if ($getProduct->product_quantity!=null){
                        $updateProductQuantity = Product::where('product_barcode', $get->barcode)->update(['product_quantity' => $newProductQuantity]);
                    }
                    if ($getProduct->number_of_pack != null) {
                        $updatePacks = Product::where('product_barcode', $get->barcode)->update(['number_of_pack' => $numberOfPack]);
                    }
                    if ($getProduct->buying_price!=0) {
                        $updateTotal = Sale::where('barcode', $get->barcode)->update(['total' => $newTotal]);
                        $updateProfit = Sale::where('barcode', $get->barcode)->update(['profit' => $newProfit]);
                        $updatePayment = Sale::where('barcode', $get->barcode)->update(['payment_method' => $request->payment_method]);
                        $updateDate = Sale::where('barcode', $get->barcode)->update(['date' => $request->date]);
                    }
                    else{
                        $updateServiceTotal = Sale::where('barcode', $get->barcode)->update(['total_for_services' => $request->amount*$newQuantity]);
                        $updateServiceProfit = Sale::where('barcode', $get->barcode)->update(['profit_of_services' => $serviceProfit]);
                        $updateServiceDate = Sale::where('barcode', $get->barcode)->update(['date' => $request->date]);

                    }
                    if ($getProduct->buying_price!=0) {
                        $storeFinal = Finalsale::create([
                            'barcode' => $getSale->barcode,
                            'name' => $getSale->name,
                            'price' => $newPrice,
                            'quantity' => $newQuantity,
                            'total' => $newTotal,
                            'date' => $request->date,
                            'phone' => '+254',
                            'phoneNumber' => $request->customer_phone,
                            'profit' => $newProfit,
                            'image' => $getSale->image,
                            'total_for_services' => $getSale->total_for_services,
                            'profit_of_services' => $getSale->profit_of_services,
                            'user_id' =>Auth::id(),
                            'payment_method' => $request->payment_method,
                        ]);
                    }
                    else{
                        $storeFinal = Finalsale::create([
                            'barcode' => $getSale->barcode,
                            'name' => $getSale->name,
                            'price' => $newPrice,
                            'quantity' => $newQuantity,
                            'total' => $getSale->total,
                            'date' => $request->date,
                            'phone' => '+254',
                            'phoneNumber' => $request->customer_phone,                            'profit' => $getSale->profit,
                            'image' => $getSale->image,
                            'total_for_services' => $newPrice*$newQuantity,
                            'profit_of_services' => $serviceProfit,
                            'user_id' =>Auth::id(),
                            'payment_method' => $request->payment_method,
                        ]);
                    }
                    if ($getProduct->buying_price!= 0){
                        $updatePrice = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['price'=>0]);
                        $updateQuantity = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['quantity'=>0]);
                        $updateTotal = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['total'=>0]);
                        $updateProfit = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['profit'=>0]);
                        $updatePayment = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['payment_method'=>null]);
                        $updateUser = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['user_id'=>null]);
                    }
                    else{
                        $updatePrice = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['price'=>0]);
                        $updateQuantity = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['quantity'=>0]);
                        $updateTotal = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['total_for_services'=>0]);
                        $updateProfit = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['profit_of_services'=>0]);
                        $updatePayment = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['payment_method'=>null]);
                        $updateUser = Sale::where('barcode',$getSale->barcode)->where('user_id',Auth::id())->update(['user_id'=>null]);
                    }
                }


                $detele = Purchase::where('user_id',Auth::id())->delete();

                $checkUser = User::where('phone',$request->customer_phone)->first();
                if ($checkUser==null && !is_null($request->customer_phone)){
                    $createUser = User::create([
                        'first_name'=>'Icons',
                        'last_name'=>'Customer',
                        'role'=>5,
                        'phone' => $request->customer_phone,
                        'email'=>''.$request->customer_phone.'@gmail.com',
                        'password'=>Hash::make('password'),
                    ]);
                }

            }
            if (!isNull($request->customer_phone)){
                $username = 'bull'; // use 'sandbox' for development in the test environment
                $apiKey   = '647148b58869f60dcc240168a55edf3bae3057c52d7fdc343dd6f2525879562d'; // use your sandbox app API key for development in the test environment
                $AT       = new AfricasTalking($username, $apiKey);
                // Get one of the services
                $sms      = $AT->sms();
                $getProds = Finalsale::where('quantity','>',0)->where('user_id',Auth::id())->get();
//             Use the service
                $res   = $sms->send([
                    'to'      => '0727995279',
                    'message' => 'Activity has happened'
                ]);

                $result   = $sms->send([
                    'to'      => ''.$request->customer_phone.'',
                    'message' => 'Thank you for reaching icons computer shop. for more info contact www.iconztech.com or 0727995279!'
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
