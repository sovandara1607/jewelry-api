<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Order Details</title>

    <meta charset="UTF-8">

    <link href="../bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Design.css">
    <script src="../bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    
</head>

<body>

    <div class="container-fluid" ID="BG">
         @include ('../Navigation_UI/SideBar')
            <div class="container-fluid" ID="right" align="right">
        <div class="container-fluid" ID="blank"></div>
            <div class="container-fluid" ID="pink">
                <h3>ORDER MANAGEMENT</h3>
            </div>
            <div class="container-fluid" ID="grayHeader">
                <h6>ORDER ID:</h6>
                @foreach($vdata as $v)
                <h6>{{$v->order_id}}</h6>
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
                <h6>DATE CREATED: </h6>
                <h6>{{$v->order_date}}</h6>
            </div>
           
            <div class="container" align= "left" ID="ViewOrder">
                <h3>PRODUCTS ORDERED</h3>
                <hr>
            <table ID="ViewOrderTable">
            <tr>
                <th>PRODUCTS' NAME</th>
                <th>PRODUCT ID</th>
                <th>PRICE</th>
                <th>QUANTITY</th>
                <th>SHOP NAME</th>
                
            </tr>
                 
            <tr>
                <td>{{$v->product_name}}</td>
                <td>{{$v->product_id}}</td>
                <td>{{$v->price}}</td>
                <td>{{$v->quantity}}</td>
                <td>{{$v->shop_name}}</td>
            </tr>
            </table>
            <hr>
            <table>
            <tr>
                <th>ORDER TOTAL:&nbsp;&nbsp;</th>
                <th>{{$v->total_amount}}</th>
            </tr>
            </table>
            <table>
            <tr>
                <th>DELIVERY ADDRESS:&nbsp;&nbsp;</th>
                <th>{{$v->delivery_address}}</th>
            </tr>
            </table>
            <table>
            <tr>
                <th>STATUS:&nbsp;&nbsp;</th>
                <th>{{$v->status}}</th>
            </tr>
            </table>
             @endforeach
            </div>
            </div>
</body>
<html>