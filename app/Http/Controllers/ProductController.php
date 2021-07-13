<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Faker\Provider\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        if (Auth::check()){
            $products = Product::all();
            return view('backend.products',[
                'products' => $products,
            ]);
        }
        else{
            return redirect(url('/'));
        }

    }
    public function getServicePrice(Request $request){
        if ($request->ajax()){
            $output = "";
        }
        $price = Product::where('id',$request->id)->first();
        $output = '
        <input type="text" class="form-control" value="'.$price->selling_price.'" id="priceOfService" placeholder="Price">

        ';
        return response($output);
    }
    public function services(){
        if (Auth::check()){
            $products = Product::where('buying_price',0)->get();
            return view('backend.service',[
                'products' => $products,
            ]);
        }
        else{
            return redirect(url('/'));
        }

    }
    public function store(Request $request){
            $pictures = new Product();
        $pictures->product_name = $request->input('product_name');
        $pictures->product_desc = $request->input('product_desc');
        $pictures->buying_price = $request->input('buying_price');
        $pictures->selling_price = $request->input('selling_price');
        $pictures->product_barcode = $request->input('product_barcode');
        $pictures->quantity_of_pack = $request->input('quantity_of_pack');
        $pictures->number_of_pack = $request->input('number_of_pack');
            $totalPackQuantity = $request->number_of_pack * $request->quantity_of_pack;
            $totalQuantity = $totalPackQuantity + $request->product_quantity;
            $pictures->product_quantity = $totalQuantity;

        if ($request->product_image) {
            $file = $request->file('product_image');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file->move('uploads/product/', $filename);
            $pictures->product_image = $filename;
        }
        $pictures->save();
        $getImage = Product::where('product_barcode',$request->product_barcode)->first();
        $sales = new Sale();
        $sales->barcode = $request->input('product_barcode');
        $sales->name = $request->input('product_name');
        $sales->price = 0;
        $sales->quantity = 0;
        $sales->total = 0;
        $sales->profit = 0;
        $sales->image = $getImage->product_image;
        $sales->save();


        return redirect()->back()->with('success','PRODUCT ADDED SUCCESSFULLY');
    }
    public function storeService(Request $request){
        $service = new Product();
        $service->product_name = $request->input('type');
        $service->product_barcode = $request->input('barcode');
        $service->buying_price = 0;
        $service->selling_price = $request->input('amount');
        $service->save();
        $getService = Product::where('product_barcode',$request->barcode)->first();
        $sales = new Sale();
        $sales->barcode = $getService->product_barcode;
        $sales->name = $getService->product_name;
        $sales->price = 0;
        $sales->quantity = 0;
        $sales->total = 0;
        $sales->profit = 0;
        $sales->save();

        return redirect()->back()->with('success','SERVICE ADDED SUCCESSFULLY');
    }
    public function getProduct(Request $request){
        if ($request->ajax()){
            $output="";
            $product = Product::find($request->product);
            if ($product->number_of_pack) {
                $totalItemsInPack = $product->number_of_pack * $product->quantity_of_pack;
                $remainder = $product->product_quantity;
                $totalItems = $totalItemsInPack + $remainder;
            }
            else{
                $totalItems = $product->product_quantity;
            }
        }
        $output = '

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name *</label>
                                                <input type="text" class="form-control" value="'.$product->product_name.'" name="product_name" placeholder="Enter Product Name" data-errors="Please Enter Name." required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Barcode *</label>
                                                <input type="text" class="form-control" value="'.$product->product_barcode.'" name="product_barcode" placeholder="Enter barcode" data-errors="Please Enter Barcode." required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Buying Price *</label>
                                                <input type="text" class="form-control" value="'.$product->buying_price.'" name="buying_price" placeholder="Buying Price" data-errors="Please Enter Cost." required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Selling Price *</label>
                                                <input type="text" class="form-control" value="'.$product->selling_price.'" name="selling_price" placeholder="Selling Price" data-errors="Please Enter Price." required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6" id="quantityOfPack">
                                            <div class="form-group">
                                                <label>Quantity in a Pack *</label>
                                                <input type="text" class="form-control" value="'.$product->quantity_of_pack.'" name="quantity_of_pack" placeholder="Enter quantity of a pack" data-errors="Please Enter quantity of a Packs.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="noOfPack">
                                            <div class="form-group">
                                                <label>No. of Packs *</label>
                                                <input type="text" class="form-control" value="'.$product->number_of_pack.'" name="number_of_pack" placeholder="Enter Number of Packs" data-errors="Please Enter Number of Packs.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="quantity">
                                            <div class="form-group">
                                                <label>Incomplete Pack *</label>
                                                <input type="text" class="form-control" value="'.fmod($product->product_quantity, $product->quantity_of_pack ).'" name="quantity" placeholder="Enter Quantity">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="quantity">
                                            <div class="form-group">
                                                <label>Total Items *</label>
                                                <input type="text" class="form-control" value="'.$product->product_quantity.'" placeholder="Enter Quantity">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" class="form-control image-file" name="product_image" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description / Product Details</label>
                                                <textarea class="form-control" value="'.$product->product_desc.'" name="product_desc" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_id" value="'.$product->id.'">

        ';
        return response($output);

    }
    public function editProduct(Request $request){
        $edit = Product::find($request->product_id);
        $edit->product_name = $request->product_name;
        $edit->product_barcode = $request->product_barcode;
        $edit->buying_price = $request->buying_price;
        $edit->selling_price = $request->selling_price;
        $edit->quantity_of_pack = $request->quantity_of_pack;
        $edit->number_of_pack = $request->number_of_pack;
        $totalPackQuantity = $request->quantity_of_pack * $request->number_of_pack;
        $totalQuantity = $totalPackQuantity + $request->quantity;
        $edit->product_quantity = $totalQuantity;
        $edit->product_desc = $request->product_desc;
        if ($request->product_image) {
            $file = $request->file('product_image');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file->move('uploads/product/', $filename);
            $edit->product_image = $filename;
        }
        $edit->save();
        return redirect(url('products'))->with('success','Product Updated Successfully');

    }
    public function deleteProducts(Request $request){
        if ($request->ajax()){
            $delete = Product::find($request->product);
            $delete->delete();
        }
    }
    public function belowThree(){
        $products = Product::where('product_quantity','<',3)->get();
        return view('backend.belowThree',[
            'products'=>$products
        ]);
    }

}
