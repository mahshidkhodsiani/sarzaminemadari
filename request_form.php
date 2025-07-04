<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم درخواست تور - آژانس سرزمین مادری</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/png" href="img/logo.png">

    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Vazirmatn Font -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;700&display=swap" rel="stylesheet">

    <?php
    include 'includes.php';
    include 'config.php';

    $tour_data = null;

    // پردازش فرم
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $country = $_POST['country'] ?? '';
    $city = $_POST['city'] ?? '';
    $post_tour_id = NULL;
    $passengers = $_POST['passengers'] ?? 1;
    $notes = $_POST['notes'] ?? '';

    $errors = [];
    $success = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // اعتبارسنجی
        if (empty($name)) {
            $errors[] = 'نام و نام خانوادگی الزامی است.';
        }
        if (empty($phone)) {
            $errors[] = 'شماره تلفن الزامی است.';
        }
        if (empty($country)) {
            $errors[] = 'انتخاب کشور مقصد الزامی است.';
        }
        if (empty($city)) {
            $errors[] = 'انتخاب شهر مقصد الزامی است.';
        }
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'فرمت ایمیل نامعتبر است.';
        }
        if (!is_numeric($passengers) || $passengers < 1) {
            $errors[] = 'تعداد مسافران باید حداقل ۱ نفر باشد.';
        }

        if (empty($errors)) {
            // ذخیره در دیتابیس
            $stmt = $conn->prepare("INSERT INTO tour_requests 
                                   (name, phone, country, city, tour_id, passengers, notes, request_date) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("sssssis", $name, $phone, $country, $city, $post_tour_id, $passengers, $notes);

            if ($stmt->execute()) {
                $success = true;
                // پاک کردن فیلدها پس از ثبت موفق
                $name = $phone = $email = $country = $city = $notes = '';
                $passengers = 1;
            } else {
                $errors[] = 'خطا در ثبت درخواست: ' . $conn->error;
            }
            $stmt->close();
        }
    }
    ?>
</head>

<body>
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
                            <p class="mb-0 mt-2 opacity-75">لطفا اطلاعات خود را جهت رزرو تور مورد نظر وارد نمایید.</p>
                        </div>

                        <div class="card-body p-4 p-md-5">
                            <?php if (!empty($errors)): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>خطا در تکمیل فرم:</h6>
                                    <ul class="mb-0 ps-3">
                                        <?php foreach ($errors as $error): ?>
                                            <li><?php echo htmlspecialchars($error); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($success): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <h6 class="alert-heading"><i class="fas fa-check-circle me-2"></i>ثبت موفقیت‌آمیز!</h6>
                                    <p class="mb-0">درخواست شما با موفقیت ثبت شد. به زودی با شما تماس خواهیم گرفت.</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($tour_data): ?>
                                <div class="alert alert-info mb-4">
                                    <h6 class="fw-bold">تور انتخاب شده:</h6>
                                    <p class="mb-1"><i class="fas fa-map-marked-alt me-2"></i> <strong><?php echo htmlspecialchars($tour_data['title']); ?></strong></p>
                                    <p class="mb-1"><i class="fas fa-location-dot me-2"></i> مقصد: <?php echo htmlspecialchars($tour_data['country_fa']); ?> - <?php echo htmlspecialchars($tour_data['city_fa']); ?></p>
                                    <p class="mb-1"><i class="far fa-calendar-alt me-2"></i> تاریخ: <?php echo htmlspecialchars($tour_data['date_fa']); ?></p>
                                    <p class="mb-0"><i class="fas fa-tag me-2"></i> قیمت: <?php echo number_format($tour_data['price']); ?> تومان</p>
                                </div>
                            <?php endif; ?>

                            <form method="post" action="" class="needs-validation" novalidate>
                                <input type="hidden" name="tour_id" value="<?php echo htmlspecialchars($tour_id); ?>">

                                <div class="mb-3">
                                    <label for="name" class="form-label">نام و نام خانوادگی <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="نام کامل خود را وارد کنید" required>
                                    <div class="invalid-feedback">
                                        لطفا نام و نام خانوادگی خود را وارد کنید.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">شماره تماس <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="مثال: 09121234567" pattern="09[0-9]{9}" title="شماره تماس باید با 09 شروع شده و 11 رقم باشد" required>
                                    <div class="invalid-feedback">
                                        لطفا شماره تماس معتبر خود را وارد کنید. (مثال: 09121234567)
                                    </div>
                                </div>

                           

                                <!-- انتخاب کشور -->
                                <div class="mb-3">
                                    <label for="country" class="form-label">کشور مقصد <span class="text-danger">*</span></label>
                                    <select class="form-select" id="country" name="country" required>
                                        <option value="" selected disabled>-- انتخاب کشور --</option>
                                        <option value="اروپا" <?php echo ($country === 'اروپا') ? 'selected' : ''; ?>>اروپا</option>
                                        <option value="ترکیه" <?php echo ($country === 'ترکیه') ? 'selected' : ''; ?>>ترکیه</option>
                                        <option value="ارمنستان" <?php echo ($country === 'ارمنستان') ? 'selected' : ''; ?>>ارمنستان</option>
                                        <option value="گرجستان" <?php echo ($country === 'گرجستان') ? 'selected' : ''; ?>>گرجستان</option>
                                        <option value="چین" <?php echo ($country === 'چین') ? 'selected' : ''; ?>>چین</option>
                                        <option value="تایلند" <?php echo ($country === 'تایلند') ? 'selected' : ''; ?>>تایلند</option>
                                        <option value="روسیه" <?php echo ($country === 'روسیه') ? 'selected' : ''; ?>>روسیه</option>
                                        <option value="ژاپن" <?php echo ($country === 'ژاپن') ? 'selected' : ''; ?>>ژاپن</option>
                                        <option value="ایران" <?php echo ($country === 'ایران') ? 'selected' : ''; ?>>ایران</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        لطفا کشور مقصد را انتخاب کنید.
                                    </div>
                                </div>

                                <!-- انتخاب شهر (وابسته به کشور) -->
                                <div class="mb-3">
                                    <label for="city" class="form-label">شهر مقصد <span class="text-danger">*</span></label>
                                    <select class="form-select" id="city" name="city" required disabled>
                                        <option value="" selected disabled>-- ابتدا کشور را انتخاب کنید --</option>
                                        <!-- گزینه‌های شهرها با JavaScript پر می‌شوند -->
                                    </select>
                                    <div class="invalid-feedback">
                                        لطفا شهر مقصد را انتخاب کنید.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="passengers" class="form-label">تعداد مسافران</label>
                                    <select class="form-select" id="passengers" name="passengers">
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo ($i == $passengers) ? 'selected' : ''; ?>><?php echo $i; ?> نفر</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="notes" class="form-label">توضیحات اضافی</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="در صورت نیاز، جزئیات بیشتری را وارد کنید..."><?php echo htmlspecialchars($notes); ?></textarea>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg submit-button">
                                        <i class="fas fa-paper-plane me-2"></i> ارسال درخواست
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // اعتبارسنجی فرم
        (function() {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })();

        // شهرهای مربوط به هر کشور
        const citiesByCountry = {
            'اروپا': ['پاریس', 'رم', 'بارسلونا', 'آمستردام', 'برلین'],
            'ترکیه': ['استانبول', 'آنتالیا', 'ازمیر', 'بدروم', 'کوش آداسی'],
            'ارمنستان': ['ایروان', 'گیومری', 'وانادزور'],
            'گرجستان': ['تفلیس', 'باتومی', 'کوتائیسی'],
            'چین': ['پکن', 'شانگهای', 'گوانگژو'],
            'تایلند': ['بانکوک', 'پوکت', 'چیانگ مای'],
            'روسیه': ['مسکو', 'سن پترزبورگ', 'سوچی'],
            'ژاپن': ['توکیو', 'کیوتو', 'اوساکا'],
            'ایران': ['مشهد', 'قشم', 'کیش', 'تهران', 'اصفهان', 'شیراز']
        };

        // مدیریت تغییر کشور و پر کردن شهرهای مربوطه
        document.getElementById('country').addEventListener('change', function() {
            const country = this.value;
            const citySelect = document.getElementById('city');
            
            // پاک کردن گزینه‌های قبلی
            citySelect.innerHTML = '';
            
            if (country) {
                // فعال کردن انتخاب شهر
                citySelect.disabled = false;
                
                // اضافه کردن گزینه پیش‌فرض
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = '-- انتخاب شهر --';
                defaultOption.selected = true;
                defaultOption.disabled = true;
                citySelect.appendChild(defaultOption);
                
                // اضافه کردن شهرهای مربوط به کشور انتخاب شده
                citiesByCountry[country].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    
                    // اگر قبلا انتخاب شده بود، انتخاب شود
                    if (city === '<?php echo htmlspecialchars($city); ?>') {
                        option.selected = true;
                    }
                    
                    citySelect.appendChild(option);
                });
            } else {
                // غیرفعال کردن انتخاب شهر اگر کشوری انتخاب نشده
                citySelect.disabled = true;
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = '-- ابتدا کشور را انتخاب کنید --';
                defaultOption.selected = true;
                defaultOption.disabled = true;
                citySelect.appendChild(defaultOption);
            }
        });

        // اگر کشور از قبل انتخاب شده بود، شهرهای آن را بارگذاری کن
        document.addEventListener('DOMContentLoaded', function() {
            const selectedCountry = '<?php echo htmlspecialchars($country); ?>';
            if (selectedCountry) {
                document.getElementById('country').dispatchEvent(new Event('change'));
            }
        });

        <?php if ($success): ?>
            // نمایش مدال موفقیت و هدایت به صفحه تورها
            document.addEventListener('DOMContentLoaded', function() {
                // ایجاد مدال موفقیت
                var toastEl = document.createElement('div');
                toastEl.className = 'toast align-items-center text-white bg-success border-0';
                toastEl.style.position = 'fixed';
                toastEl.style.top = '20px';
                toastEl.style.right = '20px';
                toastEl.style.zIndex = '1060';

                toastEl.innerHTML = `
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-check-circle me-2"></i> درخواست شما با موفقیت ثبت شد!
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                `;

                document.body.appendChild(toastEl);

                var toast = new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 3000
                });
                toast.show();

                // هدایت به صفحه تورها پس از 3 ثانیه
                setTimeout(function() {
                    window.location.href = 'e_tours';
                }, 3000);
            });
        <?php endif; ?>
    </script>
</body>

</html>