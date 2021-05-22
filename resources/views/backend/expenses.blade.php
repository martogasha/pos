@include('backendPartial.nav')
<div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <div>
                                <h4>Total Expenses: <span style="color: blue">{{$totalExpense}} /=</span></h4>
                            </div>
                        </div>
                        @include('flash-message')
                        <a href="#" data-toggle="modal" data-target="#addProduct" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Expense</a>
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Amount</th>
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
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            {{$product->name}}
                                        </div>
                                    </div>
                                </td>
                                <td>{{$product->desc     }}</td>
                                <td>{{$product->price}} /=</td>
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
                                            <h4 class="card-title">Add Expense</h4>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('addExpense')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12" id="quantity">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="name" placeholder="Enter Expense Name">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="quantity">
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <input type="text" class="form-control" name="price" placeholder="Enter Price">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description / Expense Details</label>
                                                            <textarea class="form-control" name="desc" rows="4"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="dob">Date *</label>
                                                        <input type="date" class="form-control" id="dob" name="date" />
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
<div class="modal fade" id="sellService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Service offered</label>
                        <input type="text" class="form-control" id="serviceOffered" aria-describedby="emailHelp" placeholder="Enter Service Offered">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Price</label>
                        <input type="text" class="form-control" id="priceOfService" placeholder="Price">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="submitServiceButton" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

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
