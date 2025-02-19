<?php require_once 'php_action/core.php'; ?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

  <title>سیستم مدیریت موجودی</title>

  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/css/fileinput.min.css">

  <!-- fullCalendar 2.2.5-->
  <!-- <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.print.css" media="print"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- jquery ui -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      direction: rtl;
    }

    .navbar-brand img {
      width: 50px;
      /* Adjust the size as needed */
      height: auto;
    }
  </style>

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#" style="padding:0px;">
        <img src="logo.png" alt="">
      </a>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li id="navDashboard" class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> میز کار</a></li>
          <li class="nav-item dropdown" id="navOrder">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-shopping-cart"></i> سفارشات </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li id="topNavAddOrder"><a class="dropdown-item" href="orders.php?o=add"> <i class="fas fa-plus"></i> افزودن سفارش</a></li>
              <li id="topNavManageOrder"><a class="dropdown-item" href="orders.php?o=manord"> <i class="fas fa-edit"></i> مدیریت سفارشات</a></li>
            </ul>
          </li>
          <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] == 1) { ?>
            <li id="navBrand" class="nav-item"><a class="nav-link" href="brand.php"><i class="fas fa-tags"></i> برند</a></li>
            <li id="navCategories" class="nav-item"><a class="nav-link" href="categories.php"> <i class="fas fa-th-list"></i> دسته‌بندی</a></li>
            <li id="navProduct" class="nav-item"><a class="nav-link" href="product.php"> <i class="fas fa-box"></i> محصول </a></li>
          <?php } ?>
          <li class="nav-item dropdown" id="navSetting">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-user"></i> </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] == 1) { ?>
                <li id="topNavSetting"><a class="dropdown-item" href="setting.php"> <i class="fas fa-wrench"></i> تنظیمات</a></li>
                <li id="topNavUser"><a class="dropdown-item" href="user.php"> <i class="fas fa-user-plus"></i> افزودن کاربر</a></li>
              <?php } ?>
              <li id="topNavLogout"><a class="dropdown-item" href="logout.php"> <i class="fas fa-sign-out-alt"></i> خروج</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container"></div>