<?php
session_start();

if (!isset($_SESSION['all_data'])) {
    header('Location: login.php');
    exit;
}

$all_data = $_SESSION['all_data'];

// اتصال به دیتابیس و دریافت درخواست‌ها
include '../config.php';
$requests = [];

// کوئری برای گرفتن اطلاعات درخواست‌ها به همراه اطلاعات تور
$stmt = $conn->prepare("
    SELECT 
        tr.*, 
        et.title AS tour_title, 
        et.country_fa AS country, 
        et.city_fa AS city, 
        et.date_fa AS tour_date
    FROM tour_requests tr
    LEFT JOIN exhibition_tours et ON tr.tour_id = et.id
    ORDER BY tr.request_date DESC
");

$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پنل کاربری - مدیریت درخواست‌ها</title>

    <?php include 'includes.php'; ?>
    <link rel="stylesheet" href="styles.css">
    <link type="text/css" rel="stylesheet" href="css/persianDatepicker.css" />
</head>

<body>
    <button class="sidebar-toggle d-md-none" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>

            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
                <nav class="navbar navbar-expand navbar-light bg-white shadow-sm rounded mb-4">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">مدیریت درخواست‌های تور</a>
                    </div>
                </nav>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">لیست درخواست‌ها</h5>
                        <div class="table-responsive">
                            <table class="request-table">
                                <thead>
                                    <tr>
                                        <th>شناسه</th>
                                        <th>نام متقاضی</th>
                                        <th>تلفن</th>
                                        <th>تور</th>
                                        <th>کشور</th>
                                        <th>شهر</th>
                                        <th>تاریخ تور</th>
                                        <th>تعداد مسافران</th>
                                        <th>تاریخ درخواست</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($requests as $request): ?>
                                    <tr data-bs-toggle="modal" data-bs-target="#requestModal"
                                        data-request-id="<?= $request['id'] ?>"
                                        onclick="loadRequestDetails(<?= $request['id'] ?>)">
                                        <td><?= htmlspecialchars($request['id']) ?></td>
                                        <td><?= htmlspecialchars($request['name']) ?></td>
                                        <td><?= htmlspecialchars($request['phone']) ?></td>
                                        <td><?= htmlspecialchars($request['tour_title'] ?? 'نامشخص') ?></td>
                                        <td><?= htmlspecialchars($request['country'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($request['city'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($request['tour_date'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($request['passengers']) ?></td>
                                        <td><?= htmlspecialchars($request['request_date']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal جزئیات درخواست -->
    <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="requestModalLabel">جزئیات درخواست</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="requestDetails">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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

    function loadRequestDetails(requestId) {
        fetch('get_request_details.php?id=' + requestId)
            .then(response => response.text())
            .then(data => {
                document.getElementById('requestDetails').innerHTML = data;
                window.currentRequestId = requestId;
            })
            .catch(error => {
                document.getElementById('requestDetails').innerHTML = `
                        <div class="alert alert-danger">
                            خطا در بارگذاری جزئیات درخواست: ${error}
                        </div>
                    `;
            });
    }

    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.remove('sidebar-mobile-show');
            removeOverlay();
        }
    });
    </script>
</body>

</html>