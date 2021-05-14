@include('backendPartial.nav')
<div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-3">Stock List</h4>
                        </div>
                        @include('flash-message')
                        <a href="#" data-toggle="modal" data-target="#addProduct" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Stock</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="data-table table mb-0 tbl-server-info">
                            <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th>
                                <th>barcode</th>
                                <th>Name</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Packs</th>
                                <th>Quantity</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->role==0)
                                <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="ligth-body">
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox2">
                                        <label for="checkbox2" class="mb-0"></label>
                                    </div>
                                </td>
                                <td>{{$product->product_barcode}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('uploads/product/'.$product->product_image)}}" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            {{$product->product_name}}
                                        </div>
                                    </div>
                                </td>
                                <td>{{$product->buying_price}} /=</td>
                                <td>{{$product->selling_price}} /=</td>
                                @if($product->number_of_pack)
                                <td>{{intdiv($product->product_quantity, $product->quantity_of_pack)}}</td>
                                @else
                                    <td>N/A</td>
                                @endif
                                    <td>{{$product->product_quantity}}</td>
                                @if(\Illuminate\Support\Facades\Auth::user()->role==0)
                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge bg-success mr-2 view" data-toggle="modal" data-target="#editProduct" id="{{$product->id}}" data-placement="top" title="" data-original-title="Edit"
                                           href="#"><i class="ri-pencil-line mr-0"></i></a>
                                        <a class="badge bg-warning mr-2 delete" id="{{$product->id}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                           href="#"><i class="ri-delete-bin-line mr-0"></i></a>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- Page end  -->
        </div>
        <!-- Modal add product -->
        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title">Add Product</h4>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('storeProduct')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Product Category *</label>
                                                        <select name="type" class="selectpicker form-control" data-style="py-0">
                                                            <option>Computer Accessories</option>
                                                            <option>Laptop</option>
                                                            <option>Networking</option>
                                                            <option>Office tools & stationery</option>
                                                            <option>Toner & catridges/inks</option>
                                                            <option>Projectors</option>
                                                            <option>Printers</option>
                                                            <option>CCTV Systems</option>
                                                            <option>Storage</option>
                                                            <option>UPS Backups</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name *</label>
                                                        <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" data-errors="Please Enter Name." required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Barcode *</label>
                                                        <input type="text" class="form-control" name="product_barcode" placeholder="Enter barcode" data-errors="Please Enter Barcode." required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Buying Price *</label>
                                                        <input type="text" class="form-control" name="buying_price" placeholder="Buying Price" data-errors="Please Enter Cost." required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Selling Price *</label>
                                                        <input type="text" class="form-control" name="selling_price" placeholder="Selling Price" data-errors="Please Enter Price." required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="selectIfPacked">
                                                    <div class="form-group">
                                                        <label>Select if packed *</label>
                                                        <select name="type" id="sPacked" class="selectpicker form-control" data-style="py-0">
                                                            <option value="1">No it's not packed</option>
                                                            <option value="2">Yes it's Packed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="quantityOfPack">
                                                    <div class="form-group">
                                                        <label>Quantity in a Pack *</label>
                                                        <input type="text" class="form-control" name="quantity_of_pack" placeholder="Enter quantity in a pack" data-errors="Please Enter quantity in a Packs.">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="noOfPack">
                                                    <div class="form-group">
                                                        <label>No. of Packs *</label>
                                                        <input type="text" class="form-control" name="number_of_pack" placeholder="Enter Number of Packs" data-errors="Please Enter Number of Packs.">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="incompletePack">
                                                    <div class="form-group">
                                                        <label>Unpacked Items</label>
                                                        <select name="type" id="iPack" class="selectpicker form-control" data-style="py-0">
                                                            <option value="1">No unpacked Items</option>
                                                            <option value="2">Available Unpacked Item</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="quantity">
                                                    <div class="form-group">
                                                        <label>Quantity of Unpacked items *</label>
                                                        <input type="text" class="form-control" name="product_quantity" placeholder="Enter Quantity">
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
                                                        <textarea class="form-control" name="product_desc" rows="4"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary mr-2">Add Product</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--    edit modal--}}
    <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Edit Product</h4>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('editProduct')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                    <div class="row" id="basic1">

                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Edit Product</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<!-- Wrapper End-->
<footer class="iq-footer">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-right">
                        <span class="mr-1"><script data-cfasync="false" src="http://iqonic.design/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Backend Bundle JavaScript -->
<script src="assets/js/backend-bundle.min.js"></script>

<!-- Table Treeview JavaScript -->
<script src="assets/js/table-treeview.js"></script>

<!-- Chart Custom JavaScript -->
<script src="assets/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script async src="assets/js/chart-custom.js"></script>

<!-- app JavaScript -->
<script src="assets/js/app.js"></script>
</body>
<script>
    $(document).ready(function () {
       $('#quantityOfPack').hide();
       $('#incompletePack').hide();
       $('#noOfPack').hide();
    });
    $('#sPacked').on('change', function () {
        if ($(this).val() == 2) {
            $('#quantityOfPack').show();
            $('#incompletePack').show();
            $('#noOfPack').show();
            $('#quantity').hide();
        }
        else {
            $('#quantityOfPack').hide();
            $('#incompletePack').hide();
            $('#noOfPack').hide();
            $('#quantity').show();
        }
    });
    $('#iPack').on('change', function () {
        if ($(this).val() == 2) {
            $('#quantity').show();
        }
        else {
            $('#quantity').hide();
        }
    });
    $(document).on('click','.view',function () {
        $value = $(this).attr('id');
        $.ajax({
            type:"get",
            url:"{{url('getProducts')}}",
            data:{'product':$value},
            success:function (data) {
                $('#basic1').html(data);
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
    $(document).on('click','.delete',function () {
        $value = $(this).attr('id');
        $.ajax({
            type:"get",
            url:"{{url('deleteProducts')}}",
            data:{'product':$value},
            success:function (data) {
                alert('ok');
                location.reload();
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });

</script>

<!-- Mirrored from iqonic.design/themes/posdash/html/backend/page-list-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Mar 2021 21:31:54 GMT -->
</html>
