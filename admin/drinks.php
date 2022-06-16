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
    <title>Danh sách đồ uống</title>

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
                    <a href="#" class="nav-link">Danh sách đồ uống</a>
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
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    UI Elements
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="https://hongminhdev-pizza-app.herokuapp.com/admin/drinks.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quản lý đồ uống</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://hongminhdev-pizza-app.herokuapp.com/admin/vouchers.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quản lý vouchers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://hongminhdev-pizza-app.herokuapp.com/admin/orders.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quản lý đơn hàng</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="index.html" class="nav-link active">
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
                            <h1 class="m-0">Danh sách đồ uống</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Drink list</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content"> <img src="" alt="">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped table-hover" id="drinks-tbl">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="display: none;">ID</th>
                                <th>Mã nước uống</th>
                                <th>Tên nước uống</th>
                                <th>Giá</th>
                                <th>Hình ảnh</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Modal insert -->
        <div>
            <div id="create-user-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="h5-modal-title">Create new user</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <form id="form-create-user">
                        <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="input-create-voucher-code">First name</label>
                        </div>
                        <div class="col-sm-8 validate">
                            <input type="text" id="input-create-first-name" name="firstname" placeholder="Firstname..." class="form-control">
                            <div class="invalid-feedback">
                            Vui lòng nhập firstname
                            </div>
                        </div>
                        </div>
                        <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="input-create-voucher-code">Last name</label>
                        </div>
                        <div class="col-sm-8 validate">
                            <input type="text" id="input-create-last-name" name="lastname" placeholder="Lastname..." class="form-control">
                            <div class="invalid-feedback">
                            Vui lòng nhập lastname
                            </div>
                        </div>
                        </div>
                        <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="input-create-discount">Subject</label>
                        </div>
                        <div class="col-sm-8 validate">
                            <input type="text" id="input-create-subject" name="subject" placeholder="Subject..." class="form-control">
                            <div class="invalid-feedback">
                            Vui lòng nhập subject
                            </div>
                        </div>
                        </div>
                        <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="input-create-discount">Country</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="country" id="input-create-country">

                            </select>
                        </div>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-secondary" id="btn-create-cancel" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="btn-create-user">Insert User</button>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal update -->
        <div>
            <div id="update-drink-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="h5-modal-title">Cập nhật dữ liệu</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <form id="frm-update-drink">
                        <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="input-create-voucher-code">Mã nước uống</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" id="update-drink-code" name="drink_code" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        </div>
                        <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="input-create-voucher-code">Tên nước uống</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" id="update-drink-name" name="drink_name" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        </div>
                        <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="input-create-discount">Giá bán</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="number" id="update-drink-price" name="drink_price" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        </div>
                        <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="input-create-discount">Ảnh</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="file" id="update-drink-image" name="drink_image" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-secondary" id="" data-dismiss="modal">Hủy bỏ</button>
                    <button class="btn btn-primary" id="btn-update-drink">Cập nhật</button>
                    </div>
                </div>
                </div>
            </div>
        </div>

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
    <script src="js/api.js"></script>
    <script src="js/drink.js"></script>

    <script>
        $(async function() {
            const drinks = await getAllDrinks();
            renderDrink(drinks);
        });

        $('#btn-update-drink').click( async () => {
            let drinkObj = getDataUpdateDrink();
            console.log(drinkObj)
            // await updateDrink(drinkObj);
            $('#update-drink-modal').modal("hide");
        })
    </script>
</body>

</html>


<?php
    } else {
        header('location: https://hongminhdev-pizza-app.herokuapp.com/admin/index.php');
    }
?>