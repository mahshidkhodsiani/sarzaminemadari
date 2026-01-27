<?php
include "../config.php";

$message = "";
if (isset($_POST['submit'])) {
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

    // محاسبه مدت زمان
    $date1 = new DateTime($start_date_en);
    $date2 = new DateTime($end_date_en);
    $duration = $date1->diff($date2)->days;

    // ایجاد Slug
    $slug = str_replace(' ', '-', $title);

    // ۱. ثبت اولیه برای دریافت ID
    $sql = "INSERT INTO exhibition_tours (title, slug, description, country_fa, city_fa, country_en, city_en, category, price, start_date_en, end_date_en, start_date_fa, end_date_fa, duration) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssi", $title, $slug, $description, $country_fa, $city_fa, $country_en, $city_en, $category, $price, $start_date_en, $end_date_en, $start_date_fa, $end_date_fa, $duration);
    
    if ($stmt->execute()) {
        $tour_id = $conn->insert_id;
        
        // ۲. آپلود عکس در پوشه اختصاصی ID (مطابق فرمت شما)
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = "../uploads/e_tours/" . $tour_id . "/";
            if (!file_exists($upload_dir)) { mkdir($upload_dir, 0755, true); }

            $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $file_name = uniqid() . '.' . $file_ext;
            $target_file = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // ذخیره مسیر با ../ مطابق دیتابیس شما
                $db_path = "../uploads/e_tours/" . $tour_id . "/" . $file_name;
                $conn->query("UPDATE exhibition_tours SET tour_image = '$db_path' WHERE id = $tour_id");
            }
        }
        $message = "success";
    } else {
        $message = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>افزودن تور نمایشگاهی</title>
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
            <div class="col-md-3">
                <?php include 'sidebar.php'; ?>
            </div>
            <div class="col-md-9">
                <main class="">
                    <div class="card shadow">
                        <div class="card-header bg-info text-white">افزودن تور نمایشگاهی</div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">عنوان تور *</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">عکس اصلی (Label) *</label>
                                    <input class="form-control" type="file" name="image" accept="image/*" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">توضیحات کامل:</label>
                                    <textarea id="editor" name="description"></textarea>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-3"><label>تاریخ رفت (میلادی)</label><input type="date"
                                            class="form-control" id="start_date_en" name="start_date_en" required></div>
                                    <div class="col-md-3"><label>تاریخ رفت (شمسی)</label><input type="text"
                                            class="form-control" id="start_date_fa" name="start_date_fa" readonly></div>
                                    <div class="col-md-3"><label>تاریخ برگشت (میلادی)</label><input type="date"
                                            class="form-control" id="end_date_en" name="end_date_en" required></div>
                                    <div class="col-md-3"><label>تاریخ برگشت (شمسی)</label><input type="text"
                                            class="form-control" id="end_date_fa" name="end_date_fa" readonly></div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6"><label>کشور (فارسی)</label><input type="text"
                                            class="form-control" name="country_fa" required></div>
                                    <div class="col-md-6"><label>شهر (فارسی)</label><input type="text"
                                            class="form-control" name="city_fa" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"><label>Country (English)</label><input type="text"
                                            class="form-control" name="country_en" required></div>
                                    <div class="col-md-6"><label>City (English)</label><input type="text"
                                            class="form-control" name="city_en" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label>دسته‌بندی</label>
                                        <select class="form-control" name="category" required>
                                            <option value="صنایع غذایی">صنایع غذایی</option>
                                            <option value="پوشاک و مد">پوشاک و مد</option>
                                            <option value="تجهیزات پزشکی">تجهیزات پزشکی</option>
                                            <option value="الکترونیک">الکترونیک</option>
                                            <option value="چاپ و بسته بندی">چاپ و بسته بندی</option>
                                            <option value="سایر">سایر</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6"><label>شروع قیمت (فقط عدد)</label><input type="number"
                                            class="form-control" name="price" required></div>
                                </div>
                                <button name="submit" class="btn btn-info mt-4 mb-3 text-white">ذخیره تور جدید</button>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.js"></script>
    <script>
    $(document).ready(function() {
        function setupDate(en, fa) {
            $(`#${en}`).change(function() {
                if (this.value) {
                    const pdate = new persianDate(new Date(this.value));
                    $(`#${fa}`).val(pdate.format('YYYY/MM/DD'));
                }
            });
        }
        setupDate('start_date_en', 'start_date_fa');
        setupDate('end_date_en', 'end_date_fa');
        new Jodit('#editor', {
            height: 350,
            language: 'fa',
            direction: 'rtl'
        });
    });
    <?php if($message == "success"): ?>
    Swal.fire({
        icon: 'success',
        title: 'ثبت شد',
        text: 'تور با موفقیت ایجاد و عکس ذخیره شد',
        confirmButtonText: 'تایید'
    }).then(() => {
        window.location.href = 'exhibition_tours.php';
    });
    <?php elseif($message == "error"): ?>
    Swal.fire({
        icon: 'error',
        title: 'خطا',
        text: 'مشکلی در اتصال به دیتابیس وجود دارد'
    });
    <?php endif; ?>
    </script>
</body>

</html>