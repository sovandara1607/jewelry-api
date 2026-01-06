<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Management</title>

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
            <form action="{{route('user.search')}}" method="GET" ID="Searchbox">
            <button type="submit" ID="Searchbutton"></button>
            <input type="text" name="search"/>

            </form>
            <div class="container-fluid" ID="pink">
                <h3>ALL USERS</h3>
            </div>
            
<div class="container-fluid" ID="F_header">
    <h6 align="left">FILTER</h6>
    <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown link
  </a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="/UserManagement">All</a></li>
    <li><a class="dropdown-item" href="/A_alphabetUser">A</a></li>
    <li><a class="dropdown-item" href="/B_alphabetUser">B</a></li>
    <li><a class="dropdown-item" href="/C_alphabetUser">C</a></li>
    <li><a class="dropdown-item" href="/D_alphabetUser">D</a></li>
    <li><a class="dropdown-item" href="/E_alphabetUser">E</a></li>
    <li><a class="dropdown-item" href="/F_alphabetUser">F</a></li>
    <li><a class="dropdown-item" href="/G_alphabetUser">G</a></li>
  </ul>
</div>
</div>


            <div class="container-fluid" ID="middle" align="center">
                <table ID="P_table">
            <tr>
                <th>USER</th>
                <th>EMAIL</th>
                <th>PHONE NUMBER</th>
            </tr>

            @foreach($vdata as $record)
            <tr>
                <td>{{$record->name}}</td>
                <td>{{$record->email}}</td>
                <td>{{$record->phonenumber}}</td>
            </tr>
             @endforeach
        </table></div>
           @include ('../Navigation_UI/Footer')
    </div>
    </div>
</body>
</html>