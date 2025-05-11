<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پنل کاربری - افزودن تور نمایشگاهی</title>

    <?php include 'includes.php'; ?>
    <link rel="stylesheet" href="styles.css">



    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/o82a0iw3kwwxrgojc165lj0p1iv7gj6iqr7lebwcks7yfr71/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


    <!-- در بخش head -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        افزودن تور نمایشگاهی
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="" method="POST">
                            <!-- عنوان تور -->
                            <div class="mb-3">
                                <label for="tour_title" class="form-label">عنوان تور *</label>
                                <input type="text" class="form-control" id="title" name="title" required placeholder="مثلاً نمایشگاه کتاب تهران">
                            </div>


                            <!-- عکس لیبل -->
                            <div class="mb-3">
                                <label for="tour_image" class="form-label">عکس لیبل *</label>
                                <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
                                <small class="text-muted">فرمت‌های مجاز: JPG, PNG, GIF - حداکثر حجم: 2MB</small>
                            </div>

                            <!-- توضیحات -->
                            <div class="mb-4">
                                <label for="tour_description" class="form-label">توضیحات و خدمات تور *</label>
                                <!-- <textarea class="form-control" id="tour_description" name="tour_description" rows="4" required placeholder="توضیحاتی درباره تور بنویسید..."></textarea> -->
                                <textarea name="description">
                                توضیحاتی درباره تور بنویسید
                                </textarea>
                            </div>



                            <!-- تاریخ‌ها -->
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="gregorian_date" class="form-label">تاریخ میلادی *</label>
                                    <input type="date" class="form-control" id="date_en" name="date_en" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="persian_date" class="form-label">تاریخ شمسی *</label>
                                    <input type="text" class="form-control" id="date_fa" name="date_fa" required placeholder="1402/01/01">
                                </div>
                            </div>

                            <!-- محل برگزاری فارسی -->
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="country_fa" class="form-label">کشور (فارسی) *</label>
                                    <input type="text" class="form-control" id="country_fa" name="country_fa" required placeholder="مثلاً ایران">
                                </div>
                                <div class="col-md-6">
                                    <label for="city_fa" class="form-label">شهر (فارسی) *</label>
                                    <input type="text" class="form-control" id="city_fa" name="city_fa" required placeholder="مثلاً تهران">
                                </div>
                            </div>

                            <!-- محل برگزاری انگلیسی -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="venue_country_en" class="form-label">Country (English) *</label>
                                    <input type="text" class="form-control" id="country_en" name="country_en" required placeholder="e.g. Iran">
                                </div>
                                <div class="col-md-6">
                                    <label for="venue_city_en" class="form-label">City (English) *</label>
                                    <input type="text" class="form-control" id="city_en" name="city_en" required placeholder="e.g. Tehran">
                                </div>
                            </div>




                            <!-- دسته و تاریخ شروع -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="category" class="form-label">دسته‌بندی *</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="">-- انتخاب کنید --</option>
                                        <option value="پوشاک">پوشاک</option>
                                        <option value="تجهیزات پزشکی">تجهیزات پزشکی</option>
                                        <option value="الکترونیک">الکترونیک</option>
                                        <option value="سایر">سایر</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">شروع نرخ تور از *</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                            </div>

                            <button name="submit" class="btn btn-info mt-3 mb-3">ذخیره تور</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            // تقویم شمسی
            $("#date_fa").pDatepicker({
                format: 'YYYY/MM/DD',
                autoClose: true,
                initialValue: false,
                observer: true
            });

            // ارتباط بین تاریخ میلادی و شمسی
            $("#date_en").change(function() {
                const gregorianDate = new Date(this.value);
                const persianDate = new persianDate(gregorianDate);
                $("#date_fa").val(persianDate.format('YYYY/MM/DD'));
            });

            $("#date_fa").change(function() {
                try {
                    const persianDateArray = this.value.split('/');
                    const persianDate = new persianDate({
                        year: parseInt(persianDateArray[0]),
                        month: parseInt(persianDateArray[1]),
                        day: parseInt(persianDateArray[2])
                    });
                    const gregorianDate = persianDate.toCalendar('gregorian');
                    const formattedDate = gregorianDate.format('YYYY-MM-DD');
                    $("#date_en").val(formattedDate);
                } catch (e) {
                    console.error("خطا در تبدیل تاریخ:", e);
                }
            });
        });
    </script>

</body>

</html>




<?php
include "../config.php";

if (isset($_POST['submit'])) {
    // دریافت مقادیر از فرم
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_en = $_POST['date_en'];
    $date_fa = $_POST['date_fa'];
    $country_fa = $_POST['country_fa'];
    $city_fa = $_POST['city_fa'];
    $country_en = $_POST['country_en'];
    $city_en = $_POST['city_en'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $image_path = "";

    // اعتبارسنجی اولیه
    if (empty($title) || empty($description) || empty($date_en) || empty($date_fa)) {
        die("لطفا تمام فیلدهای الزامی را پر کنید");
    }

    // پردازش موقت تصویر
    $temp_image_path = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $upload_dir = "../uploads/temp/";

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $temp_file_name = uniqid() . '.' . $file_extension;
        $temp_image_path = $upload_dir . $temp_file_name;

        if (!move_uploaded_file($image['tmp_name'], $temp_image_path)) {
            die("خطا در آپلود موقت تصویر");
        }
    } else {
        die("لطفا یک تصویر انتخاب کنید");
    }

    // ذخیره اطلاعات پایه تور در دیتابیس
    $sql = "INSERT INTO exhibition_tours 
            (title, description, date_en, date_fa, country_fa, city_fa, 
             country_en, city_en, category, price) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssi",
        $title,
        $description,
        $date_en,
        $date_fa,
        $country_fa,
        $city_fa,
        $country_en,
        $city_en,
        $category,
        $price
    );

    if ($stmt->execute()) {
        $tour_id = $conn->insert_id;

        // حالا مسیر نهایی را ایجاد کنید
        $final_upload_dir = "../uploads/tours/" . $tour_id . "/";
        if (!file_exists($final_upload_dir)) {
            mkdir($final_upload_dir, 0755, true);
        }

        // انتقال تصویر به مسیر نهایی
        $file_extension = pathinfo($temp_image_path, PATHINFO_EXTENSION);
        $final_file_name = uniqid() . '.' . $file_extension;
        $final_image_path = $final_upload_dir . $final_file_name;

        if (rename($temp_image_path, $final_image_path)) {
            // آپدیت مسیر تصویر در دیتابیس
            $update_sql = "UPDATE exhibition_tours SET tour_image = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $final_image_path, $tour_id);
            $update_stmt->execute();
            $update_stmt->close();

            echo "تور با موفقیت ذخیره شد! تصویر در مسیر: " . $final_image_path;
        } else {
            // اگر انتقال تصویر ناموفق بود، حداقل اطلاعات تور ذخیره شده است
            echo "تور ذخیره شد ولی خطا در انتقال تصویر به مسیر نهایی";
        }
    } else {
        // اگر INSERT ناموفق بود، تصویر موقت را پاک کنید
        if (file_exists($temp_image_path)) {
            unlink($temp_image_path);
        }
        die("خطا در ذخیره اطلاعات: " . $conn->error);
    }

    $stmt->close();
}

$conn->close();
?>