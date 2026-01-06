<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Management</title>

    <meta charset="UTF-8">

    <link href="../bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Design.css">
    <script src="../bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid" ID="BG">
        @include ('../Navigation_UI/SideBar')
            <div class="container-fluid" ID="right" align="right">
            @include ('../Navigation_UI/Header')
            <div class="container-fluid" ID="pink">
                <h3>ORDER MANAGEMENT</h3>
            </div>
            @include ('../Navigation_UI/FilterAdmin')
            <div class="container-fluid" ID="middle" align="center">
            <table ID="P_table">
            <tr>
                <th>ORDER ID</th>
                <th>ORDER TOTAL</th>
                <th>DELIVERY ADDRESS</th>
                <th>DATE CREATED</th>
                <th>STATUS</th>
                <th>DETAILS</th>
            </tr>
            @foreach($vdata as $record)
            <tr>
                <td>{{$record->order_id}}</td>
                <td>{{$record->total_amount}}</td>
                <td>{{$record->delivery_address}}</td>
                <td>{{$record->date_created}}</td>
                <td>{{$record->status}}</td>
                <td><a href="/productOrder/{{$record->order_id}}">View</a></td>
            </tr>
             @endforeach
        </table>
    </div>
    @include ('../Navigation_UI/Footer')
    </div>
    </div>
</body>
</html>