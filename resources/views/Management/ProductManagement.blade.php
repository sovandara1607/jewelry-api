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
    <div class="container-fluid" ID="BG">
            @include ('../Navigation_UI/SideBar')
        <div class="container-fluid" ID="right" align="right">
            @include ('../Navigation_UI/Header')
        <form action="{{route('product.search')}}" method="GET" ID="Searchbox">
            <button type="submit" ID="Searchbutton"></button>
            <input type="text" name="search"/>
        </form>

            <div class="container-fluid" ID="pink"><h3>ALL JEWELRIES</h3></div>
            
            <div class="container-fluid" ID="F_header">
                <h6 align="left">FILTER</h6>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown link
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/ProductManagement" role="button">All</a></li>
                        <li><a class="dropdown-item" href="/BraceletCategory">Bracelet</a></li>
                        <li><a class="dropdown-item" href="/BroochCategory">Brooch</a></li>
                        <li><a class="dropdown-item" href="/EarringCategory">Earrings</a></li>
                        <li><a class="dropdown-item" href="/NecklaceCategory">Necklace</a></li>
                        <li><a class="dropdown-item" href="/RingCategory">Rings</a></li>
                    </ul>
                </div>
            </div>
             
            <div class="container-fluid" ID="middle" align="center">        
            <table ID="P_table"> 
                    <tr>
                        <th>NAME</th>
                        <th>IMAGE</th>
                        <th>PRODUCT CATEGORY</th>
                        <th>SHOP NAME</th>
                        <th>PRICE</th>
                        <th>IN STOCK</th>
                    </tr>

                    @foreach($vdata as $record)  
                    <tr>
                    <td>{{$record->product_name}}</td>
                    <td><img src= "{{ asset($record->product_images)}}"height="100px"></td>
                    <td>{{$record->product_category}}</td>
                    <td>{{$record->shop_name}}</td>
                    <td>{{$record->product_price}}</td>
                    <td>{{$record->in_stock}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @include ('../Navigation_UI/Footer')
        </div>
    </div>
</body>
</html>