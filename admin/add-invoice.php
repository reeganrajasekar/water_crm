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
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
<?php include 'includes/topbar.php' ?>
<?php include 'includes/sidebar.php' ?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0"><i class="mdi me-2 mdi-file-multiple"></i> Add Invoice</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Add Invoice</li>
                        </ol>
                    </nav>
                </div>
            </div>
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
                    <form onsubmit="return false">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" required placeholder="Enter Name" name="name">
                            <label for="code">User Name</label>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="number" class="form-control" id="usermob" required placeholder="Enter Mobile No" name="mob">
                            <label for="name">Mobile/Phone No</label>
                        </div>

                        <div class="form-floating mt-3 mb-3"> 
                            <input type="text" class="form-control" id="useraddress" required placeholder="Enter address" name="address">
                            <label for="prize">Address</label>
                        </div>

                        <button onclick="adduser()" class="btn btn-primary w-100" style="background-color:#1e88e5;font-weight:700;height:50px">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi me-2 mdi-file-multiple"></i>Client Information</h4>
                <div class="form-horizontal form-material mx-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label >Client Mobile No</label>
                                    <input onchange="changemob()" type="number" id="mob" class="form-control ps-0 form-control-line" placeholder="Mobile no">
                                </div>
                            </div>
                            <div class="col-3">
                                <button id="search_btn" class="btn btn-primary mt-4 w-100" onclick="getuser()" style="background-color:#1e88e5;"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label >Client Name</label>
                                <input onchange="changename()" type="text" id="name" class="form-control ps-0 form-control-line" placeholder="Client Name">
                            </div>
                    </div>
                    <div class="col-md-12">
                            <div class="form-group">
                                <label >Client Address</label>
                                <input onchange="changeaddress()" type="text" id="address" class="form-control ps-0 form-control-line" placeholder="Client Address">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
function changemob(){
    var mob= $('#mob').val();
    $("#mainusermob").val(mob)
}
function changename(){
    var mob= $('#name').val();
    $("#mainusername").val(mob)
}
function changeaddress(){
    var mob= $('#address').val();
    $("#mainuseraddress").val(mob)
}
function getuser(){
var id= $('#mob').val();
$('#usermob').val(id);
if(id != '')
{
    $("#search_btn").prop('disabled', true)
$.ajax({
    url:"/admin/api/getuser.php?mob="+id,
    method:"GET",
    dataType:"JSON",
    success:function(data)
    {
    if(data=="0"){
        $('#myModal').modal('show');
        $("#search_btn").prop('disabled', false)
    }else{
        $("#name").val(data.name)
        $("#address").val(data.address)
        $("#mainuser").val(data.id)
        $("#mainusermob").val(data.mob)
        $("#mainuseraddress").val(data.address)
        $("#mainusername").val(data.name)
        $("#mob").prop('disabled', true)
        $("#name").prop('disabled', true)
        $("#address").prop('disabled', true)
    }
    }
})
}
};
function adduser(){
var name= $('#username').val();
var address= $('#useraddress').val();
var mob= $('#usermob').val();
if(true)
{
$.ajax({
    url:"/admin/api/adduser.php?mob="+mob+"&name="+name+"&address="+address,
    method:"GET",
    dataType:"JSON",
    success:function(data)
    {
    if(data=="0"){
        $('#myModal').modal('hide');
        $('#mob').val(mob);
        getuser();
    }else{
        alert("Something went Wrong")
    }
    }
})
}
};
function form_valid(){
    if($("#mainuser").val()=="1" && $("#mainusermob").val()=="" || $("#mainusername").val()=="" || $("#mainuseraddres").val()==""){
        document.getElementById("mob").focus();
        return false
    }else{
        return true
    }
}
</script>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi me-2 mdi-file-multiple"></i> Invoice Information</h4>
                    <div class="col-lg-12">
                    <form onsubmit="return form_valid()" class="form-horizontal form-material mx-2" action="/admin/create/invoice.php" method="POST">
                        <input type="hidden" value="1" id="mainuser" name="userid">
                        <input type="hidden" value="" id="mainusername" name="username">
                        <input type="hidden" value="" id="mainusermob" name="usermob">
                        <input type="hidden" value="" id="mainuseraddress" name="useraddress">
                        <input type="hidden" value="" id="overitems" name="overitems">
                            <div class="table-responsive">
                    <table class="table user-table">
                        <thead style="background-color:rgb(30,136,229);color:#fff">
                            <tr>
                                <th class="border-top-0" style="color:#fff">S.No</th>
                                <th class="border-top-0" style="color:#fff">Product</th>
                                <th class="border-top-0" style="color:#fff">Quantity</th>
                                <th class="border-top-0" style="color:#fff">Unit Price</th>
                                <th class="border-top-0" style="color:#fff">Amount</th>
                                <th class="border-top-0" style="color:#fff">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="i0"></tr>
                            <script>
                                sno=1;
                                var i=0;
                                document.getElementById('overitems').value= i+1;
                                function addlist(i){
                                    document.getElementById("i"+i).innerHTML =`
                                    <td>
                                        ${sno} .
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select required onchange="getproduct(${i})" id="itemid${i}" name="itemid${i}" class="form-select shadow-none ps-0 border-0 form-control-line">
                                                <option value="" disabled selected hidden>Choose Product</option>
                                                <?php
                                                $sql = "SELECT id ,name FROM product where stock>0";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo ($row["id"]) ?>"><?php echo ($row["name"]) ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input required onchange="amount(${i})" type="number" id="totalitem${i}" name="totalitem${i}" max=0 class="form-control ps-0 form-control-line" placeholder="add quantity">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input required type="number" id="rate${i}" readonly="readonly" name="rate${i}" class="form-control ps-0 form-control-line" placeholder="add price">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input required type="number" id="amount${i}" readonly="readonly" name="amount${i}" class="form-control ps-0 form-control-line" placeholder="Amount">
                                        </div>
                                    </td>
                                    <td style="color:red;padding:10px;font-weight:800;text-align:center" onclick="delete_node(${i})">
                                        X
                                    </td>
                                    `
                                    function insertAfter(referenceNode, newNode) {
                                        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
                                    }
                                    var el = document.createElement("tr");
                                    el.id = 'i'+(i+1);
                                    var div = document.getElementById('i'+i);
                                    insertAfter(div, el);
                                    document.getElementById('overitems').value=i+1;
                                    window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });
                                }
                                addlist(i)
                                function delete_node(item){
                                    document.getElementById("i"+item).remove();
                                    var get=0;
                                    for(j=0;j<=i;j++){
                                        if($('#amount'+j).val()){
                                            get=parseInt(get)+parseInt($('#amount'+j).val());
                                        }
                                    }
                                    $('#totalamount').val(get);
                                }
                                function getproduct(item){
                                    var product_code= $('#itemid'+item).val();
                                    if(true)
                                    {
                                        $.ajax({
                                        url:"/admin/api/getproduct.php?id="+product_code,
                                        method:"GET",
                                        dataType:"JSON",
                                        success:function(data)
                                        {
                                            if(data=="0"){
                                                alert("Something went Wrong")
                                            }else{
                                                $('#rate'+item).val(data.rate);
                                                $('#totalitem'+item).prop("max",parseInt(data.stock));
                                            }
                                        }
                                        })
                                    }
                                };
                                function amount(item){
                                    var rate= $('#rate'+item).val();
                                    var quan= $('#totalitem'+item).val();
                                    $('#amount'+item).val(rate*quan);
                                    var get=0;
                                    for(j=0;j<=i;j++){
                                        if($('#amount'+j).val()){
                                            get=parseInt(get)+parseInt($('#amount'+j).val());
                                        }
                                    }
                                    $('#totalamount').val(get);
                                    $('#calcamount').val(get);
                                    $('#paidamount').prop("max",get);
                                    $('#bal').prop("min",get);
                                    
                                };
                                </script>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Subtotal</td>
                                <td><div class="form-group">
                                    <input required type="text" readonly="readonly" name="totalamount" id="totalamount" class="form-control ps-0 form-control-line">
                                </div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span onclick="sno++;i++;addlist(i)" class="btn btn-success d-md-inline-block btn-md text-white" style="margin-left:80%"><i class="fa fa-plus"></i> add</span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="">Payment Method</label>
                                    <select required id="paymentmethod" name="paymentmethod" class="form-select shadow-none ps-0 border-0 form-control-line">
                                        <option value="" disabled selected hidden>Choose Payment Method</option>
                                        <option>Cash</option>
                                        <option>Online (Gpay,etc.,)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Paid Amount</label>
                                    <input  required type="number" placeholder="Paid Amount" name="paidamount" id="paidamount" class="form-control ps-0 form-control-line">
                                </div>
                            </div>
                        </div>
                        <a href="invoice.php" class="btn btn-danger d-md-inline-block btn-md text-white">Cancel</a>
                        <button class="btn btn-success d-md-inline-block btn-md text-white">Save</button>
                    </form>
                    <div style="display:flex;justify-content:flex-end">
                        <button data-bs-toggle="modal" data-bs-target="#calc" class="btn btn-success d-md-inline-block btn-md text-white">Balance Calculator</button>
                    </div>
                    <div class="modal fade" id="calc">
                        <div class="modal-dialog">
                            <div class="modal-content" style="border-radius:10px !important">
                                <div class="modal-header">
                                    <h4 class="modal-title">Balance Calculator</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="calcamount" disabled>
                                        <label for="code">Total Amount</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" onchange="balance()" id="bal" required placeholder="Enter Given Amount" >
                                        <label for="code">Given Amount</label>
                                    </div>
                                    <p class="text-center pt-3" style="color:#000;font-size:22px;font-weight:500">Balance Amount : ₹<span style="color:#000;font-size:22px;font-weight:800" id="balamount"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function balance(){
                            baltot = $("#calcamount").val()
                            tot = $("#bal").val()
                            $("#balamount").html(parseFloat(tot)-parseFloat(baltot))
                        }
                    </script>                    
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