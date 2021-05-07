@include('backendPartial.nav')
<div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="table-responsive rounded mb-3" style="height:250px">
                            <table class="data-table table mb-0 tbl-server-info">
                                <h4>Items on Stock</h4>
                                <br>
                                <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox1">
                                            <label for="checkbox1" class="mb-0"></label>
                                        </div>
                                    </th>
                                    <th>Barode</th>
                                    <th>Name</th>
                                    <th>price</th>
                                    <th>Pack</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="ligth-body">
                                @foreach($stocks as $stock)
                                <tr>
                                    <td>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox2">
                                            <label for="checkbox2" class="mb-0"></label>
                                        </div>
                                    </td>
                                    <td>{{$stock->product_barcode}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('uploads/product/'.$stock->product_image)}}" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                            <div>
                                                {{$stock->product_name}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$stock->selling_price}} /=</td>
                                    @if($stock->number_of_pack)
                                    <td>{{intdiv($stock->product_quantity, $stock->quantity_of_pack)}}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                        <td>{{$stock->product_quantity}}</td>
                                    <td>
                                        <button class="btn btn-success view" id="{{$stock->id}}" data-toggle="modal" data-target="#sell">Sell</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="data-table table mb-0 tbl-server-info">
                            <h4>Selected Items for Purchase</h4>
                            <button class="btn btn-danger" id="startOver">Start Over</button>
                            <button class="btn btn-info" id="resume">Resume</button>
                            <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">

                                <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th>
                                <th>Barcode</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="ligth-body" id="tableContent">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
        <!-- Modal Edit -->
    <div class="modal fade" id="sell" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <div class="media align-items-top justify-content-between">
                            <h3 class="mb-3">Product</h3>
                            <div class="btn-cancel p-0" data-dismiss="modal"><i class="las la-times"></i></div>
                        </div>
                        <div class="content edit-notes">
                            <div class="card card-transparent card-block card-stretch event-note mb-0">
                                <div class="card-body px-0 bukmark" id="basic">
                                </div>
                                <div class="card-footer border-0">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                        <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                                        <button class="btn btn-primary mr-2" id="selling">Make Sale</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editPurchase" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <div class="media align-items-top justify-content-between">
                            <h3 class="mb-3">Edit</h3>
                            <div class="btn-cancel p-0" data-dismiss="modal"><i class="las la-times"></i></div>
                        </div>
                        <div class="content edit-notes">
                            <div class="card card-transparent card-block card-stretch event-note mb-0">
                                <div class="card-body px-0 bukmark" id="editPurchaseModal">
                                </div>
                                <div class="card-footer border-0">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                        <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                                        <button class="btn btn-primary mr-2" id="editPurchaseProduct">Edit</button>
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
</div>
<div class="modal fade" id="purchaseProducts" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Payment</h4>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <h3>Total: <span style="border-bottom: 5px double" id="appendTotal"><b></b></span></h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Payment Method *</label>
                                                <select name="type" class="selectpicker form-control" id="paymentMethods" data-style="py-0">
                                                    <option value="cash">Cash</option>
                                                    <option value="mpesa">Mpesa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary mr-2" id="completePurchase">Complete</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Wrapper End-->
<footer class="iq-footer" id="footerTotal">
</footer>
<br>
<footer class="iq-footer" id="footer">
    <button class="btn btn-success" data-toggle="modal" data-target="#purchaseProducts">Complete Purchase</button>

</footer>
<br>

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
    $(document).on('click','.view',function () {
        $value = $(this).attr('id');
        $.ajax({
            type:"get",
            url:"{{url('getPurchaseProduct')}}",
            data:{'product':$value},
            success:function (data) {
                $('#basic').html(data);
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
    $('#selling').on('click',function () {
        $prodId = $('#productId').val();
        $quantity = $('#quantity').val();
        $price = $('#priceL').val();
        $.ajax({
            type:"get",
            url:"{{url('purchaseTable')}}",
            data:{'product':$prodId,'product_quantity':$quantity,'product_price':$price},
            success:function (data) {
                $('#tableContent').html(data);
                $('#sell').modal('hide');
                $.ajax({
                    type:"get",
                    url:"{{url('total')}}",
                    data:{'product':$prodId},
                    success:function (data) {
                        $('#footerTotal').html(data);
                        $("html, body").animate({
                            scrollTop: $(
                                'html, body').get(0).scrollHeight
                        }, 2000);
                    },
                    error:function (error) {
                        console.log(error)
                        alert('error')

                    }

                });
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
    $(document).on('click','.edit',function () {
        $purchaseId = $(this).attr('id');
        $.ajax({
            type:"get",
            url:"{{url('editPurchase')}}",
            data:{'purchase':$purchaseId},
            success:function (data) {
                $('#editPurchaseModal').html(data);
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
    $('#editPurchaseProduct').click(function () {
        $id = $('#pId').val();
        $quantityPurchase = $('#quantityPurchase').val();
        $price = $('#pricePurchase').val();
        $.ajax({
            type:"get",
            url:"{{url('ePurchase')}}",
            data:{'purchase':$id,'quantity':$quantityPurchase,'price':$price},
            success:function (data) {
                $('#tableContent').html(data);
                $('#editPurchase').modal('hide');
                $.ajax({
                    type:"get",
                    url:"{{url('total')}}",
                    data:{'product':$prodId},
                    success:function (data) {
                        $('#footerTotal').html(data);
                        $("html, body").animate({
                            scrollTop: $(
                                'html, body').get(0).scrollHeight
                        }, 2000);
                    },
                    error:function (error) {
                        console.log(error)
                        alert('error')

                    }

                });
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
    $('#startOver').click(function () {
        $.ajax({
            type:"get",
            url:"{{url('startOver')}}",
            data:"",
            success:function (data) {
                $('#tableContent').html(data);
                $.ajax({
                    type:"get",
                    url:"{{url('total')}}",
                    data:"{'product':$prodId}",
                    success:function (data) {
                        $('#footerTotal').html(data);
                        $("html, body").animate({
                            scrollTop: $(
                                'html, body').get(0).scrollHeight
                        }, 2000);
                    },
                    error:function (error) {
                        console.log(error)
                        alert('error')

                    }

                });

            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
    $('#resume').click(function () {
        $.ajax({
            type:"get",
            url:"{{url('resume')}}",
            data:"",
            success:function (data) {
                $('#tableContent').html(data);
                $("html, body").animate({
                    scrollTop: $(
                        'html, body').get(0).scrollHeight
                }, 2000);
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
    $('#completePurchase').click(function () {
        var paymentMethod = $('#paymentMethods').val();
        var prodId = $('#productId').val();
        var total = $('#total').val();
        $.ajax({
            type:"get",
            url:"{{url('sold')}}",
            data:{'product_id':prodId,'payment_method':paymentMethod,'total':total},
            success:function (data) {
                $('#tableContent').html(data);
                $('#purchaseProducts').modal('hide');
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });

    });
</script>

<!-- Mirrored from iqonic.design/themes/posdash/html/backend/page-list-sale.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Mar 2021 21:36:26 GMT -->
</html>
