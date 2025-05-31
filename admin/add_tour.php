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
                        افزودن تور مسافرتی
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
                                        <!-- صنایع اصلی -->
                                        <option value="پوشاک و مد">پوشاک و مد</option>
                                        <option value="آرایشی و بهداشتی">آرایشی و بهداشتی</option>
                                        <option value="تجهیزات پزشکی">تجهیزات پزشکی</option>
                                        <option value="الکترونیک و فناوری">الکترونیک و فناوری</option>

                                        <!-- نمایشگاه‌های تخصصی -->
                                        <option value="صنایع غذایی">صنایع غذایی</option>
                                        <option value="مبلمان و دکوراسیون">مبلمان و دکوراسیون</option>
                                        <option value="خودرو و قطعات">خودرو و قطعات</option>
                                        <option value="کشاورزی و صنایع وابسته">کشاورزی و صنایع وابسته</option>

                                        <!-- نمایشگاه‌های بین‌المللی -->
                                        <option value="نفت و گاز و پتروشیمی">نفت و گاز و پتروشیمی</option>
                                        <option value="انرژی های تجدیدپذیر">انرژی های تجدیدپذیر</option>
                                        <option value="گردشگری و هتلداری">گردشگری و هتلداری</option>

                                        <!-- سایر دسته‌ها -->
                                        <option value="کتاب و نشر">کتاب و نشر</option>
                                        <option value="هنرهای تجسمی">هنرهای تجسمی</option>
                                        <option value="صنایع دستی">صنایع دستی</option>
                                        <option value="ورزش و تجهیزات ورزشی">ورزش و تجهیزات ورزشی</option>
                                        <option value="سایر">سایر</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="type" class="form-label">نوع تور *</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="1">خارجی</option>
                                        <option value="2">داخلی</option>
                                    </select>
                                </div>
                            </div>

                            <!-- دسته و تاریخ شروع -->
                            <div class="row mt-3">
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
    $type = $_POST['type']; // اصلاح شده: = به جای -
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

    // ایجاد slug از عنوان
    $slug = str_replace(' ', '-', $title);
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    $slug = strtolower($slug);

    // ذخیره اطلاعات پایه تور در دیتابیس
    $sql = "INSERT INTO tours 
            (title, slug, description, date_en, date_fa, country_fa, city_fa, 
             country_en, city_en, category, price, type, tour_image) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; // 13 پارامتر

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("خطا در آماده‌سازی query: " . $conn->error);
    }

    // مقدار اولیه برای tour_image (موقت خالی)
    $temp_tour_image = "";

    $stmt->bind_param(
        "sssssssssssss", // 13 کاراکتر s
        $title,
        $slug,
        $description,
        $date_en,
        $date_fa,
        $country_fa,
        $city_fa,
        $country_en,
        $city_en,
        $category,
        $price,
        $type,
        $temp_tour_image
    );

    if ($stmt->execute()) {
        $tour_id = $conn->insert_id;

        // حالا مسیر نهایی را ایجاد کنید
        $final_upload_dir = "../uploads/tour/" . $tour_id . "/";
        if (!file_exists($final_upload_dir)) {
            mkdir($final_upload_dir, 0755, true);
        }

        // انتقال تصویر به مسیر نهایی
        $file_extension = pathinfo($temp_image_path, PATHINFO_EXTENSION);
        $final_file_name = 'main.' . $file_extension;
        $final_image_path = $final_upload_dir . $final_file_name;

        if (rename($temp_image_path, $final_image_path)) {
            // آپدیت مسیر تصویر در دیتابیس
            $update_sql = "UPDATE tours SET tour_image = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $final_image_path, $tour_id);
            $update_stmt->execute();
            $update_stmt->close();

            echo "<div id='successToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' data-delay='3000' style='position: fixed; top: 20px; right: 20px; width: 300px; z-index: 1055;'>
            <div class='toast-header bg-success text-white'>
                <strong class='mr-auto'>Success</strong>
            </div>
            <div class='toast-body'>
              با موفقیت انجام شد!
            </div>
            </div>
            <script>
                $(document).ready(function(){
                    $('#successToast').toast({
                        autohide: true,
                        delay: 3000
                    }).toast('show');
                    setTimeout(function(){
                        window.location.href = 'add_tour';
                    }, 3000);
                });
            </script>";
        }
    } else {
        // اگر INSERT ناموفق بود، تصویر موقت را پاک کنید
        if (file_exists($temp_image_path)) {
            unlink($temp_image_path);
        }

        echo "<div id='errorToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' data-delay='3000' style='position: fixed; top: 20px; right: 20px; width: 300px; z-index: 1055;'>
        <div class='toast-header bg-danger text-white'>
            <strong class='mr-auto'>Error</strong>
        </div>
        <div class='toast-body'>
            خطایی رخ داده، دوباره امتحان کنید!<br>Error: " . htmlspecialchars($stmt->error) . "
        </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#errorToast').toast({
                    autohide: true,
                    delay: 3000
                }).toast('show');
                setTimeout(function(){
                    window.location.href = 'add_tour';
                }, 3000);
            });
        </script>";
    }



    $stmt->close();
}

$conn->close();
?>