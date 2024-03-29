@include('backendPartial.nav')
<div class="content-page">
        <div class="container-fluid">
            @if(\Illuminate\Support\Facades\Auth::check()->role==0)
            <div class="row">
                    <div class="col-lg-12">
                        <h3>Records for date: <span id="headerOfSales" style="color: red"></span></h3>
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4" >
                            <div id="showTotalSales">
                                <h4>Total Sale: <span style="color: blue" id="totalSale"></span></h4>
                                <h4>Profit: <span style="color: green" id="totalProfit"></span></h4>
                                <h4>Expense: <span style="color: blue" id="displayExpense"></span></h4>
                                <h2>Total Profit: <span style="color:red" id="sumProfit"></span></h2>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">End Date *</label>
                                    <input type="date" class="form-control" id="endDate" name="dob" />
                                </div>
                            </div>

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
                                <th>Barcode</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                                <th>Profit</th>
                                <th>Payment</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="ligth-body" id="filteredRecord">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            <!-- Page end  -->
        </div>
        <!-- Modal Edit -->
        <div class="modal fade" id="completeSale" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="popup text-left">
                            <div class="media align-items-top justify-content-between">
                                <h3 class="mb-3">Complete Sale</h3>
                                <div class="btn-cancel p-0" data-dismiss="modal"><i class="las la-times"></i></div>
                            </div>
                            <div class="content edit-notes">
                                <div class="card card-transparent card-block card-stretch event-note mb-0">
                                    <div class="card-body px-0 bukmark">
                                        <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
                                            <div class="quill-tool">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="dob">Date *</label>
                                                <input type="date" class="form-control" id="dob" name="dob" />
                                            </div>
                                        </div>                                     </div>
                                    <div class="card-footer border-0">
                                        <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                            <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                                            <div class="btn btn-outline-primary" id="completeSaleButton">Save</div>
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
    $('#endDate').change(function () {
        var endDate = $('#endDate').val();
        $.ajax({
            type:"get",
            url:"{{url('filterRecord')}}",
            data:{'date':endDate},
            success:function (data) {
                $('#filteredRecord').html(data);
                $.ajax({
                    type:"get",
                    url:"{{url('filterPrice')}}",
                    data:{'date':endDate},
                    success:function (data) {
                        $('#totalSale').text(data);
                        $.ajax({
                            type:"get",
                            url:"{{url('filterProfit')}}",
                            data:{'date':endDate},
                            success:function (data) {
                                $('#totalProfit').text(data);
                                $.ajax({
                                    type:"get",
                                    url:"{{url('filterHeader')}}",
                                    data:{'date':endDate},
                                    success:function (data) {
                                        $('#headerOfSales').text(data);
                                        $.ajax({
                                            type:"get",
                                            url:"{{url('filterExpense')}}",
                                            data:{'date':endDate},
                                            success:function (data) {
                                                $('#displayExpense').text(data);
                                                $.ajax({
                                                    type:"get",
                                                    url:"{{url('finalProfit')}}",
                                                    data:{'date':endDate},
                                                    success:function (data) {
                                                        $('#sumProfit').text(data);

                                                    },
                                                    error:function (error) {
                                                        console.log(error)
                                                        alert('NO RECORD FOUND')

                                                    }

                                                });

                                            },
                                            error:function (error) {
                                                console.log(error)
                                                alert('NO RECORD FOUND')

                                            }

                                        });

                                    },
                                    error:function (error) {
                                        console.log(error)
                                        alert('NO RECORD FOUND')

                                    }

                                });

                            },
                            error:function (error) {
                                console.log(error)
                                alert('NO RECORD FOUND')

                            }

                        });
                    },
                    error:function (error) {
                        console.log(error)
                        alert('NO RECORD FOUND')

                    }

                });
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
