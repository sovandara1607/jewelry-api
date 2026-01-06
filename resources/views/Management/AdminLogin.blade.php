<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>

    <meta charset="UTF-8">

    <link href="../bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Design.css">
    <script src="../bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container" id="mainbox" align="center">
        <form action="{{route('adminlogin')}}" method="post">
        <h3 id="handmade">HANDMADE</h3>
        <h5>ADMINISTRATION</h5>
        <div>
            <p>USERNAME *</p>
            <input type="text" name="admin_username" value="" required/>
        </div>
        <div>
            <p>EMAIL *</p>
            <input type="text" name="admin_email" value="" required/>
        </div>
        <div>
            <p>PASSWORD *</p>
            <input type="text" name="admin_password" value="" required/>
        </div>
        <button type="submit" id="LoginButton" name="LoginButton" value="Login">LOGIN</button>
</form>
    </div>
</body>
