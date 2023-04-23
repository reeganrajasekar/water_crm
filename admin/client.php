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
                    <div class="col-md-12 col-12 col-sm-12 col-lg-12 align-self-center"
                        style="display:flex;flex-direction:row;justify-content:space-between">
                        <h3 class="page-title mb-0 p-0"><i class="mdi me-2 mdi me-2 mdi-cards-variant"></i>Clients</h3>
                        <button data-bs-toggle="modal" data-bs-target="#myModal"
                            class="btn btn-success d-md-inline-block btn-sm text-white"><i class="mdi mdi-plus"></i> Add
                            User</button>
                    </div>
                </div>
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content" style="border-radius:10px !important">
                            <div class="modal-header">
                                <h4 class="modal-title">Add User</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/admin/create/client.php" method="POST">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" required id="code"
                                            placeholder="Enter Name" name="name">
                                        <label for="code">User Name</label>
                                    </div>
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control" required id="name"
                                            placeholder="Enter Mobile No" name="mob">
                                        <label for="name">Mobile/Phone No</label>
                                    </div>
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control" required id="prize"
                                            placeholder="Enter address" name="address">
                                        <label for="prize">Address</label>
                                    </div>
                                    <button class="btn btn-primary w-100"
                                        style="background-color:#1e88e5;font-weight:700;height:50px">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="mdi me-2 mdi-account-multiple"></i> Client Lists</h4>
                                <div class="table-responsive">
                                    <?php
                                    $results_per_page = 10;
                                    $query = "SELECT *FROM client WHERE NOT(id=1)";
                                    $result = mysqli_query($conn, $query);
                                    $number_of_result = mysqli_num_rows($result);
                                    $number_of_page = ceil($number_of_result / $results_per_page);
                                    if (!isset($_GET['page'])) {
                                        $page = 1;
                                    } else {
                                        $page = $_GET['page'];
                                    }
                                    $page_first_result = ($page - 1) * $results_per_page;
                                    $sql = "SELECT * FROM client WHERE NOT(id=1) order by name ASC  LIMIT " . $page_first_result . ',' . $results_per_page;
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                    ?>
                                    <table class="table user-table">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Name</th>
                                                <th class="border-top-0">Contact</th>
                                                <th class="border-top-0">Address</th>
                                                <th class="border-top-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo ($row['name']) ?></td>
                                                <td><?php echo ($row['mob']) ?></td>
                                                <td><?php echo ($row['address']) ?></td>
                                                <td>
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#myModal<?php echo ($row["id"]) ?>"
                                                        class="btn btn-success  mr-1 mb-1 d-md-inline-block btn-sm text-white"><i
                                                            class="mdi mdi-pencil"></i> edit</button>
                                                    <a onclick="return confirm('Do you want to delete?')"
                                                        href="/admin/delete/client.php?id=<?php echo ($row['id']) ?>"
                                                        class="btn btn-danger  mr-1 mb-1 d-md-inline-block btn-sm text-white"><i
                                                            class="mdi mdi-eraser"></i> delete</a>
                                                </td>
                                                <div class="modal fade" id="myModal<?php echo ($row["id"]) ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content"
                                                            style="border-radius:10px !important">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit <?php echo ($row["name"]) ?>
                                                                </h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/admin/edit/client.php" method="POST">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo ($row["id"]) ?>">
                                                                    <div class="form-floating mb-3">
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo ($row["name"]) ?>"
                                                                            required id="code" placeholder="Enter Name"
                                                                            name="name">
                                                                        <label for="code">User Name</label>
                                                                    </div>

                                                                    <div class="form-floating mt-3 mb-3">
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo ($row["mob"]) ?>" required
                                                                            id="name" placeholder="Enter Mobile No"
                                                                            name="mob">
                                                                        <label for="name">Mobile/Phone No</label>
                                                                    </div>

                                                                    <div class="form-floating mt-3 mb-3">
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo ($row["address"]) ?>"
                                                                            required id="prize"
                                                                            placeholder="Enter address" name="address">
                                                                        <label for="prize">Address</label>
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
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php
                                    } else {
                                        echo "<p style='text-align:center'>No Clients Found</p>";
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
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

    <?php include 'includes/footer.php' ?>
</body>

</html>