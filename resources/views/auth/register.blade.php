


<!doctype html>
<html lang="en">

<!-- Mirrored from iqonic.design/themes/posdash/html/backend/auth-sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Mar 2021 21:32:52 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>POS Dash | Responsive Bootstrap 4 Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link rel="stylesheet" href="assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="assets/css/backende209.css?v=1.0.0">
    <link rel="stylesheet" href="assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/remixicon/fonts/remixicon.css">  </head>
<body class=" ">
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->

<div class="wrapper">
    <section class="login-content">
        <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
                <div class="col-lg-8">
                    <div class="card auth-card">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center auth-content">
                                <div class="col-lg-7 align-self-center">
                                    <div class="p-3">
                                        <h2 class="mb-2">Sign Up</h2>
                                        <p>Create your POS account.</p>
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" name="first_name" type="text" placeholder=" ">
                                                        <label>First Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" name="last_name" type="text" placeholder=" ">
                                                        <label>Last Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" name="email" type="email" placeholder=" ">
                                                        <label>Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" type="text" placeholder=" ">
                                                        <label>Phone No.</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" name="business_name" type="text" placeholder=" ">
                                                        <label>Business Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="floating-label form-group">
                                                        <select name="type" class="selectpicker form-control" name="business_type" data-style="py-0">
                                                            <option>Business Type</option>
                                                            <option value="shop">Shop</option>
                                                            <option value="butchery">Butchery</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" type="password" id="password1" placeholder=" ">
                                                        <label>Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" type="password" id="confirmPassword1" placeholder=" ">
                                                        <label>Confirm Password</label>
                                                    </div>
                                                </div>
                                                <span class="badge badge-success" id="passwordMatch">Password match</span>
                                                <span class="badge badge-danger" id="passwordError">Password don't match match</span>
                                                <div class="col-lg-12">
                                                    <div class="custom-control custom-checkbox mb-3">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">I agree with the terms of use</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Sign Up</button>
                                            <p class="mt-3">
                                                Already have an Account <a href="{{url('/')}}" class="text-primary">Sign In</a>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-5 content-right">
                                    <img src="assets/images/login/pos.jpg" class="img-fluid image-right" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
        $('#passwordError').hide();
        $('#passwordMatch').hide();
    });
   $('#confirmPassword1').on('keyup',function () {
       if ($('#password1').val() == $('#confirmPassword1').val() ){
           $('#passwordMatch').show();
           $('#passwordError').hide();
       }
       else {
           $('#passwordError').show();
           $('#passwordMatch').hide();
       }
   });
</script>

<!-- Mirrored from iqonic.design/themes/posdash/html/backend/auth-sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Mar 2021 21:32:56 GMT -->
</html>
