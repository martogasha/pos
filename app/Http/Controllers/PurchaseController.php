<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index(){
        $stocks = Product::all();
        return view('backend.purchase',[
            'stocks'=>$stocks
        ]);
    }
    public function getPurchaseProduct(Request $request){
        if ($request->ajax()){
            $output="";
            $product = Product::find($request->product);
        }
        $output .= '
        <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
                                        <div class="quill-tool">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Quantity *</label>
                                            <input type="text" class="form-control" id="quantity" placeholder="Enter Quantity" data-errors="Please Quantity." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Price *</label>
                                            <input type="text" class="form-control" value="'.$product->selling_price.'" id="priceL" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="'.$product->id.'" id="productId">
        ';
        return response($output);
    }
    public function purchaseTable(Request $request){
        if ($request->ajax()){
            $output ="";
            if ($request->service){
                $purchase = Purchase::create([
                    'barcode' => 0,
                    'name' => $request->service,
                    'quantity' =>1,
                    'price' => $request->priceOfService,
                    'user_id' => Auth::id(),
                    'total' => $request->priceOfService,
                ]);
            }
            else {
                $getProduct = Product::find($request->product);
                $getQuantity = Purchase::where('barcode', $getProduct->product_barcode)->first();
                if ($getQuantity) {
                    $initialQuantity = $getQuantity->quantity;
                    $addOne = $initialQuantity + $request->product_quantity;
                    $total = $getQuantity->price * $addOne;
                    $updateQuantity = Purchase::where('id', $getQuantity->id)->update(['quantity' => $addOne]);
                    $updateTotal = Purchase::where('id', $getQuantity->id)->update(['total' => $total]);
                } else {
                    $purchase = Purchase::create([
                        'barcode' => $getProduct->product_barcode,
                        'name' => $getProduct->product_name,
                        'quantity' => $request->product_quantity,
                        'price' => $request->product_price,
                        'image' => $getProduct->product_image,
                        'user_id' => Auth::id(),
                        'total' => $request->product_quantity * $request->product_price,
                    ]);
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
                                <td id="barcode">'.$purchase->barcode.'</td>
                                <input type="hidden" value="'.$purchase->barcode.'">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="'.asset('uploads/product/'.$purchase->image).'" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            '.$purchase->name.'
                                        </div>
                                    <input type="hidden" value="'.$purchase->image.'" id="image">
                                    <input type="hidden" value="'.$purchase->name.'">

                                    </div>
                                </td>
                                <td id="name">'.$purchase->price.'</td>
                                <input type="hidden" value="'.$purchase->price.'" id="price">
                                <td>'.$purchase->quantity.'</td>
                                 <input type="hidden" value="'.$purchase->quantity.'" id="quantityOfPurchase">
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
    public function total(Request $request){
        if ($request->ajax()){
            $output="";
            $getTotal = Purchase::sum('total');
        }
        $output = '
            <h3>Total: <span style="border-bottom: 5px double"><b>'.$getTotal.' /=</b></span></h3>
            <input type="hidden" value="'.$getTotal.'" id="subTotal">
        ';
        return response($output);
    }
    public function editPurchase(Request $request){
        if ($request->ajax()){
            $output = "";
            $purchase = Purchase::find($request->purchase);
        }
        $output = '
            <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
                                        <div class="quill-tool">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Quantity *</label>
                                            <input type="text" class="form-control" value="'.$purchase->quantity.'" id="quantityPurchase" placeholder="Enter Quantity" data-errors="Please Quantity." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Price Per Item *</label>
                                            <input type="text" class="form-control" value="'.$purchase->price.'" id="pricePurchase" name="product_quantity" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="'.$purchase->id.'" id="pId">
            ';
        return response($output);
    }
    public function ePurchase(Request $request){
        if ($request->ajax()){
            $output = "";
            $finalPrice = $request->price * $request->quantity;
            $updateQuantity = Purchase::where('id',$request->purchase)->update(['quantity'=>$request->quantity]);
            $updatePrice = Purchase::where('id',$request->purchase)->update(['price'=>$request->price]);
            $updateTotal = Purchase::where('id',$request->purchase)->update(['total'=>$finalPrice]);
            $solds = Purchase::all();

        }
        foreach ($solds as $sold) {
            $output .= '
          <tr>
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox2">
                                        <label for="checkbox2" class="mb-0"></label>
                                    </div>
                                </td>
                                <td>'.$sold->barcode.'</td>
                                <input type="hidden" value="'.$sold->barcode.'" id="barcode">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="'.asset('uploads/product/'.$sold->image).'" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            '.$sold->name.'
                                        </div>
                                    <input type="hidden" value="'.$sold->image.'" id="image">
                                    <input type="hidden" value="'.$sold->name.'" id="name">

                                    </div>
                                </td>
                                <td>'.$sold->price.'</td>
                                <input type="hidden" value="'.$sold->price.'" id="price">
                                <td>'.$sold->quantity.'</td>
                                 <input type="hidden" value="'.$sold->quantity.'" id="quantityOfPurchase">
                                <td id="totalPrice">'.$sold->total.' /=</td>
                                <input type="hidden" value="'.$sold->total.'" id="total">
                                <input type="hidden" value="'.$sold->id.'" id="purchaseId">
                                <td>
                                    <div class="d-flex align-items-center list-action">

                                        <button class="badge bg-primary mr-2 edit" id="'.$sold->id.'" data-toggle="modal" data-target="#editPurchase">Edit</button>

                                           <a class="badge bg-danger mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                           href="#" id="deleteProduct">Delete</a>
                                    </div>
                                </td>

                            </tr>

        ';
        }
        return response($output);
    }
    public function startOver(Request $request){
        if ($request->ajax()){
            $output = "";
            $startOver = Purchase::truncate();
            $solds = Purchase::all();
        }
        foreach ($solds as $sold) {
            $output .= '
          <tr>
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox2">
                                        <label for="checkbox2" class="mb-0"></label>
                                    </div>
                                </td>
                                <td>'.$sold->barcode.'</td>
                                <input type="hidden" value="'.$sold->barcode.'" id="barcode">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="'.asset('uploads/product/'.$sold->image).'" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            '.$sold->name.'
                                        </div>
                                    <input type="hidden" value="'.$sold->image.'" id="image">
                                    <input type="hidden" value="'.$sold->name.'" id="name">

                                    </div>
                                </td>
                                <td>'.$sold->price.'</td>
                                <input type="hidden" value="'.$sold->price.'" id="price">
                                <td>'.$sold->quantity.'</td>
                                 <input type="hidden" value="'.$sold->quantity.'" id="quantityOfPurchase">
                                <td id="totalPrice">'.$sold->total.' /=</td>
                                <input type="hidden" value="'.$sold->total.'" id="total">
                                <input type="hidden" value="'.$sold->id.'" id="purchaseId">
                                <td>
                                    <div class="d-flex align-items-center list-action">

                                        <button class="badge bg-primary mr-2 edit" id="'.$sold->id.'" data-toggle="modal" data-target="#editPurchase">Edit</button>

                                           <a class="badge bg-danger mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                           href="#" id="deleteProduct">Delete</a>
                                    </div>
                                </td>

                            </tr>

        ';
        }
        return response($output);
    }
    public function resume(Request $request){
        if ($request->ajax()){
            $output = "";
            $solds = Purchase::all();
        }
        foreach ($solds as $sold) {
            $output .= '
          <tr>
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox2">
                                        <label for="checkbox2" class="mb-0"></label>
                                    </div>
                                </td>
                                <td>'.$sold->barcode.'</td>
                                <input type="hidden" value="'.$sold->barcode.'" id="barcode">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="'.asset('uploads/product/'.$sold->image).'" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            '.$sold->name.'
                                        </div>
                                    <input type="hidden" value="'.$sold->image.'" id="image">
                                    <input type="hidden" value="'.$sold->name.'" id="name">

                                    </div>
                                </td>
                                <td>'.$sold->price.'</td>
                                <input type="hidden" value="'.$sold->price.'" id="price">
                                <td>'.$sold->quantity.'</td>
                                 <input type="hidden" value="'.$sold->quantity.'" id="quantityOfPurchase">
                                <td id="totalPrice">'.$sold->total.' /=</td>
                                <input type="hidden" value="'.$sold->total.'" id="total">
                                <input type="hidden" value="'.$sold->id.'" id="purchaseId">
                                <td>
                                    <div class="d-flex align-items-center list-action">

                                        <button class="badge bg-primary mr-2 edit" id="'.$sold->id.'" data-toggle="modal" data-target="#editPurchase">Edit</button>

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
