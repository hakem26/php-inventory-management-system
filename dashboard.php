<?php require_once 'includes/header.php'; ?>

<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = 0;
while ($orderResult = $orderQuery->fetch_assoc()) {
    $totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$userwisesql = "SELECT users.username , SUM(orders.grand_total) as totalorder FROM orders INNER JOIN users ON orders.user_id = users.user_id WHERE orders.order_status = 1 GROUP BY orders.user_id";
$userwiseQuery = $connect->query($userwisesql);
$userwieseOrder = $userwiseQuery->num_rows;

$connect->close();

?>

<style type="text/css">
    .ui-datepicker-calendar {
        display: none;
    }
</style>

<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.css" media="print">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    <a href="product.php" class="text-white" style="text-decoration:none;">
                        <i class="fas fa-box"></i> تعداد کل محصولات
                        <span class="badge badge-light float-right"><?php echo $countProduct; ?></span>    
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">
                    <a href="product.php" class="text-white" style="text-decoration:none;">
                        <i class="fas fa-exclamation-triangle"></i> موجودی کم
                        <span class="badge badge-light float-right"><?php echo $countLowStock; ?></span>    
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">
                    <a href="orders.php?o=manord" class="text-white" style="text-decoration:none;">
                        <i class="fas fa-shopping-cart"></i> تعداد کل سفارشات
                        <span class="badge badge-light float-right"><?php echo $countOrder; ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header"> <i class="fas fa-users"></i> سفارشات به تفکیک کاربر</div>
                <div class="card-body">
                    <table class="table table-bordered" id="productTable">
                    <thead>
                        <tr>                      
                            <th style="width:30%;">نام</th>
                            <th style="width:30%;">سفارشات به تومان</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($orderResult = $userwiseQuery->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $orderResult['username']?></td>
                                <td><?php echo $orderResult['totalorder']?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>    
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="cardHeader">
                    <h1 id="jalali-day"></h1>
                </div>
                <div class="cardContainer">
                    <p id="jalali-date"></p>
                </div>
            </div> 
            <!-- <br/> -->
            <div class="card mb-3">
                <div class="cardHeader" style="background-color:#245580;">
                    <h1><?php if($totalRevenue) {
                        echo $totalRevenue;
                        } else {
                            echo '0';
                            } ?></h1>
                </div>
                <div class="cardContainer">
                    <p>کل درآمد به تومان</p>
                </div>
            </div> 
        </div>
    </div>
</div>

<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jalaali-js@1.2.7/dist/jalaali.min.js"></script>

<script type="text/javascript">
    $(function () {
        // top bar active
        $('#navDashboard').addClass('active');

        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();

        // Convert Gregorian date to Jalali date
        var jalaliDate = jalaali.toJalaali(y, m + 1, d);
        var jalaliDay = jalaliDate.jd;
        var jalaliMonth = jalaliDate.jm;
        var jalaliYear = jalaliDate.jy;

        // Map Jalali month number to month name
        var jalaliMonthNames = [
            "فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور",
            "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"
        ];
        var jalaliMonthName = jalaliMonthNames[jalaliMonth - 1];

        // Display Jalali date
        $('#jalali-day').text(jalaliDay);
        $('#jalali-date').text(jalaliDay + ' ' + jalaliMonthName + ', ' + jalaliYear);

        $('#calendar').fullCalendar({
            header: {
                left: '',
                center: 'title'
            },
            buttonText: {
                today: 'امروز',
                month: 'ماه'          
            }        
        });
    });
</script>

<?php require_once 'includes/footer.php'; ?>