<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php include 'includes/db.php' ?>
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
                        <h3 class="page-title mb-0 p-0"><i class="mdi me-2 mdi-gauge"></i> Dashboard</h3>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title"><i class="fa fa-file fa-3x text-warning">
                                        <?php
                                        $sql = "SELECT id FROM bill";
                                        $result = $conn->query($sql);
                                        echo ($result->num_rows);
                                        ?>
                                    </i></h3>
                                <h6 class="card-subtitle">Number of Invoice</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title"><i class="fa fa-money fa-3x text-success">₹
                                        <?php
                                        $sql = "SELECT total FROM bill";
                                        $result = $conn->query($sql);
                                        $total = 0;
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $total = $total + $row["total"];
                                            }
                                        }
                                        echo ($total);
                                        ?>
                                    </i></h3>
                                <h6 class="card-subtitle">Total Collection</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title"><i class="fa fa-barcode fa-3x text-danger">
                                        <?php
                                        $sql = "SELECT id FROM product";
                                        $result = $conn->query($sql);
                                        echo ($result->num_rows);
                                        ?>
                                    </i></h3>
                                <h6 class="card-subtitle">Number of Products</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title"><i class="fa fa-users fa-3x text-info">
                                        <?php
                                        $sql = "SELECT id FROM client where NOT id=1";
                                        $result = $conn->query($sql);
                                        echo ($result->num_rows);
                                        ?>
                                    </i></h3>
                                <h6 class="card-subtitle">Number of Clients</h6>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="mdi me-2 mdi-file-multiple"></i>Unpaid List</h4>
                                <div class="table-responsive">
                                    <?php

                                    $results_per_page = 10;
                                    $query = "select * from bill where total!=paid";
                                    $result = mysqli_query($conn, $query);
                                    $number_of_result = mysqli_num_rows($result);
                                    $number_of_page = ceil($number_of_result / $results_per_page);

                                    if (!isset($_GET['page'])) {
                                        $page = 1;
                                    } else {
                                        $page = $_GET['page'];
                                    }

                                    $page_first_result = ($page - 1) * $results_per_page;

                                    $sql = "SELECT * FROM bill order by id DESC LIMIT " . $page_first_result . ',' . $results_per_page;
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        ?>
                                        <table class="table user-table">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0">Invoice No.</th>
                                                    <th class="border-top-0">Status</th>
                                                    <th class="border-top-0">Client</th>
                                                    <th class="border-top-0">Amount</th>
                                                    <th class="border-top-0">Paid</th>
                                                    <th class="border-top-0">Amount Due</th>
                                                    <th class="border-top-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                    if ($row['total'] - $row['paid'] != 0) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo ($row['id']) ?></td>
                                                            <td>
                                                                <?php if ($row['total'] - $row['paid'] == 0) {
                                                                    echo ("<span class='badge bg-success'>paid</span>");
                                                                } else {
                                                                    echo ("<span class='badge bg-warning'>partially paid</span>");
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                echo ($row['username']);
                                                                ?>
                                                            </td>
                                                            <td>₹<?php echo ($row['total']) ?></td>
                                                            <td>₹<?php echo ($row['paid']) ?></td>
                                                            <td>₹<?php echo ($row['total'] - $row['paid']) ?></td>
                                                            <td>
                                                                <a target="blank"
                                                                    href="/admin/bill_print.php?id=<?php echo ($row['id']) ?>"
                                                                    class="btn btn-success d-md-inline-block btn-sm text-white mr-1 mb-1"><i
                                                                        class="mdi mdi-eraser"></i>Print</a>
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#myModal<?php echo ($row["id"]) ?>"
                                                                    class="btn btn-success d-md-inline-block btn-sm text-white mr-1 mb-1"><i
                                                                        class="mdi mdi-pencil"></i> edit</button>
                                                            </td>

                                                            <div class="modal fade" id="myModal<?php echo ($row["id"]) ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content"
                                                                        style="border-radius:10px !important">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Edit Invoice : <?php echo ($row['username'] . " - " . $row["id"]) ?></h4>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="/admin/edit/unpaid.php" method="POST">
                                                                                <input type="hidden" name="id"
                                                                                    value="<?php echo ($row["id"]) ?>">
                                                                                <div class="form-floating mb-3">
                                                                                    <input type="text" class="form-control"
                                                                                        value="<?php echo ($row['username']) ?>" disabled>
                                                                                    <label for="code">Client Name</label>
                                                                                </div>
                                                                                <div class="form-floating mb-3">
                                                                                    <input type="number" class="form-control"
                                                                                        value="<?php echo ($row["total"]) ?>"
                                                                                        disabled>
                                                                                    <label for="code">Total Amount</label>
                                                                                </div>
                                                                                <div class="form-floating mb-3">
                                                                                    <input type="number" class="form-control"
                                                                                        max=<?php echo ($row["total"]) ?>
                                                                                        value="<?php echo ($row["paid"]) ?>"
                                                                                        required id="paid" name="paid">
                                                                                    <label for="code">Paid</label>
                                                                                </div>

                                                                                <button class="btn btn-primary w-100"
                                                                                    style="background-color:#1e88e5;font-weight:700;height:50px">Update</button>
                                                                            </form>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <?php
                                    } else {
                                        echo "<p style='text-align:center'>All Payment Received</p>";
                                    }
                                    $conn->close();
                                    ?>


                                    <p style="text-align:center;line-height:3.5;font-size:16px">
                                        <?php
                                        for ($page = 1; $page <= $number_of_page; $page++) {
                                            if ($page == $_GET['page']) {
                                                echo '<a style="margin:4px;padding:12px;border-radius:2px;border:2px solid #1e88e5;background-color:#1e88e5;font-weight:600;color:#fff;text-decoration:none" href = "?page=' . $page . '">' . $page . ' </a>';
                                            } else {
                                                echo '<a style="margin:4px;padding:10px;border-radius:2px;border:1px solid #aaa;color:#444;text-decoration:none" href = "?page=' . $page . '">' . $page . ' </a>';
                                            }
                                        }
                                        ?>
                                    </p>




                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <?php include 'includes/footer.php' ?>
</body>

</html>