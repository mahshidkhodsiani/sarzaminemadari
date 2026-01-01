<?php 
include "../config.php"; 

// ۱. بخش پردازش حذف
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    $stmt = $conn->prepare("SELECT tour_image FROM exhibition_tours WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    
    if ($res) {
        $img = $res['tour_image'];
        if (file_exists($img)) unlink($img); 
        $folder = "../uploads/e_tours/" . $id;
        if (is_dir($folder)) @rmdir($folder); 
    }
    $conn->query("DELETE FROM exhibition_tours WHERE id = $id");
    header("Location: exhibition_tours.php?status=deleted");
    exit();
}

// ۲. تنظیمات صفحه‌بندی
$limit = 10; // تعداد نمایش در هر صفحه
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// گرفتن تعداد کل رکوردها برای محاسبه صفحات
$total_res = $conn->query("SELECT COUNT(id) AS id FROM exhibition_tours");
$total_count = $total_res->fetch_assoc()['id'];
$pages = ceil($total_count / $limit);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>مدیریت تورهای نمایشگاهی</title>
    <?php include 'includes.php'; ?>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">مدیریت تورها (تعداد کل: <?= $total_count ?>)</h5>
                        <a href="add_exhibition.php" class="btn btn-sm btn-light">افزودن تور جدید</a>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>تصویر</th>
                                    <th>عنوان تور</th>
                                    <th>تاریخ (شمسی)</th>
                                    <th>قیمت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // کوئری با LIMIT برای صفحه‌بندی
                                $query = $conn->query("SELECT * FROM exhibition_tours ORDER BY id DESC LIMIT $start, $limit");
                                if($query->num_rows > 0):
                                    while($row = $query->fetch_assoc()): ?>
                                <tr>
                                    <td><img src="<?= $row['tour_image'] ?>" width="70" class="rounded border"></td>
                                    <td class="small fw-bold"><?= $row['title'] ?></td>
                                    <td><?= $row['start_date_fa'] ?></td>
                                    <td><?= number_format($row['price']) ?></td>
                                    <td>
                                        <div class="btn-group" dir="ltr">
                                            <button onclick="confirmDelete(<?= $row['id'] ?>)"
                                                class="btn btn-sm btn-outline-danger">حذف</button>
                                            <a href="edit_exhibition.php?id=<?= $row['id'] ?>"
                                                class="btn btn-sm btn-outline-primary">ویرایش</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; 
                                else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4">هیچ توری یافت نشد.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <?php if ($pages > 1): ?>
                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center" dir="ltr">
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>">قبلی</a>
                                </li>

                                <?php for($i = 1; $i <= $pages; $i++): ?>
                                <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                                <?php endfor; ?>

                                <li class="page-item <?= ($page >= $pages) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>">بعدی</a>
                                </li>
                            </ul>
                        </nav>
                        <?php endif; ?>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'مطمئنی؟',
            text: "با حذف این تور، عکس آن هم از هاست پاک می‌شود!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'بله، حذف کن',
            cancelButtonText: 'لغو'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'exhibition_tours.php?delete_id=' + id;
            }
        })
    }

    <?php if(isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
    Swal.fire({
        icon: 'success',
        title: 'پاک شد!',
        timer: 1500,
        showConfirmButton: false
    });
    <?php endif; ?>
    </script>
</body>

</html>