<?php
session_start();
include '../config.php';

if (!isset($_GET['id'])) {
    die('شناسه درخواست نامعتبر است');
}

$requestId = intval($_GET['id']);

// دریافت اطلاعات درخواست از دیتابیس
$stmt = $conn->prepare("SELECT tr.*, et.title as tour_title 
                       FROM tour_requests tr
                       LEFT JOIN exhibition_tours et ON tr.tour_id = et.id
                       WHERE tr.id = ?");
$stmt->bind_param("i", $requestId);
$stmt->execute();
$result = $stmt->get_result();
$request = $result->fetch_assoc();

if (!$request) {
    die('درخواست مورد نظر یافت نشد');
}
?>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">نام متقاضی:</label>
            <p class="form-control-static"><?= htmlspecialchars($request['name']) ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">تلفن:</label>
            <p class="form-control-static"><?= htmlspecialchars($request['phone']) ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">ایمیل:</label>
            <p class="form-control-static"><?= htmlspecialchars($request['email'] ?? '--') ?></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">تور:</label>
            <p class="form-control-static"><?= htmlspecialchars($request['tour_title'] ?? 'نامشخص') ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">تعداد مسافران:</label>
            <p class="form-control-static"><?= htmlspecialchars($request['passengers']) ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">تاریخ درخواست:</label>
            <p class="form-control-static"><?= htmlspecialchars($request['request_date']) ?></p>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">توضیحات:</label>
    <p class="form-control-static"><?= htmlspecialchars($request['notes'] ?? 'بدون توضیحات') ?></p>
</div>