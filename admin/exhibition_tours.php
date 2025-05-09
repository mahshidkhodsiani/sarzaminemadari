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
                        <form enctype="multipart/form-data">
                            <!-- عنوان تور -->
                            <div class="mb-3">
                                <label for="tour_title" class="form-label">عنوان تور *</label>
                                <input type="text" class="form-control" id="tour_title" name="tour_title" required placeholder="مثلاً نمایشگاه کتاب تهران">
                            </div>


                            <!-- عکس لیبل -->
                            <div class="mb-3">
                                <label for="tour_image" class="form-label">عکس لیبل *</label>
                                <input class="form-control" type="file" id="tour_image" name="tour_image" accept="image/*" required>
                                <small class="text-muted">فرمت‌های مجاز: JPG, PNG, GIF - حداکثر حجم: 2MB</small>
                            </div>

                            <!-- توضیحات -->
                            <div class="mb-3">
                                <label for="tour_description" class="form-label">توضیحات و خدمات تور *</label>
                                <!-- <textarea class="form-control" id="tour_description" name="tour_description" rows="4" required placeholder="توضیحاتی درباره تور بنویسید..."></textarea> -->
                                <textarea>
                                توضیحاتی درباره تور بنویسید
                                </textarea>
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
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="venue_country_en" class="form-label">Country (English) *</label>
                                    <input type="text" class="form-control" id="venue_country_en" name="venue_country_en" required placeholder="e.g. Iran">
                                </div>
                                <div class="col-md-6">
                                    <label for="venue_city_en" class="form-label">City (English) *</label>
                                    <input type="text" class="form-control" id="venue_city_en" name="venue_city_en" required placeholder="e.g. Tehran">
                                </div>
                            </div>

                            <!-- دسته و تاریخ شروع -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="category" class="form-label">دسته‌بندی *</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="">-- انتخاب کنید --</option>
                                        <option value="clothing">پوشاک</option>
                                        <option value="medical">تجهیزات پزشکی</option>
                                        <option value="electronics">الکترونیک</option>
                                        <option value="other">سایر</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">شروع نرخ تور از *</label>
                                    <input type="number" class="form-control" id="start_date" name="start_date" required>
                                </div>
                            </div>

                            <!-- تاریخ‌ها -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="gregorian_date" class="form-label">تاریخ میلادی *</label>
                                    <input type="date" class="form-control" id="gregorian_date" name="gregorian_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="persian_date" class="form-label">تاریخ شمسی *</label>
                                    <input type="text" class="form-control" id="persian_date" name="persian_date" required placeholder="1402/01/01">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info mt-3">ذخیره تور</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- اضافه کردن تاریخ شمسی -->
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">

    <script>
        // تبدیل تاریخ شمسی
        $(document).ready(function() {
            $("#persian_date").persianDatepicker({
                format: 'YYYY/MM/DD',
                observer: true,
                autoClose: true
            });

            // ارتباط بین تاریخ میلادی و شمسی
            $("#gregorian_date").change(function() {
                const gregorianDate = new Date(this.value);
                const persianDate = new PersianDate(gregorianDate);
                $("#persian_date").val(persianDate.format('YYYY/MM/DD'));
            });

            $("#persian_date").change(function() {
                const persianDate = new PersianDate(this.value);
                const gregorianDate = persianDate.toCalendar('gregorian').toLocaleDateString();
                $("#gregorian_date").val(gregorianDate);
            });
        });
    </script>
</body>

</html>