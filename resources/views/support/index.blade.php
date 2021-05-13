@include('backendPartial.nav')
<div class="content-page">
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add User</h4>
                            </div>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" data-errors="Please Enter First Name." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" data-errors="Please Enter Last Name." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email *</label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter Email Address" data-errors="Please Enter Email Address." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number *</label>
                                            <input type="text" class="form-control" id="phone" placeholder="Enter Phone Number" data-errors="Please Enter Phone Number." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>User Role *</label>
                                            <select name="type" id="role" class="selectpicker form-control" data-style="py-0">
                                                <option value="0">Admin</option>
                                                <option value="1">User</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <button type="button" class="btn btn-primary mr-2" id="addUserButton">Add User</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
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
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="ligth-body">
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox2">
                                    <label for="checkbox2" class="mb-0"></label>
                                </div>
                            </td>
                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            @if($user->role==0)
                            <td>admin</td>
                            @else
                                <td>User</td>
                            @endif
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                       href="#"><i class="ri-eye-line mr-0"></i></a>
                                    <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                       href="#"><i class="ri-pencil-line mr-0"></i></a>
                                    <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                       href="#"><i class="ri-delete-bin-line mr-0"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
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
    $('#addUserButton').click(function () {
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var role = $('#role').val();
        $.ajax({
            type:"get",
            url:"{{url('addUser')}}",
            data:{'first_name':first_name,'last_name':last_name,'phone':phone,'email':email,'role':role},
            success:function (data) {
                location.reload();
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
</script>
<!-- Mirrored from iqonic.design/themes/posdash/html/backend/page-add-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Mar 2021 21:36:26 GMT -->
</html>
