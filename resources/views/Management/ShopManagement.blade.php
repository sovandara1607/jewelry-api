<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop Management</title>

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
            <form action="{{route('shop.search')}}" method="GET" ID="Searchbox">
            <button type="submit" ID="Searchbutton"></button>
            <input type="text" name="search"/>
            </form>

            <div class="container-fluid" ID="pink">
                <h3>ALL SHOPS</h3>
            </div>
            @include ('../Navigation_UI/FilterAdmin')
            <div class="container-fluid" ID="middle" align="center">
                <table ID="P_table">
            <tr>
                <th>SHOP NAME</th>
                <th>EMAIL</th>
                <th>PHONE NUMBER</th>
                <th>ADDRESS</th>
            </tr>

             @foreach($vdata as $record)
            <tr>
                <td>{{$record->shop_name}}</td>
                <td>{{$record->shop_email}}</td>
                <td>{{$record->shop_phonenumber}}</td>
                <td>{{$record->shop_address}}</td>
            </tr>
             @endforeach
        </table></div>
           @include ('../Navigation_UI/Footer')
    </div>
    </div>
</body>
</html>