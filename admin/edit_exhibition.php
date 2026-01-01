<?php
include "../config.php";

// دریافت آی‌دی تور
if (!isset($_GET['id'])) {
    header("Location: exhibition_tours.php");
    exit();
}

$id = (int)$_GET['id'];
$query = $conn->query("SELECT * FROM exhibition_tours WHERE id = $id");
$tour = $query->fetch_assoc();

if (!$tour) {
    die("تور مورد نظر یافت نشد.");
}

$message = "";
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $country_fa = $_POST['country_fa'];
    $city_fa = $_POST['city_fa'];
    $country_en = $_POST['country_en'];
    $city_en = $_POST['city_en'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $start_date_en = $_POST['start_date_en'];
    $end_date_en = $_POST['end_date_en'];
    $start_date_fa = $_POST['start_date_fa'];
    $end_date_fa = $_POST['end_date_fa'];

    // محاسبه مجدد مدت زمان (Duration)
    $date1 = new DateTime($start_date_en);
    $date2 = new DateTime($end_date_en);
    $duration = $date1->diff($date2)->days;

    // ایجاد Slug جدید بر اساس عنوان جدید
    $slug = str_replace(' ', '-', $title);

    // ۱. آپدیت تصویر در صورت انتخاب فایل جدید
    if ($_FILES['image']['name']) {
        $u_dir = "../uploads/e_tours/" . $id . "/";
        if (!file_exists($u_dir)) mkdir($u_dir, 0755, true);
        
        $f_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $f_name = uniqid() . '.' . $f_ext;
        $target_file = $u_dir . $f_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // حذف عکس قدیمی از هاست برای جلوگیری از پر شدن فضا
            if (file_exists($tour['tour_image'])) {
                unlink($tour['tour_image']);
            }
            $db_path = "../uploads/e_tours/" . $id . "/" . $f_name;
            $conn->query("UPDATE exhibition_tours SET tour_image = '$db_path' WHERE id = $id");
        }
    }

    // ۲. آپدیت تمامی فیلدها در دیتابیس
    $sql = "UPDATE exhibition_tours SET 
            title=?, slug=?, description=?, country_fa=?, city_fa=?, 
            country_en=?, city_en=?, category=?, price=?, 
            start_date_en=?, end_date_en=?, start_date_fa=?, end_date_fa=?, 
            duration=? 
            WHERE id=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssii", 
        $title, $slug, $description, $country_fa, $city_fa, 
        $country_en, $city_en, $category, $price, 
        $start_date_en, $end_date_en, $start_date_fa, $end_date_fa, 
        $duration, $id
    );
    
    if ($stmt->execute()) {
        $message = "success";
        // بروزرسانی متغیر تور برای نمایش اطلاعات جدید در فرم
        $tour = $conn->query("SELECT * FROM exhibition_tours WHERE id = $id")->fetch_assoc();
    } else {
        $message = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>ویرایش کامل تور | <?= htmlspecialchars($tour['title']) ?></title>
    <?php include 'includes.php'; ?>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div class="card shadow mb-5">
                    <div class="card-header bg-warning text-dark fw-bold">
                        <i class="fas fa-edit me-2"></i> ویرایش تمامی اطلاعات تور
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="POST">
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-bold">عنوان تور *</label>
                                    <input type="text" class="form-control" name="title"
                                        value="<?= htmlspecialchars($tour['title']) ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">دسته‌بندی</label>
                                    <select class="form-control" name="category">
                                        <?php 
                                        $cats = ["صنایع غذایی", "پوشاک و مد", "تجهیزات پزشکی", "الکترونیک", "چاپ و بسته بندی", "سایر"];
                                        foreach($cats as $cat) {
                                            $selected = ($tour['category'] == $cat) ? "selected" : "";
                                            echo "<option value='$cat' $selected>$cat</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">تصویر تور</label><br>
                                <img src="<?= $tour['tour_image'] ?>" width="150" class="img-thumbnail mb-2 shadow-sm">
                                <input type="file" class="form-control" name="image" accept="image/*">
                                <small class="text-muted">اگر نمی‌خواهید عکس تغییر کند، این بخش را خالی بگذارید.</small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">توضیحات کامل تور</label>
                                <textarea id="editor" name="description"><?= $tour['description'] ?></textarea>
                            </div>

                            <div class="row bg-light p-3 rounded mb-4 border">
                                <div class="col-md-3">
                                    <label class="small fw-bold">تاریخ رفت (میلادی)</label>
                                    <input type="date" class="form-control" id="start_date_en" name="start_date_en"
                                        value="<?= $tour['start_date_en'] ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="small fw-bold">تاریخ رفت (شمسی)</label>
                                    <input type="text" class="form-control" id="start_date_fa" name="start_date_fa"
                                        value="<?= $tour['start_date_fa'] ?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label class="small fw-bold">تاریخ برگشت (میلادی)</label>
                                    <input type="date" class="form-control" id="end_date_en" name="end_date_en"
                                        value="<?= $tour['end_date_en'] ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="small fw-bold">تاریخ برگشت (شمسی)</label>
                                    <input type="text" class="form-control" id="end_date_fa" name="end_date_fa"
                                        value="<?= $tour['end_date_fa'] ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">کشور (فارسی)</label>
                                    <input type="text" class="form-control" name="country_fa"
                                        value="<?= htmlspecialchars($tour['country_fa']) ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">شهر (فارسی)</label>
                                    <input type="text" class="form-control" name="city_fa"
                                        value="<?= htmlspecialchars($tour['city_fa']) ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">Country (EN)</label>
                                    <input type="text" class="form-control" name="country_en"
                                        value="<?= htmlspecialchars($tour['country_en']) ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">City (EN)</label>
                                    <input type="text" class="form-control" name="city_en"
                                        value="<?= htmlspecialchars($tour['city_en']) ?>" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">شروع قیمت (تومان)</label>
                                    <input type="number" class="form-control" name="price" value="<?= $tour['price'] ?>"
                                        required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">مدت تور (محاسبه خودکار)</label>
                                    <input type="text" class="form-control bg-light"
                                        value="<?= $tour['duration'] ?> روز" readonly>
                                </div>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-between">
                                <button name="update" class="btn btn-warning px-5 fw-bold text-dark">بروزرسانی نهایی
                                    تور</button>
                                <a href="exhibition_tours.php" class="btn btn-outline-secondary px-4">بازگشت به لیست</a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.js"></script>

    <script>
    $(document).ready(function() {
        // تنظیم خودکار تاریخ شمسی هنگام تغییر تاریخ میلادی
        function setupDateSync(enId, faId) {
            $(`#${enId}`).on('change', function() {
                if (this.value) {
                    const pdate = new persianDate(new Date(this.value));
                    $(`#${faId}`).val(pdate.format('YYYY/MM/DD'));
                }
            });
        }
        setupDateSync('start_date_en', 'start_date_fa');
        setupDateSync('end_date_en', 'end_date_fa');

        // فعال‌سازی ادیتور Jodit
        new Jodit('#editor', {
            height: 400,
            language: 'fa',
            direction: 'rtl',
            placeholder: 'توضیحات را اینجا بنویسید...'
        });
    });



    <?php if($message == "success"): ?>
    Swal.fire({
        icon: 'success',
        title: 'بروزرسانی موفقیت‌آمیز',
        text: 'تمامی تغییرات با موفقیت ذخیره شدند.',
        confirmButtonText: 'عالیه'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'exhibition_tours.php';
        }
    });
    <?php elseif($message == "error"): ?>
    Swal.fire({
        icon: 'error',
        title: 'خطا در ثبت',
        text: 'مشکلی در هنگام ذخیره اطلاعات رخ داد.'
    });
    <?php endif; ?>
    </script>
</body>

</html>