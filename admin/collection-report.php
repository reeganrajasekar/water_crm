<!DOCTYPE html>
<html dir="ltr" lang="en">

<?php include 'includes/header.php' ?>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <?php include 'includes/topbar.php' ?>
        <?php include 'includes/sidebar.php' ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0"><i class="mdi me-2 mdi-chart-bar"></i>Reports</h3>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="mdi me-2 mdi-chart-areaspline"></i>Generate Report</h4>

                                <div class="col-md-6 ">
                                    <select onchange="changed()" class="form-select" id="type"
                                        aria-label="Default select example">
                                        <option selected>Select Category</option>
                                        <option value="0">General Report</option>
                                        <option value="1">Product</option>
                                        <option value="2">Payment</option>
                                        <option value="3">Clients</option>
                                    </select>
                                </div>

                                <div id="btn">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getuser() {
            var id = $('#usermob').val();
            if (id != '') {
                $("#search_btn").prop('disabled', true)
                $.ajax({
                    url: "/admin/api/getuser.php?mob=" + id,
                    method: "GET",
                    dataType: "JSON",
                    success: function (data) {
                        if (data == "0") {
                            alert("User Not Found!")
                            $("#client_btn").prop('disabled', true)
                            $("#search_btn").prop('disabled', false)
                        } else {
                            $("#client_btn").prop('disabled', false)
                        }
                    }
                })
            }
        };
        function changed() {
            let type = $("#type").val()
            if (type == 0) {
                $("#btn").html(`
                <form class="container row mt-3" action="/admin/reports/index.php" method="GET">
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">Start Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="start">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">End Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="end">
                    </div>
                    <br>
                    <center>
                        <button class="mt-4 btn btn-primary w-30">Download</button>
                    </center>
                </form>
                `)
            } else if (type == 1) {
                $("#btn").html(`
                <form class="container row mt-3" action="/admin/reports/product.php" method="GET">
                    <br>
                    <center>
                        <button class="mt-4 btn btn-primary w-30">Download</button>
                    </center>
                </form>
                `)
            } else if (type == 2) {
                $("#btn").html(`
                <form class="container row mt-3" action="/admin/reports/payment.php" method="GET">
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">Start Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="start">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">End Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="end">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">Payment Method :</label>
                        <select name="method" required class="form-select" id="type" aria-label="Default select example">
                            <option selected disabled value="">Select Payment Method</option>
                            <option value="all">All</option>
                            <option value="Cash">Cash</option>
                            <option value="Online (Gpay,etc.,)">Online (Gpay,etc.,)</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput"  class="form-label">Payment Details :</label>
                        <select name="payment" required class="form-select" id="type" aria-label="Default select example">
                            <option selected disabled value="">Select Payment Details</option>
                            <option value="all">All</option>
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                    <br>
                    <center>
                        <button class="mt-4 btn btn-primary w-30">Download</button>
                    </center>
                </form>
                `)
            } else if (type == 3) {
                $("#btn").html(`
                <form class="container row mt-3" action="/admin/reports/client.php" method="GET">
                    <div class="col-9">
                        <div class="form-group">
                            <label >Client Mobile No</label>
                            <input type="number" name="mob" required id="usermob" class="form-control ps-0 form-control-line" placeholder="Mobile no">
                        </div>
                    </div>
                    <div class="col-3">
                        <button id="search_btn" class="btn btn-primary mt-4 w-100" onclick="getuser()" style="background-color:#1e88e5;"><i class="mdi mdi-magnify"></i></button>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">Start Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="start">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">End Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="end">
                    </div>
                    <br>
                    <center>
                        <button id="client_btn" disabled class="mt-4 btn btn-primary w-30">Download</button>
                    </center>
                </form>
                `)
            }
        }
    </script>

    <?php include 'includes/footer.php' ?>

</body>

</html>