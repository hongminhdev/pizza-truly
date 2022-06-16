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
    <title>Pizza Truly</title>

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
                    <a href="#" class="nav-link">Danh sách đơn hàng</a>
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
                                    <a href="https://hongminhdev-pizza-app.herokuapp.com/admin/drinks.php" class="nav-link">
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
                                    <a href="https://hongminhdev-pizza-app.herokuapp.com/admin/orders.php" class="nav-link active">
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
                            <h1 class="m-0">Danh sách đơn hàng</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Orders list</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped table-hover" id="orders-tbl">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="display: none;">ID</th>
                                <th>Mã đơn hàng</th>
                                <th>Loại pizza</th>
                                <th>Combo pizza</th>
                                <th>Thành tiền</th>
                                <th>Giảm giá</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Trạng thái</th>
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

        <!-- Modal detail -->
        <div>
            <div id="infor-order-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="h5-modal-title">Chi tiết đơn hàng</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="frm-infor-order">

                        <!-- vùng hiển thị thông tin đơn hàng(order) -->
                        <div id="div-container-order" class="container bg-secondary p-2 jumbotron">
                            <div class="container rounded bg-white">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row mt-3 mx-4">
                                            <div class="col-12">
                                                <label class="order-form-label"> Mã đơn hàng </label>
                                            </div>
                                            <div class="col-12 col-sm-12 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="order_code" id="inp-order-code">
                                            </div>
                                        </div>

                                        <div class="row mt-3 mx-4">
                                            <div class="col-6">
                                                <label class="order-form-label">Cỡ combo</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="order-form-label">Đường kính pizza</label>
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="size" id="inp-size">
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="diameter" id="inp-diameter">
                                            </div>
                                        </div>

                                        <div class="row mt-3 mx-4">
                                            <div class="col-6">
                                                <label class="order-form-label">Sườn nướng</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="order-form-label">Số lượng nước uống</label>
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="grilled_ribs" id="inp-grilled-ribs">
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="quantity" id="inp-quantity">
                                            </div>
                                        </div>
                                        
                                        <div class="row mt-3 mx-4">
                                            <div class="col-6">
                                                <label class="order-form-label">Salad</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="order-form-label">Đồ uống</label>
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="salad" id="inp-salad">
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="drink_id" id="inp-drink">
                                            </div>
                                        </div>

                                        <div class="row mt-3 mx-4">
                                            <div class="col-6">
                                                <label class="order-form-label">Mã voucher</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="order-form-label">Loại pizza</label>
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="voucher_id" id="inp-voucher">
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="type_pizza" id="inp-type-pizza">
                                            </div>
                                        </div>

                                        <div class="row mt-3 mx-4">
                                            <div class="col-6">
                                                <label class="order-form-label">Thành tiền</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="order-form-label">Giảm giá</label>
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="price" id="inp-price">
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="discount" id="inp-discount">
                                            </div>
                                        </div>

                                        <div class="row mt-3 mx-4">
                                            <div class="col-6">
                                                <label class="order-form-label">Họ và tên</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="order-form-label">Địa chỉ</label>
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="fullname" id="inp-fullname">
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="address" id="inp-address">
                                            </div>
                                        </div>
                    
                                        <div class="row mt-3 mx-4">
                                            <div class="col-6">
                                                <label class="order-form-label">Số điện thoại</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="order-form-label">Email</label>
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="phone" id="inp-phone">
                                            </div>
                                            
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="email" id="inp-email">
                                            </div>
                                        </div>
                
                                        <div class="row mt-3 mx-4">
                                            <div class="col-6">
                                                <label class="order-form-label">Lời nhắn</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="order-form-label">Trạng thái</label>
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="message" id="inp-message">
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="status" id="inp-status">
                                            </div>
                                        </div>

                                        <div class="row mt-3 mb-3 mx-4">
                                            <div class="col-6">
                                                <label class="order-form-label">Ngày tạo đơn hàng</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="order-form-label">Ngày cập nhật</label>
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="create_at" id="inp-create-order">
                                            </div>
                                            <div class="col-6 col-sm-6 mt-2 pr-sm-2">
                                                <input class="order-form-input" name="update_at" id="inp-update-order">
                                            </div>
                                        </div>
                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- vùng hiển thị thông tin đơn hàng(order) -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-confirm-order">Confirm</button>
                    <button class="btn btn-secondary" id="btn-cancel-order">Cancel</button>
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
    <script src="js/order.js"></script>

    <script>
        $(async function() {
            const orders = await getAllOrders();
            renderOrder(orders);
        });
    </script>
</body>

</html>


<?php
    } else {
        header('location: https://hongminhdev-pizza-app.herokuapp.com/admin/index.php');
    }
?>