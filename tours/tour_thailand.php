<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="جزئیات تورهای گردشگری آژانس سرزمین مادری">
    <title>نمایش تور | آژانس سرزمین مادری</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../css/styles.css">

</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container my-5">
        <div class="tour-card shadow-lg rounded-3">
            <div class="row g-0">
                <!-- تصویر تور -->
                <div class="col-md-">
                    <img src="../img/18.jpg" alt="تور تایلند" class="img-fluid rounded-top w-100">
                </div>
                <div class="col-12 col-md-6">
                    <div class="tour-content p-4">
                        <h2 class="tour-title text-primary mb-4">تور تایلند</h2>
                        <p class="text-muted">سفر به سرزمین لبخندها، جایی که تاریخ، طبیعت و فرهنگ در هم آمیخته‌اند.</p>

                        <!-- سوالات متداول -->
                        <div class="accordion" id="faqAccordion">
                            <h3 class="section-title mb-3">سوالات متداول</h3>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        چند روز زمان برای سفر به تایلند کافی است؟
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        حداقل زمان مورد نیاز برای دیدن حداقل جاذبه‌های تایلند 7 روز است ولی پیشنهاد ما سفری حداقل 10 روزه و یا دو هفته‌ای به این کشور برای لذت حداکثری از این سفر است.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        ویزای تایلند چند روزه صادر می‌شود؟
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        ویزای تایلند در بازه زمانی یک هفته تا 10 روز به صورت ویزای الکترونیک (e-visa) صادر می‌شود.
                                    </div>
                                </div>
                            </div>
                            <!-- سایر سوالات به همین شکل -->
                        </div>

                        <!-- درباره تایلند -->
                        <h3 class="section-title mt-5 mb-3">درباره تایلند</h3>
                        <p>کشور تایلند در جنوب شرقی آسیا با پیشینه تاریخی و جاذبه‌های گردشگری بسیار زیاد شناخته می‌شود. این کشور که پیشتر با نام "سیام" شناخته می‌شده است، دارای سیستم حکمرانی مشروطه سلطنتی است...</p>

                        <!-- آب و هوای تایلند -->
                        <h3 class="section-title mt-4 mb-3">آب و هوای تایلند</h3>
                        <p>این کشور دارای آب و هوای گرم و استوایی است و می‌توان گفت فقط 2 فصل در این کشور وجود دارد: فصل گرم و فصل گرم‌تر. برای بررسی آب و هوا می‌توانید به سایت <a href="https://www.accuweather.com" target="_blank">AccuWeather</a> مراجعه کنید.</p>

                        <!-- رستوران‌ها -->
                        <h3 class="section-title mt-4 mb-3">رستوران‌های ایرانی در تایلند</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>نام رستوران</th>
                                        <th>شهر</th>
                                        <th>آدرس</th>
                                        <th>شماره تماس</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>رستوران ترنج</td>
                                        <td>پوکت</td>
                                        <td>Sai Kor, Pa Tong, Amphoe Kathu, Phuket 83150, Thailand</td>
                                        <td>+66 85 831 1906</td>
                                    </tr>
                                    <!-- سایر رستوران‌ها -->
                                </tbody>
                            </table>
                        </div>

                        <!-- شهرهای توریستی -->
                        <h3 class="section-title mt-4 mb-3">شهرهای توریستی تایلند</h3>
                        <div class="row">
                            <div class="col-12 col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">بانکوک</h5>
                                        <p class="card-text">پایتخت تایلند، شهری بدون خواب با بازارهای 24 ساعته و جاذبه‌های متنوع.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- سایر شهرها -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <?php include 'footer.php'; ?>
</body>

</html>