<?php
    session_start();
    include 'includes/config.php';
?>

<?php 
    $db = new Database();
    $errorMsgLogin = '';
    if(isset($_POST['loginSubmit'])){
        if ( empty($_POST['username']) or empty($_POST['password'])) 
        { 
            // echo'</br> <p style="color: white; font-size: 19px; font-weight: bold;"> Tài khoản hoặc mật khẩu không chính xác ! </p>';
            ?>
                <script>
                    document.querySelector('.errorMsg').innerHTML = "Tài khoản hoặc mật khẩu không chính xác";
                </script>
            <?php
        }
        else
        {
            $username= $_POST['username'];
            $password= $_POST['password'];
            $query="SELECT * FROM users WHERE username = '$username' and password = '$password'";
            $result = $db->getConnection()->query($query);
            $num = $result->rowCount();
            if ($num == 0)
            {
                echo'</br> <p style="color: white; font-size: 19px; font-weight: bold;"> Tài khoản hoặc mật khẩu không chính xác ! </p>';
            } else {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    if ($row['username'] == $username && $row['password'] == $password){
                        $_SESSION['id']= $row['id'];
                        header('location: https://hongminhdev-pizza-app.herokuapp.com/admin/home.php');
                    }
                }
            }
        }
    }
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng nhập quản trị</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <h4 class="text-center text-light">Admin login</h4>
                    </a>
                </div>
                <div class="login-form">
                    <form method="post" action="" name="login-frm">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="errorMsg text-danger font-weight-light font-italic"></div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>
                        </div>
                        <button type="submit" name="loginSubmit" class="btn btn-primary btn-flat m-b-30 m-t-30" id="btnLogin">Sign in</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
