<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Management</title>

    <meta charset="UTF-8">

    <link href="../bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Design.css">
    <script src="../bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
</head>


<body>
<div class="container" ID="sidebar">

                <div class="container" align="left" ID="Profile"></div>
                <div class="container" ID="SBbutton"><a href="{{url('/Dashboard')}}">DASHBOARD</a></div>
                <div class="container" ID="SBbutton"><a href="{{url('/UserManagement')}}">USER MANAGEMENT</a></div>
                <div class="container" ID="SBbutton"><a href="{{url('/ProductManagement')}}">PRODUCT MANAGEMENT</a></div>
                <div class="container" ID="SBbutton"><a href="{{url('/OrderManagement')}}">ORDER MANAGEMENT</a></div>
                <div class="container" ID="SBbutton"><a href="{{url('/ShopManagement')}}">SHOP MANAGEMENT</a></div>
                <div class="container" ID="SBbutton"><a href="#">LOG OUT</a></div>
</div>
</body>