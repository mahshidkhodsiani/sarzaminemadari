<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم درخواست تور - آژانس سرزمین مادری</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/png" href="img/logo.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;700&display=swap" rel="stylesheet">

    <?php
    include 'includes.php';
    include 'config.php';

    // دریافت اطلاعات تور از دیتابیس بر اساس tour_id
    $tour_id = isset($_GET['tour_id']) ? $_GET['tour_id'] : '';
    $tour_data = null;

    if ($tour_id) {
        // ۱. ابتدا جستجو در جدول تورهای معمولی
        $stmt = $conn->prepare("SELECT * FROM tours WHERE id = ?");
        $stmt->bind_param("i", $tour_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tour_data = $result->fetch_assoc();
        $stmt->close();

        // ۲. اگر در جدول معمولی نبود، جستجو در جدول تورهای نمایشگاهی
        if (!$tour_data) {
            $stmt = $conn->prepare("SELECT * FROM exhibition_tours WHERE id = ?");
            $stmt->bind_param("i", $tour_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $tour_data = $result->fetch_assoc();
            $stmt->close();
        }
    }

    // پردازش فرم پس از سابمیت
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $post_tour_id = $_POST['tour_id'] ?? '';
    $passengers = $_POST['passengers'] ?? 1;
    $notes = $_POST['notes'] ?? '';

    $errors = [];
    $success = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($name)) { $errors[] = 'نام و نام خانوادگی الزامی است.'; }
        if (empty($phone)) { $errors[] = 'شماره تلفن الزامی است.'; }
        if (empty($post_tour_id)) { $errors[] = 'شناسه تور معتبر نیست.'; }

        if (empty($errors)) {
            // ثبت درخواست در دیتابیس
            $stmt = $conn->prepare("INSERT INTO tour_requests 
                                   (name, phone, tour_id, passengers, notes, request_date) 
                                   VALUES (?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("sssis", $name, $phone, $post_tour_id, $passengers, $notes);

            if ($stmt->execute()) {
                $success = true;
                // خالی کردن فیلدها بعد از ثبت موفق
                $name = $phone = $notes = '';
                $passengers = 1;
            } else {
                $errors[] = 'خطا در دیتابیس: ' . $conn->error;
            }
            $stmt->close();
        }
    }
    ?>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    <?php include 'header.php'; ?>

    <main class="flex-grow-1 py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-header bg-primary text-white text-center py-4 rounded-top-3">
                            <h4 class="card-title mb-0 fw-bold">
                                <i class="fas fa-paper-plane me-2"></i>
                                فرم درخواست رزرو تور
                            </h4>
                            <p class="mb-0 mt-2 opacity-75">اطلاعات خود را جهت بررسی کارشناسان وارد نمایید.</p>
                        </div>

                        <div class="card-body p-4 p-md-5">

                            <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0 ps-3">
                                    <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php endif; ?>

                            <?php if ($success): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <h6 class="alert-heading fw-bold"><i class="fas fa-check-circle me-2"></i>درخواست ثبت
                                    شد!</h6>
                                <p class="mb-0">کارشناسان سرزمین مادری به زودی با شما تماس می‌گیرند.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php endif; ?>

                            <?php if ($tour_data): ?>
                            <div class="alert alert-info mb-4 border-0 shadow-sm"
                                style="background-color: #e3f2fd; color: #0d47a1;">
                                <h6 class="fw-bold mb-3 text-primary"><i class="fas fa-info-circle me-2"></i>جزئیات تور
                                    انتخابی:</h6>
                                <p class="mb-2"><strong>عنوان:</strong>
                                    <?php echo htmlspecialchars($tour_data['title']); ?></p>
                                <p class="mb-2"><strong>مقصد:</strong>
                                    <?php echo htmlspecialchars($tour_data['country_fa'] . ' - ' . $tour_data['city_fa']); ?>
                                </p>
                                <p class="mb-2"><strong>تاریخ:</strong>
                                    <?php echo htmlspecialchars($tour_data['start_date_fa'] ?? $tour_data['start_date_en'] ?? 'نامشخص'); ?>
                                </p>
                                <p class="mb-0"><strong>قیمت پایه:</strong>
                                    <?php echo number_format($tour_data['price']); ?> تومان</p>
                            </div>
                            <?php endif; ?>

                            <form method="post" action="" class="needs-validation" novalidate>
                                <input type="hidden" name="tour_id" value="<?php echo htmlspecialchars($tour_id); ?>">

                                <div class="mb-3">
                                    <label for="name" class="form-label">نام و نام خانوادگی <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                                        value="<?php echo htmlspecialchars($name); ?>"
                                        placeholder="نام کامل خود را وارد کنید" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">شماره تماس <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control form-control-lg" id="phone" name="phone"
                                        value="<?php echo htmlspecialchars($phone); ?>" placeholder="مثال: 09121234567"
                                        pattern="0[0-9]{10}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="passengers" class="form-label">تعداد مسافران</label>
                                    <select class="form-select form-select-lg" id="passengers" name="passengers">
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?php echo $i; ?>"
                                            <?php echo ($i == $passengers) ? 'selected' : ''; ?>>
                                            <?php echo $i; ?> نفر
                                        </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="notes" class="form-label">توضیحات (اختیاری)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"
                                        placeholder="اگر درخواست خاصی دارید اینجا بنویسید..."><?php echo htmlspecialchars($notes); ?></textarea>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg fw-bold py-3 shadow">
                                        <i class="fas fa-check me-2"></i> تایید و ارسال درخواست
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // جاوا اسکریپت برای اعتبارسنجی فرم بوت استرپ
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })();
    </script>
</body>

</html>