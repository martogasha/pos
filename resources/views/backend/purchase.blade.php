@include('backendPartial.nav')
<div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="table-responsive rounded mb-3" style="height:250px">
                            <table class="data-table table mb-0 tbl-server-info">
                                <div class="col-lg-12">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                                        <div>
                                            <h4 class="mb-3">Stock List</h4>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <div class="loader"></div>
                                                        <div clas="loader-txt">
                                                            <p><b>PLEASE WAIT...</b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" data-toggle="modal" data-target="#sellService" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Sell Service</a>
                                    </div>
                                </div>
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
                                                @if($stock->product_quantity<3)
                                                <span class="badge badge-danger">{{$stock->product_quantity}} remianing</span>
                                                @endif

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
    <!-- Modal -->
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
                                                <div class="form-group">
                                                    <label>Customer's Phone Number *</label>
                                                    <input type="text" class="form-control" id="customerPhone">
                                                </div>
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
<!-- Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="error">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300,400);
    h1{
        font-family: 'Roboto', sans-serif;
        font-size: 30px;
        color: #999;
        font-weight: 300;
        margin-bottom: 55px;
        margin-top: 45px;
        text-transform: uppercase;
    }
    h1 small{
        display: block;
        font-size: 18px;
        text-transform: none;
        letter-spacing: 1.5px;
        margin-top: 12px;
    }
    .row{
        max-width: 950px;
        margin: 0 auto;
    }
    .btn{
        white-space: normal;
    }
    .button-wrap {
        position: relative;
        text-align: center;
    .btn {
        font-family: 'Roboto', sans-serif;
        box-shadow: 0 0 15px 5px rgba(0, 0, 0, 0.5);
        border-radius: 0px;
        border-color: #222;
        cursor: pointer;
        text-transform: uppercase;
        font-size: 1.1em;
        font-weight: 400;
        letter-spacing: 1px;
    small {
        font-size: 0.8rem;
        letter-spacing: normal;
        text-transform: none;
    }
    }
    }


    /** SPINNER CREATION **/

    .loader {
        position: relative;
        text-align: center;
        margin: 15px auto 35px auto;
        z-index: 9999;
        display: block;
        width: 80px;
        height: 80px;
        border: 10px solid rgba(0, 0, 0, .3);
        border-radius: 50%;
        border-top-color: #000;
        animation: spin 1s ease-in-out infinite;
        -webkit-animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            -webkit-transform: rotate(360deg);
        }
    }

    @-webkit-keyframes spin {
        to {
            -webkit-transform: rotate(360deg);
        }
    }


    /** MODAL STYLING **/

    .modal-content {
        border-radius: 0px;
        box-shadow: 0 0 20px 8px rgba(0, 0, 0, 0.7);
    }

    .modal-backdrop.show {
        opacity: 0.75;
    }

    .loader-txt {
    p {
        font-size: 13px;
        color: #666;
    small {
        font-size: 11.5px;
        color: #999;
    }
    }
    }

    #output {
        padding: 25px 15px;
        background: #222;
        border: 1px solid #222;
        max-width: 350px;
        margin: 35px auto;
        font-family: 'Roboto', sans-serif !important;
    p.subtle {
        color: #555;
        font-style: italic;
        font-family: 'Roboto', sans-serif !important;
    }
    h4 {
        font-weight: 300 !important;
        font-size: 1.1em;
        font-family: 'Roboto', sans-serif !important;
    }
    p {
        font-family: 'Roboto', sans-serif !important;
        font-size: 0.9em;
    b {
        text-transform: uppercase;
        text-decoration: underline;
    }
    }
    }
</style>
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
                        $('#error').html(data);
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
    $('#submitServiceButton').on('click',function () {
        $service = $('#serviceOffered').val();
        $priceOfService = $('#priceOfService').val();
        $.ajax({
            type:"get",
            url:"{{url('purchaseTable')}}",
            data:{'service':$service,'priceOfService':$priceOfService},
            success:function (data) {
                $('#tableContent').html(data);
                $.ajax({
                    type:"get",
                    url:"{{url('total')}}",
                    data:{'service':$service},
                    success:function (data) {
                        $('#sellService').modal('hide');
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
        $('#loadMe').modal('show');
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
                        $('#loadMe').modal('hide');

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
        $('#loadMe').modal('show');
        var paymentMethod = $('#paymentMethods').val();
        var prodId = $('#purchaseId').val();
        var name = $('#name').val();
        var barcode = $('#barcode').val();
        var price = $('#price').val();
        var quantityOfPurchase = $('#quantityOfPurchase').val();
        var total = $('#total').val();
        var customerPhone = $('#customerPhone').val();
        $.ajax({
            type:"get",
            url:"{{url('sold')}}",
            data:{'product_id':prodId, 'barcode':barcode, 'name':name, 'price':price, 'quantityOfPurchase':quantityOfPurchase, 'payment_method':paymentMethod,'total':total,'customer_phone':customerPhone},
            success:function (data) {
                $('#tableContent').html(data);
                $('#purchaseProducts').modal('hide');
                $('#loadMe').modal('hide');
                alert('PURCHASE SUCCESS');
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });

    });
    $(document).on('click','.delet',function () {
        $purchaseId = $(this).attr('id');
        $.ajax({
            type:"get",
            url:"{{url('deletePurchase')}}",
            data:{'purchase':$purchaseId},
            success:function (data) {
                location.reload();``
                alert('PRODUCT REMOVED');
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
