<?php include 'includes/db.php';
$id = sprintf("%06d", $_GET["id"]);
$sql = "SELECT * FROM bill where id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bill-<?php echo ($id); ?></title>
  <link rel="stylesheet" href="/admin/css/stylebill.css" media="all" />
  <script src="https://momentjs.com/downloads/moment.min.js"></script>
</head>
<body id="divId">
    <div id="logo">
      <img src="/static/images/logo.png">
      <div id="company" class="clearfix">
        <div>Water Service</div>
        <div>Address</div>
        <div>(+91) 1234567890</div>
      </div>
    </div>
    <h1>INVOICE</h1>
    <div id="project">
      <p><span>Bill No :</span><?php echo ($id); ?></p>
      <p><span>Client :</span><?php echo ($row["username"]) ?></p>
      <p><span>Contact No :</span> +91 <?php echo ($row["usermob"]) ?></p>
      <p><span>Address :</span><?php echo ($row["useraddress"]) ?></p>
      <p><span>Date :</span>
        <script>document.write(moment("<?php echo ($row["reg_date"]) ?>").format('LLL'))</script>
      </p>
    </div>
  <main>
    <table>
      <thead>
        <tr>
          <th class="service">S.No</th>
          <th class="desc">Product</th>
          <th>PRICE</th>
          <th>QTY</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
        <?php
    $data = json_decode($row["items"]);
    $i = 1;
    foreach ($data as $item) {
            ?>
        <tr>
          <td class="service"><?php echo ($i) ?></td>
          <td class="desc">
            <?php
      $sql = "SELECT name FROM product where id=$item[0]";
      $result1 = $conn->query($sql);
      while ($row1 = $result1->fetch_assoc()) {
        echo ($row1["name"]);
      }
                ?></td>
          <td class="unit"><?php echo ($item[2]) ?></td>
          <td class="qty"><?php echo ($item[1]) ?></td>
          <td class="total"><?php echo ($item[3]) ?></td>
        </tr>
        <?php $i++;
    } ?>
        <tr>
          <td colspan="4" class="grand total" style="text-align:right !important">GRAND TOTAL</td>
          <td class="grand total"><?php echo ($row["total"]) ?></td>
        </tr>
      </tbody>
    </table>
    <?php }
} ?>
  </main>
  <script>
    print()
  </script>
</body>
</html>