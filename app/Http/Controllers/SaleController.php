<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index(){
        $sales = Sale::all();
        $totalSale = Sale::sum('total');
        $totalServiceSale = Sale::sum('total_for_services');
        $totalProfit = Sale::sum('profit');
        $totalProfitForSale = Sale::sum('profit_of_services');
        return view('backend.sales',[
            'sales'=>$sales,
            'totalSale'=>$totalSale,
            'totalServiceSale'=>$totalServiceSale,
            'totalProfit'=>$totalProfit,
            'totalProfitForSale'=>$totalProfitForSale,
        ]);

    }
    public function sold(Request $request){
        if ($request->ajax()) {
            $output = "";
            $tests = Purchase::all();
            if ($request->product_id == null){
                foreach ($tests as $test) {
                    $createService = Sale::create([
                        'barcode' => 0,
                        'name' => $test->name,
                        'price' => $test->price,
                        'quantity' => 1,
                        'total' => 0,
                        'total_for_services' => $request->total,
                        'profit_of_services' => $request->total*0.5,
                        'profit' => 0,
                        'payment_method' => $request->payment_method,
                        'user_id' => Auth::id(),

                    ]);
                    $test->delete();
                }
            }
            else {
                $gets = Purchase::all();
                foreach ($gets as $get) {
                    $getSale = Sale::where('barcode', $get->barcode)->first();
                    $getProduct = Product::where('product_barcode', $get->barcode)->first();
                    $newQuantity = $getSale->quantity + $get->quantity;
                    $newPrice = $get->price;
                    $subTotal = $get->price * $get->quantity;
                    $newTotal = $getSale->total + $subTotal;
                    $calculateProfit = $get->price - $getProduct->buying_price;
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
                    $get->delete();

                }
            }

            $purchases = Purchase::all();
        }
        foreach ($purchases as $purchase) {
            $output .= '
          <tr>
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox2">
                                        <label for="checkbox2" class="mb-0"></label>
                                    </div>
                                </td>
                                <td>'.$purchase->barcode.'</td>
                                <input type="hidden" value="'.$purchase->barcode.'" id="barcode">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="'.asset('uploads/product/'.$purchase->image).'" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            '.$purchase->name.'
                                        </div>
                                    <input type="hidden" value="'.$purchase->image.'" id="image">
                                    <input type="hidden" value="'.$purchase->name.'" id="name">

                                    </div>
                                </td>
                                <td>'.$purchase->price.'</td>
                                <input type="hidden" value="'.$purchase->price.'" id="price">
                                <td>'.$purchase->quantity.'</td>
                                 <input type="hidden" value="'.$purchase->price.'" id="quantityOfPurchase">
                                <td id="totalPrice">'.$purchase->total.' /=</td>
                                <input type="hidden" value="'.$purchase->total.'" id="total">
                                <input type="hidden" value="'.$purchase->id.'" id="purchaseId">
                                <td>
                                    <div class="d-flex align-items-center list-action">

                                        <button class="badge bg-primary mr-2 edit" id="'.$purchase->id.'" data-toggle="modal" data-target="#editPurchase">Edit</button>

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
