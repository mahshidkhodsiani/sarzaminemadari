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
$stmt = $conn->prepare("SELECT tr.*, et.title as tour_title 
                       FROM tour_requests tr
                       LEFT JOIN exhibition_tours et ON tr.tour_id = et.id
                       ORDER BY tr.request_date DESC");
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

    <style>
        .request-table {
            width: 100%;
            border-collapse: collapse;
        }

        .request-table th,
        .request-table td {
            padding: 12px;
            text-align: right;
            border-bottom: 1px solid #dee2e6;
        }

        .request-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .request-table tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .status-pending {
            color: #ffc107;
        }

        .status-confirmed {
            color: #28a745;
        }

        .status-rejected {
            color: #dc3545;
        }

        .modal-lg-custom {
            max-width: 800px;
        }
    </style>
</head>

<body>
    <!-- دکمه همبرگر برای موبایل -->
    <button class="sidebar-toggle d-md-none" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>

            <!-- Main content -->
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
                                        <th>تعداد مسافران</th>
                                        <th>تاریخ درخواست</th>
                                        <th>وضعیت</th>
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
                                            <td><?= htmlspecialchars($request['passengers']) ?></td>
                                            <td><?= htmlspecialchars($request['request_date']) ?></td>
                                            <td class="status-<?= htmlspecialchars($request['status']) ?>">
                                                <?php
                                                switch ($request['status']) {
                                                    case 'pending':
                                                        echo 'در انتظار';
                                                        break;
                                                    case 'confirmed':
                                                        echo 'تایید شده';
                                                        break;
                                                    case 'rejected':
                                                        echo 'رد شده';
                                                        break;
                                                    default:
                                                        echo 'نامشخص';
                                                }
                                                ?>
                                            </td>
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

    <!-- Modal برای نمایش جزئیات درخواست -->
    <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="requestModalLabel">جزئیات درخواست</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="requestDetails">
                    <!-- محتوای جزئیات درخواست اینجا بارگذاری می‌شود -->
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="updateRequestStatus('confirmed')">
                        <i class="bi bi-check-circle"></i> تایید درخواست
                    </button>
                    <button type="button" class="btn btn-danger" onclick="updateRequestStatus('rejected')">
                        <i class="bi bi-x-circle"></i> رد درخواست
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // توابع مدیریت سایدبار
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('sidebar-mobile-show');

            if (sidebar.classList.contains('sidebar-mobile-show')) {
                createOverlay();
            } else {
                removeOverlay();
            }
        }

        function createOverlay() {
            const overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            overlay.onclick = function() {
                toggleSidebar();
            };
            document.body.appendChild(overlay);
        }

        function removeOverlay() {
            const overlay = document.querySelector('.sidebar-overlay');
            if (overlay) {
                overlay.remove();
            }
        }

        // بارگذاری جزئیات درخواست
        function loadRequestDetails(requestId) {
            fetch('get_request_details.php?id=' + requestId)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('requestDetails').innerHTML = data;
                    // ذخیره شناسه درخواست فعلی در یک متغیر جهانی
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

        // به‌روزرسانی وضعیت درخواست
        function updateRequestStatus(newStatus) {
            if (!window.currentRequestId) return;

            fetch('update_request_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${window.currentRequestId}&status=${newStatus}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // نمایش پیام موفقیت
                        const toastHTML = `
                        <div class="toast align-items-center text-white bg-success border-0 show" 
                             style="position: fixed; top: 20px; right: 20px; z-index: 1060;">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    وضعیت درخواست با موفقیت به‌روزرسانی شد.
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" 
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    `;

                        const toastContainer = document.createElement('div');
                        toastContainer.innerHTML = toastHTML;
                        document.body.appendChild(toastContainer);

                        // بستن مدال پس از 2 ثانیه
                        setTimeout(() => {
                            const modal = bootstrap.Modal.getInstance(document.getElementById('requestModal'));
                            modal.hide();
                            // رفرش صفحه برای نمایش تغییرات
                            window.location.reload();
                        }, 2000);
                    } else {
                        alert('خطا در به‌روزرسانی وضعیت: ' + data.error);
                    }
                })
                .catch(error => {
                    alert('خطا در ارتباط با سرور: ' + error);
                });
        }

        // بستن سایدبار هنگام تغییر سایز صفحه
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const sidebar = document.querySelector('.sidebar');
                sidebar.classList.remove('sidebar-mobile-show');
                removeOverlay();
            }
        });
    </script>
</body>

</html>