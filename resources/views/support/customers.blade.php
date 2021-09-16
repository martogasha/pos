@include('backendPartial.nav')
<div class="content-page">
        <div class="container-fluid add-form-list">
            <h3>Clients Details</h3>
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
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="userEdit"

        </div>

        </div>
    <div class="modal-footer">
        <button type="button" id="resetPassword" class="btn btn-success">Reset Password</button>
        <button type="button" id="submiteditUserButton" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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
                alert('USER ADDED SUCCESS')
                location.reload();
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
    $(document).on('click','.edit',function () {
        $value = $(this).attr('id');
        $.ajax({
            type:"get",
            url:"{{url('editUser')}}",
            data:{'user_id':$value},
            success:function (data) {
                $('#userEdit').html(data);
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
            url:"{{url('deleteUser')}}",
            data:{'user_id':$value},
            success:function (data) {
                alert('USER REMOVED SUCCESS');
                location.reload();
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });

    $('#submiteditUserButton').click(function () {
        $value = $('#userId').val();
        $first_name = $('#first').val();
        $last_name = $('#last').val();
        $email = $('#userEmail').val();
        $phone = $('#userPhone').val();
        $role = $('#userRole').val();
        $.ajax({
            type:"get",
            url:"{{url('postEdit')}}",
            data:{'user_id':$value, 'first_name':$first_name, 'last_name':$last_name, 'email':$email, 'phone':$phone, 'role':$role},
            success:function (data) {
                alert('USER EDIT SUCCESS');
                location.reload();
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
    $('#resetPassword').click(function () {
            $value = $('#userId').val();;
            $.ajax({
                type:"get",
                url:"{{url('resetPassword')}}",
                data:{'user_id':$value},
                success:function (data) {
                    alert('PASSWORD RESET SUCCESS');
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
