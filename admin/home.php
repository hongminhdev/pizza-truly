<?php
    session_start();
    include 'includes/config.php';
    if (isset($_SESSION['id'])) 
    {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách người dùng</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Danh sách người dùng</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Pizza Truly</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    UI Elements
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="https://hongminhdev-pizza-app.herokuapp.com/admin/drinks.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quản trị thức uống</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://hongminhdev-pizza-app.herokuapp.com/admin/vouchers.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quản trị vouchers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://hongminhdev-pizza-app.herokuapp.com/admin/orders.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quản trị đơn hàng</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="https://hongminhdev-pizza-app.herokuapp.com/admin/home.php" class="nav-link active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Danh sách người dùng
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="fas fa-sign-out-alt nav-icon"></i>
                                <p>Đăng xuất</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Danh sách người dùng</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User list</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped table-hover" id="table-users">
                        <thead>
                            <tr>
                                <th>Mã người dùng</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Age</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <!-- Modal user detail-->
                    <div>
                        <div class="modal fade" id="modal-user-detail" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">User detail information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="row form-group">
                                                <label class="col-form-label col-sm-4">User Id</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-user-id">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-form-label col-sm-4">First Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-firstname">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-form-label col-sm-4">Last Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-lastname">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-form-label col-sm-4">Age</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-age">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <footer class="main-footer">
            <strong>Copyright &copy; © 2022 Pizza Truly</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
</body>

</html>


<?php
    } else {
        header('location: https://hongminhdev-pizza-app.herokuapp.com/admin/index.php');
    }
?>