<?php
session_start();

if (!isset($_SESSION['all_data'])) {
    header('Location: login.php');
    exit;
}

$all_data = $_SESSION['all_data'];

// اتصال به دیتابیس برای دریافت آمار و آخرین درخواست‌ها
include '../config.php';

// ۱. دریافت تعداد کل درخواست‌ها
$res_req = $conn->query("SELECT COUNT(*) as total FROM tour_requests");
$count_requests = $res_req->fetch_assoc()['total'];

// ۲. دریافت تعداد کل تورها (معمولی + نمایشگاهی)
$res_tours = $conn->query("SELECT (SELECT COUNT(*) FROM tours) + (SELECT COUNT(*) FROM exhibition_tours) as total");
$count_tours = $res_tours->fetch_assoc()['total'];

// ۳. دریافت ۵ درخواست آخر برای نمایش در جدول
$last_requests = [];
$sql_last = "
    SELECT tr.*, COALESCE(t.title, et.title) AS tour_title
    FROM tour_requests tr
    LEFT JOIN tours t ON tr.tour_id = t.id
    LEFT JOIN exhibition_tours et ON tr.tour_id = et.id
    ORDER BY tr.request_date DESC LIMIT 5
";
$result_last = $conn->query($sql_last);
while($row = $result_last->fetch_assoc()){
    $last_requests[] = $row;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پنل مدیریت | داشبورد</title>

    <?php include 'includes.php'; ?>
    <link rel="stylesheet" href="styles.css">

    <style>
    .stat-card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s;
        color: white;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .bg-gradient-blue {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }

    .bg-gradient-green {
        background: linear-gradient(45deg, #1cc88a, #13855c);
    }

    .bg-gradient-orange {
        background: linear-gradient(45deg, #f6c23e, #dda20a);
    }

    .icon-shape {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .table-modern thead {
        background-color: #f8f9fc;
        color: #4e73df;
    }
    </style>
</head>

<body class="bg-light">
    <button class="sidebar-toggle d-md-none" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>

            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
                <nav class="navbar navbar-expand navbar-light bg-white shadow-sm rounded mb-4 mt-3">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1 fw-bold text-primary">
                            <i class="bi bi-speedometer2 me-2"></i> داشبورد مدیریت
                        </span>
                        <div class="d-flex align-items-center">
                            <span class="text-muted me-3">خوش آمدی،
                                <strong><?= htmlspecialchars($all_data['name'] ?? 'مدیر') ?></strong></span>
                        </div>
                    </div>
                </nav>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card stat-card bg-gradient-blue shadow">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-uppercase mb-1 opacity-75">کل درخواست‌ها</h6>
                                    <h2 class="mb-0 fw-bold"><?= $count_requests ?></h2>
                                </div>
                                <div class="icon-shape"><i class="bi bi-envelope-paper"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card bg-gradient-green shadow">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-uppercase mb-1 opacity-75">تورهای فعال</h6>
                                    <h2 class="mb-0 fw-bold"><?= $count_tours ?></h2>
                                </div>
                                <div class="icon-shape"><i class="bi bi-map"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card bg-gradient-orange shadow">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-uppercase mb-1 opacity-75">بازدید امروز</h6>
                                    <h2 class="mb-0 fw-bold">۴۸</h2>
                                </div>
                                <div class="icon-shape"><i class="bi bi-eye"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-header bg-white py-3 border-0">
                                <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-clock-history me-2 text-primary"></i>
                                    ۵ درخواست اخیر</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0 table-modern">
                                        <thead>
                                            <tr>
                                                <th class="ps-4">مشتری</th>
                                                <th>تور درخواستی</th>
                                                <th>تاریخ ثبت</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($last_requests as $req): ?>
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="fw-bold"><?= htmlspecialchars($req['name']) ?></div>
                                                    <small
                                                        class="text-muted"><?= htmlspecialchars($req['phone']) ?></small>
                                                </td>
                                                <td><span
                                                        class="badge bg-soft-primary text-primary border border-primary-subtle"><?= htmlspecialchars($req['tour_title']) ?></span>
                                                </td>
                                                <td class="text-muted" style="font-size: 0.85rem;">
                                                    <?= $req['request_date'] ?></td>
                                                <td class="text-center">
                                                    <a href="requests.php"
                                                        class="btn btn-sm btn-outline-primary rounded-pill">مشاهده</a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php if(empty($last_requests)) echo '<tr><td colspan="4" class="text-center py-4">درخواستی یافت نشد.</td></tr>'; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 text-center py-3">
                                <a href="requests.php" class="btn btn-link btn-sm text-decoration-none">مشاهده همه
                                    درخواست‌ها</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-header bg-white py-3 border-0">
                                <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-calendar3 me-2 text-primary"></i>
                                    تقویم امروز</h5>
                            </div>
                            <div class="card-body text-center">
                                <div id="span1" class="d-inline-block"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="js/persianDatepicker.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $("#span1").persianDatepicker({
            alwaysShow: true,
            cellWidth: 35,
            cellHeight: 30,
            fontSize: 14,
            theme: 'latoja' // یا تم دلخواه شما
        });
    });

    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('sidebar-mobile-show');
        if (sidebar.classList.contains('sidebar-mobile-show')) createOverlay();
        else removeOverlay();
    }

    function createOverlay() {
        const overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        overlay.onclick = toggleSidebar;
        document.body.appendChild(overlay);
    }

    function removeOverlay() {
        const overlay = document.querySelector('.sidebar-overlay');
        if (overlay) overlay.remove();
    }
    </script>
</body>

</html>