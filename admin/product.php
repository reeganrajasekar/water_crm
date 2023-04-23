<!DOCTYPE html>
<html dir="ltr" lang="en">

<?php include 'includes/header.php' ?>
<?php include 'includes/db.php' ?>

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
                        <h3 class="page-title mb-0 p-0"><i class="mdi me-2 mdi me-2 mdi-cards-variant"></i> Products
                        </h3>
                        <button data-bs-toggle="modal" data-bs-target="#myModal"
                            class="btn btn-success d-md-inline-block btn-sm text-white"><i class="mdi mdi-plus"></i> Add
                            Product</button>
                    </div>
                </div>


                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content" style="border-radius:10px !important">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Product</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/admin/create/product.php" method="POST">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" required id="code"
                                            placeholder="Enter Product Code" name="code">
                                        <label for="code">Product Code</label>
                                    </div>

                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control" required id="name"
                                            placeholder="Enter Product Name" name="name">
                                        <label for="name">Product Name</label>
                                    </div>

                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control" required id="quantity"
                                            placeholder="Enter Product quantity" name="quantity">
                                        <label for="quantity">Product Quantity</label>
                                    </div>

                                    <div class="form-floating mt-3 mb-3">
                                        <input type="number" class="form-control" required id="prize"
                                            placeholder="Enter Product Prize" name="rate">
                                        <label for="prize">Product Prize</label>
                                    </div>

                                    <div class="form-floating mt-3 mb-3">
                                        <input type="number" class="form-control" required id="stock"
                                            placeholder="Enter Product Stock" name="stock">
                                        <label for="stock">Product Stock</label>
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
                                <h4 class="card-title"><i class="mdi me-2 mdi me-2 mdi-cards-variant"></i> Product Lists
                                </h4>
                                <div class="table-responsive">
                                    <?php

                                    $results_per_page = 10;
                                    $query = "select *from product";
                                    $result = mysqli_query($conn, $query);
                                    $number_of_result = mysqli_num_rows($result);
                                    $number_of_page = ceil($number_of_result / $results_per_page);

                                    if (!isset($_GET['page'])) {
                                        $page = 1;
                                    } else {
                                        $page = $_GET['page'];
                                    }

                                    $page_first_result = ($page - 1) * $results_per_page;

                                    $sql = "SELECT * FROM product order by name ASC LIMIT " . $page_first_result . ',' . $results_per_page;
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                    ?>
                                    <table class="table user-table">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Code</th>
                                                <th class="border-top-0">Product Name</th>
                                                <th class="border-top-0">Product Quantity</th>
                                                <th class="border-top-0">Prize</th>
                                                <th class="border-top-0">Stock Available</th>
                                                <th class="border-top-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo ($row['code']) ?></td>
                                                <td><?php echo ($row['name']) ?></td>
                                                <td><?php echo ($row['quantity']) ?></td>
                                                <td>₹<?php echo ($row['rate']) ?></td>
                                                <td><?php echo ($row['stock']) ?></td>
                                                <td>
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#myModal<?php echo ($row["id"]) ?>"
                                                        class="btn btn-success d-md-inline-block btn-sm text-white mr-1 mb-1"><i
                                                            class="mdi mdi-pencil"></i> edit</button>
                                                    <a onclick="return confirm('Do you want to delete?')"
                                                        href="/admin/delete/product.php?id=<?php echo ($row['id']) ?>"
                                                        class="btn btn-danger d-md-inline-block btn-sm text-white  mr-1 mb-1"><i
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
                                                                <form action="/admin/edit/product.php" method="POST">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo ($row["id"]) ?>">
                                                                    <div class="form-floating mb-3 ">
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo ($row["code"]) ?>" required
                                                                            id="code" placeholder="Enter Product Code"
                                                                            name="code">
                                                                        <label for="code">Product Code</label>
                                                                    </div>

                                                                    <div class="form-floating mt-3 mb-3">
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo ($row["name"]) ?>" required
                                                                            id="name" placeholder="Enter Product Name"
                                                                            name="name">
                                                                        <label for="name">Product Name</label>
                                                                    </div>

                                                                    <div class="form-floating mt-3 mb-3">
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo ($row["quantity"]) ?>"
                                                                            required id="quantity"
                                                                            placeholder="Enter Product quantity"
                                                                            name="quantity">
                                                                        <label for="quantity">Product Quantity</label>
                                                                    </div>

                                                                    <div class="form-floating mt-3 mb-3">
                                                                        <input type="number" class="form-control"
                                                                            value="<?php echo ($row["rate"]) ?>" required
                                                                            id="prize" placeholder="Enter Product Prize"
                                                                            name="rate">
                                                                        <label for="prize">Product Prize</label>
                                                                    </div>

                                                                    <div class="form-floating mt-3 mb-3">
                                                                        <input type="number" class="form-control"
                                                                            value="<?php echo ($row["stock"]) ?>" required
                                                                            id="stock" placeholder="Enter Product Stock"
                                                                            name="stock">
                                                                        <label for="stock">Product Stock</label>
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
                                        echo "<p style='text-align:center'>No Products Found</p>";
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