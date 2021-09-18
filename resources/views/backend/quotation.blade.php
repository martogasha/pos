@include('backendPartial.nav')
    <div class="content-page">
        <div class="container-fluid">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
            <div class="page-header text-blue-d2">
                <h1 class="page-title text-secondary-d1">
                    Invoice
                    <small class="page-info">
                        <i class="fa fa-angle-double-right text-80"></i>
                        ID: #111-222
                    </small>
                </h1>

                <div class="page-tools">
                    <div class="action-buttons">
                        <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                            <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                            Print
                        </a>
                        <a class="btn bg-white btn-light mx-1px text-95" href="#" id="PDF">
                            <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                            Export
                        </a>
                    </div>
                </div>
            </div>

            <div class="page-content container" id="receipt">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                <div>
                                    <img src="{{asset('assets/images/icons.png')}}" class="center" alt="Cinque Terre">
                                    <br>
                                    <h5 style="font-size: 18px"><b>IT Consultant, CCTV installation,Computer,Laptop Sales,Data Backup and Recovery</b></h5>
                                    <h5 style="font-size: 15px;color: #2d3748"><span style="color: darkblue">A/c</span>: 01192559085500 (<b style="color: green">Co-op Bank</b>) / <span style="color: darkblue">Till</span>: 000798 (<b style="color: green">Davix Designs</b>)</h5>

                                    <hr style="border: 2px solid red"/>

                                </div>

                            </div>
                        </div>
                    </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <span class="text-sm text-grey-m2 align-middle">To:</span>
                                        <span class="text-600 text-110 text-blue align-middle">Alex Doe</span>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                <div class="container px-0">
                    <div class="row mt-4">
                        <div class="col-12 col-lg-10 offset-lg-1">
                            <!-- .row -->
                            <div class="mt-4">
                                <div class="row text-600 text-white bgc-default-tp1 py-25">
                                    <div class="d-none d-sm-block col-1">#</div>
                                    <div class="col-9 col-sm-5">Description</div>
                                    <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                                    <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                                    <div class="col-2">Amount</div>
                                </div>

                                <div class="text-95 text-secondary-d3">
                                    <div class="row mb-2 mb-sm-0 py-25">
                                        <div class="d-none d-sm-block col-1">1</div>
                                        <div class="col-9 col-sm-5">Domain registration</div>
                                        <div class="d-none d-sm-block col-2">2</div>
                                        <div class="d-none d-sm-block col-2 text-95">$10</div>
                                        <div class="col-2 text-secondary-d2">$20</div>
                                    </div>
                                    <div class="row mb-2 mb-sm-0 py-25">
                                        <div class="d-none d-sm-block col-1">1</div>
                                        <div class="col-9 col-sm-5">Domain registration</div>
                                        <div class="d-none d-sm-block col-2">2</div>
                                        <div class="d-none d-sm-block col-2 text-95">$10</div>
                                        <div class="col-2 text-secondary-d2">$20</div>
                                    </div>
                                    <div class="row mb-2 mb-sm-0 py-25">
                                        <div class="d-none d-sm-block col-1">1</div>
                                        <div class="col-9 col-sm-5">Domain registration</div>
                                        <div class="d-none d-sm-block col-2">2</div>
                                        <div class="d-none d-sm-block col-2 text-95">$10</div>
                                        <div class="col-2 text-secondary-d2">$20</div>
                                    </div>
                                    <div class="row mb-2 mb-sm-0 py-25">
                                        <div class="d-none d-sm-block col-1">1</div>
                                        <div class="col-9 col-sm-5">Domain registration</div>
                                        <div class="d-none d-sm-block col-2">2</div>
                                        <div class="d-none d-sm-block col-2 text-95">$10</div>
                                        <div class="col-2 text-secondary-d2">$20</div>
                                    </div>
                                    <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                                        <div class="d-none d-sm-block col-1">2</div>
                                        <div class="col-9 col-sm-5">Web hosting</div>
                                        <div class="d-none d-sm-block col-2">1</div>
                                        <div class="d-none d-sm-block col-2 text-95">$15</div>
                                        <div class="col-2 text-secondary-d2">$15</div>
                                    </div>

                                    <div class="row mb-2 mb-sm-0 py-25">
                                        <div class="d-none d-sm-block col-1">3</div>
                                        <div class="col-9 col-sm-5">Software development</div>
                                        <div class="d-none d-sm-block col-2">--</div>
                                        <div class="d-none d-sm-block col-2 text-95">$1,000</div>
                                        <div class="col-2 text-secondary-d2">$1,000</div>
                                    </div>

                                    <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                                        <div class="d-none d-sm-block col-1">4</div>
                                        <div class="col-9 col-sm-5">Consulting</div>
                                        <div class="d-none d-sm-block col-2">1 Year</div>
                                        <div class="d-none d-sm-block col-2 text-95">$500</div>
                                        <div class="col-2 text-secondary-d2">$500</div>
                                    </div>
                                </div>

                                <div class="row border-b-2 brc-default-l2"></div>

                                <!-- or use a table instead -->
                                <!--
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                                <thead class="bg-none bgc-default-tp1">
                                    <tr class="text-white">
                                        <th class="opacity-2">#</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th width="140">Amount</th>
                                    </tr>
                                </thead>

                                <tbody class="text-95 text-secondary-d3">
                                    <tr></tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Domain registration</td>
                                        <td>2</td>
                                        <td class="text-95">$10</td>
                                        <td class="text-secondary-d2">$20</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        -->

                                <div class="row mt-3">
                                    <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                        Extra note such as company or payment information...
                                    </div>

                                    <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                        <div class="row my-2">
                                            <div class="col-7 text-right">
                                                SubTotal
                                            </div>
                                            <div class="col-5">
                                                <span class="text-120 text-secondary-d1">$2,250</span>
                                            </div>
                                        </div>

                                        <div class="row my-2">
                                            <div class="col-7 text-right">
                                                Tax (10%)
                                            </div>
                                            <div class="col-5">
                                                <span class="text-110 text-secondary-d1">$225</span>
                                            </div>
                                        </div>

                                        <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                            <div class="col-7 text-right">
                                                Total Amount
                                            </div>
                                            <div class="col-5">
                                                <span class="text-150 text-success-d3 opacity-2">$2,475</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            <!-- Page end  -->
        </div>
    </div>
</div>
<style>
    body{
        margin-top:20px;
        color: #484b51;
    }
    .text-secondary-d1 {
        color: #728299!important;
    }
    .page-header {
        margin: 0 0 1rem;
        padding-bottom: 1rem;
        padding-top: .5rem;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }
    .page-title {
        padding: 0;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 300;
    }
    .brc-default-l1 {
        border-color: #dce9f0!important;
    }

    .ml-n1, .mx-n1 {
        margin-left: -.25rem!important;
    }
    .mr-n1, .mx-n1 {
        margin-right: -.25rem!important;
    }
    .mb-4, .my-4 {
        margin-bottom: 1.5rem!important;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0,0,0,.1);
    }

    .text-grey-m2 {
        color: #888a8d!important;
    }

    .text-success-m2 {
        color: #86bd68!important;
    }

    .font-bolder, .text-600 {
        font-weight: 600!important;
    }

    .text-110 {
        font-size: 110%!important;
    }
    .text-blue {
        color: #478fcc!important;
    }
    .pb-25, .py-25 {
        padding-bottom: .75rem!important;
    }

    .pt-25, .py-25 {
        padding-top: .75rem!important;
    }
    .bgc-default-tp1 {
        background-color: rgba(121,169,197,.92)!important;
    }
    .bgc-default-l4, .bgc-h-default-l4:hover {
        background-color: #f3f8fa!important;
    }
    .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .btn-light {
        color: #757984;
        background-color: #f5f6f9;
        border-color: #dddfe4;
    }
    .w-2 {
        width: 1rem;
    }

    .text-120 {
        font-size: 120%!important;
    }
    .text-primary-m1 {
        color: #4087d4!important;
    }

    .text-danger-m1 {
        color: #dd4949!important;
    }
    .text-blue-m2 {
        color: #68a3d5!important;
    }
    .text-150 {
        font-size: 150%!important;
    }
    .text-60 {
        font-size: 60%!important;
    }
    .text-grey-m1 {
        color: #7b7d81!important;
    }
    .align-bottom {
        vertical-align: bottom!important;
    }

</style>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

</body>
<script>
    window.onload = function () {
        document.getElementById("PDF")
            .addEventListener("click", () => {
                const invoice = this.document.getElementById("receipt");
                console.log(invoice);
                console.log(window);
                var opt = {
                    margin: 1,
                    filename: 'receipt.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                };
                html2pdf().from(invoice).set(opt).save();
            })
    }
</script>
<!-- Mirrored from iqonic.design/themes/posdash/html/backend/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Mar 2021 21:27:27 GMT -->
</html>
