<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Report</title>
    <!-- CSS only -->
    <style>
        table.print-friendly tr td,
        table.print-friendly tr th {
            page-break-inside: avoid !important;
        }

        table {
            width: 100%;
        }

        table,
        th,
        td {
            border: solid 1px #DDD;
            border-collapse: collapse;
            padding: 2px 3px;
            text-align: left;
        }
    </style>
</head>

<body>
    <?php include '../includes/db.php' ?>


    <?php
$start = $_GET["start"];
$end = $_GET["end"];

$sql = "SELECT * FROM product where DATE(reg_date) BETWEEN '$start' AND '$end' order by id DESC";

$result = $conn->query($sql);
$i = 1;
if ($result->num_rows > 0) {
?>
    <h2 style="text-align:center;margin:30px;text-decoration:underline">General Report</h2>

    <table style="width:auto !important">
        <tbody>
            <tr>
                <th>Total Invoices :</th>
                <td>
                    <?php
    $sql4 = "SELECT id FROM bill where DATE(reg_date) BETWEEN '$start' AND '$end' order by id DESC";
    $result4 = $conn->query($sql4);
    echo ($result4->num_rows);
                    ?>
                </td>
            </tr>
            <tr>
                <th>Total Collection :</th>
                <td>
                    <?php
    $sql4 = "SELECT total FROM bill  where DATE(reg_date) BETWEEN '$start' AND '$end' order by id DESC";
    $result4 = $conn->query($sql4);
    $total = 0;
    if ($result4->num_rows > 0) {
        while ($row4 = $result4->fetch_assoc()) {
            $total = $total + $row4["total"];
        }
    }
    echo ($total);
                    ?>
                </td>
            </tr>
            <tr>
                <th>Total Paid Amount :</th>
                <td>
                    <?php
    $sql4 = "SELECT paid FROM bill  where DATE(reg_date) BETWEEN '$start' AND '$end' order by id DESC";
    $result4 = $conn->query($sql4);
    $total = 0;
    if ($result4->num_rows > 0) {
        while ($row4 = $result4->fetch_assoc()) {
            $total = $total + $row4["paid"];
        }
    }
    echo ($total);
                    ?>
                </td>
            </tr>
            <tr>
                <th>Total Due Amount :</th>
                <td>
                    <?php
    $sql4 = "SELECT paid,total FROM bill where DATE(reg_date) BETWEEN '$start' AND '$end' order by id DESC";
    $result4 = $conn->query($sql4);
    $total = 0;
    if ($result4->num_rows > 0) {
        while ($row4 = $result4->fetch_assoc()) {
            $total = $total + ($row4["total"] - $row4["paid"]);
        }
    }
    echo ($total);
                    ?>
                </td>
            </tr>
            <tr>
                <th>Total New Clients :</th>
                <td>
                    <?php
    $sql4 = "SELECT id FROM client  where DATE(reg_date) BETWEEN '$start' AND '$end' order by id DESC";
    $result4 = $conn->query($sql4);
    echo ($result4->num_rows);
                ?>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <div class="table-responsive">
        <table class="print-friendly table container table-striped table-bordered">
            <thead>
                <tr>
                    <th class="border-top-0">S.No</th>
                    <th class="border-top-0">Product Code</th>
                    <th class="border-top-0">Product Name</th>
                    <th class="border-top-0">Product Quantity</th>
                    <th class="border-top-0">Units Sold</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
    while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo ($i) ?></td>
                    <td><?php echo ($row['code']) ?></td>
                    <td><?php echo ($row['name']) ?></td>
                    <td><?php echo ($row['quantity']) ?></td>
                    <td>
                        <?php
        $id = $row['id'];
        $sql4 = "SELECT items FROM bill where  DATE(reg_date) BETWEEN '$start' AND '$end' order by id DESC";
        $result4 = $conn->query($sql4);
        $sold = 0;
        while ($row4 = $result4->fetch_assoc()) {
            foreach (json_decode($row4["items"]) as $k) {
                if ($k[0] == $id) {
                    $sold = $sold + $k[1];
                }
            }
        }
        echo ($sold);
                ?>
                    </td>
                </tr>
                <?php
        $i++;
    }
        ?>
            </tbody>
        </table>

        <?php
} else {
    echo "<p style='text-align:center'>No Invoices Found</p>";
}
$conn->close();
?>
        <script>
            print()
        </script>
</body>

</html>