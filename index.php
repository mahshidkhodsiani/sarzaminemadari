<!DOCTYPE html>
<html lang="fa-IR" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="آژانس مسافرتی سرزمین مادری | ارائه بهترین تورهای داخلی و خارجی با قیمت مناسب و خدمات اختصاصی - تور تایلند، تور اروپا، تورهای داخلی ایران| اولین ارائه دهنده تورهای نمایشگاهی">
    <meta name="keywords" content="تور مسافرتی, تور تایلند, تور اروپا, تور داخلی, آژانس مسافرتی, سفر ارزان, تور لحظه آخری, تورهای نمایشگاهی">
    <meta name="author" content="آژانس مسافرتی سرزمین مادری">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="آژانس مسافرتی سرزمین مادری - تخصصی ترین خدمات مسافرتی">
    <meta property="og:description" content="برگزاری تورهای داخلی و خارجی و تورهای نمایشگاهی با بهترین کیفیت و قیمت">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fa_IR">

    <!-- Canonical URL برای جلوگیری از محتوای تکراری -->
    <link rel="canonical" href="https://www.sarzaminemadari.com/" />

    <title>آژانس مسافرتی سرزمین مادری | تورهای داخلی و خارجی با بهترین قیمت</title>

    <!-- Favicon و آیکون های مختلف سایز -->
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">



    <!-- ساختار داده ای Schema.org برای بهبود نمایش در نتایج جستجو -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "TravelAgency",
            "name": "آژانس مسافرتی سرزمین مادری",
            "description": "ارائه دهنده تورهای مسافرتی داخلی و خارجی و نمایشگاهی با کیفیت عالی",
            "url": "https://www.sarzaminemadari.com",
            "logo": "https://www.sarzaminemadari.com/img/logo.png",
            "telephone": "+982122345678",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "اصفهان- خیابان مشتاق دوم- خیابان بازارچه- ابتدای کوچه نوروز- پلاک 2 ",
                "addressLocality": "اصفهان",
                "addressRegion": "اصفهان",
                "addressCountry": "IR"
            },
            "openingHours": "Mo,Tu,We,Th,Fr,Sa 09:00-18:00"
        }
    </script>

    <!-- فایل های CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <?php
    include 'includes.php';
    include 'config.php';
    ?>
</head>

<body>

    <?php include 'header.php'; ?>

    <!-- Bootstrap Carousel -->
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/1.jpg" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="img/2.jpg" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="img/3.jpg" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>




    <div class="container my-5">

        <div class="row align-items-center my-4">
            <div class="d-none d-md-flex col-12 align-items-center justify-content-center position-relative">
                <h2 class="section-title mb-0 text-nowrap">تورهای نمایشگاهی</h2>
                <div class="section-divider-inline flex-grow-1 mx-3"></div> <a href="e_tours" class="btn btn-outline-darkblue text-nowrap">
                    <i class="fas fa-arrow-left me-2"></i> مشاهده تمامی تورهای نمایشگاهی
                </a>
            </div>

            <div class="d-flex d-md-none col-12 justify-content-between align-items-center px-3 py-2">
                <h2 class="h5 mb-0 text-dark fw-bold">تورهای نمایشگاهی</h2>
                <a href="e_tours" class="btn btn-outline-darkblue btn-sm">
                    مشاهده همه <i class="fas fa-arrow-left ms-1"></i>
                </a>
            </div>
        </div>


        <?php
        // کویری برای دریافت 4 تور آخر به ترتیب نزولی (جدیدترین اول)
        $exhibition = "SELECT * FROM exhibition_tours ORDER BY id DESC LIMIT 4";
        $exhibition_result = $conn->query($exhibition);
        ?>

        <div class="row mt-2 g-3">
            <?php
            if ($exhibition_result->num_rows > 0) {
                while ($exhibition_row = $exhibition_result->fetch_assoc()) {

            ?>
                    <div class="col-md-3 col-sm-6 col-6">
                        <div class="card card-tours h-100">
                            <!-- نمایش عکس تور از دیتابیس -->
                            <img src="<?php echo str_replace('../', '', $exhibition_row['tour_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($exhibition_row['title']); ?>">

                            <div class="card-body tours">
                                <h5 class="card-title"><?php echo htmlspecialchars($exhibition_row['title']); ?></h5>


                                <p><i class="bi bi-cash-coin me-1"></i> شروع قیمت از <?= number_format($exhibition_row['price']) ?> تومان</p>


                                <div class="d-flex justify-content-center mb-3">
                                    <!-- لینک جزئیات با آیدی تور -->

                                    <a href="e_tours/tour-details.php?tour=<?= $exhibition_row['title'] ?>" class="btn btn-warning w-100 rounded-pill">دیدن تور</a>


                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                // اگر توری وجود نداشت
                echo '<div class="col-12 text-center"><p>تور نمایشگاهی موجود نیست</p></div>';
            }
            ?>
        </div>
    </div>








    <div class="container my-5">
        <div class="row g-4">
            <!-- تورهای تایلند -->
            <div class="col-md-4">
                <div class="destination-card  rounded-4 p-0 h-100  overflow-hidden" style="background-color: #cbcfd7;">
                    <div class="text-center p-3">
                        <i class="bi bi-luggage-fill"></i>
                        <img src="img/20.png" alt="تور تایلند" class="img-fluid" style="height: 80px;">
                    </div>
                    <div class="p-4 pt-0">
                        <h3 class="fw-bold mb-3 text-center">تورهای تایلند</h3>
                        <p class="text-muted text-center mb-4">تجربه‌ای فراموش‌نشدنی در سواحل بکر، معابد تاریخی و جزایر رویایی</p>
                        <div class="text-center">
                            <a href="tours/tour_thailand" class="btn btn-outline-dark px-4 py-2 rounded-pill">
                                <i class="bi bi-airplane me-2"></i>درباره تایلند
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="destination-card  rounded-4 p-0 h-100  overflow-hidden" style="background-color: #cbcfd7;">
                    <div class="text-center p-3">
                        <i class="bi bi-luggage-fill"></i>
                        <img src="img/21.png" alt="تور تایلند" class="img-fluid" style="height: 80px;">
                    </div>
                    <div class="p-4 pt-0">
                        <h3 class="fw-bold mb-3 text-center">تورهای ترکیه</h3>
                        <p class="text-muted text-center mb-4">سفر به ترکیه؛ تلفیقی از فرهنگ غنی، طبیعت خیره‌کننده و خریدی هیجان‌انگیز.</p>
                        <div class="text-center">
                            <a href="tours/tour_thailand" class="btn btn-outline-dark px-4 py-2 rounded-pill">
                                <i class="bi bi-airplane me-2"></i>درباره ترکیه
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="destination-card  rounded-4 p-0 h-100  overflow-hidden" style="background-color: #cbcfd7;">
                    <div class="text-center p-3">
                        <i class="bi bi-luggage-fill"></i>
                        <img src="img/22.png" alt="تور تایلند" class="img-fluid" style="height: 80px;">
                    </div>
                    <div class="p-4 pt-0">
                        <h3 class="fw-bold mb-3 text-center">تورهای گرجستان</h3>
                        <p class="text-muted text-center mb-4">سفر به گرجستان؛ آمیزه‌ای دل‌انگیز از طبیعت کوهستانی، شهرهای تاریخی و طعم ناب خوراکی‌های محلی.</p>
                        <div class="text-center">
                            <a href="tours/tour_thailand" class="btn btn-outline-dark px-4 py-2 rounded-pill">
                                <i class="bi bi-airplane me-2"></i>درباره گرجستان
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>



    <div class="position-relative overflow-hidden" style="">
        <!-- تصویر پس‌زمینه با افکت چرخش و سفیدی -->
        <div class="rotating-background" style="
        background-image: url('img/11.png');
        background-size: cover;
        background-position: center;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        min-height: 300px;
        filter: brightness(1.3) opacity(0.9);
        animation: rotate-bg 60s linear infinite;
        transform-origin: center center;"></div>

        <!-- Overlay سفید برای کاهش شفافیت بیشتر -->
        <div style="
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.2);
            ">
        </div>

        <div class="container position-relative" style="z-index: 1; height: 100%;">
            <div class="row h-100">
                <div class="col-md-6" style="margin-top: 200px;">
                    <h2>تورهای نمایشگاهی بین المللی</h2>
                    <p>برای اولین بار در ایران</p>
                    <a href="e_tours" class="btn btn-outline-info">دیدن تمامی تورها</a>
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <img src="img/8.png" style="max-width: 100%; height: auto;">
                </div>


            </div>
        </div>
    </div>



    <div class="container my-5">



        <div class="row align-items-center my-4">
            <div class="d-none d-md-flex col-12 align-items-center justify-content-center position-relative">
                <h2 class="section-title mb-0 text-nowrap">تورهای خارجی</h2>
                <div class="section-divider-inline flex-grow-1 mx-3"></div> <a href="tours" class="btn btn-outline-darkblue text-nowrap">
                    <i class="fas fa-arrow-left me-2"></i> مشاهده تمامی تورهای خارجی
                </a>
            </div>

            <div class="d-flex d-md-none col-12 justify-content-between align-items-center px-3 py-2">
                <h2 class="h5 mb-0 text-dark fw-bold">تورهای خارجی</h2>
                <a href="tours" class="btn btn-outline-darkblue btn-sm">
                    مشاهده همه <i class="fas fa-arrow-left ms-1"></i>
                </a>
            </div>
        </div>





        <?php
        // کویری برای دریافت 4 تور آخر به ترتیب نزولی (جدیدترین اول)
        $exhibition = "SELECT * FROM tours ORDER BY id DESC LIMIT 4";
        $tours = $conn->query($exhibition);
        ?>

        <div class="row mt-2 g-3">
            <?php
            if ($tours->num_rows > 0) {
                while ($tours_row = $tours->fetch_assoc()) {

            ?>
                    <div class="col-md-3 col-sm-6 col-6">
                        <div class="card card-tours h-100">
                            <!-- نمایش عکس تور از دیتابیس -->
                            <img src="<?php echo str_replace('../', '', $tours_row['tour_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($tours_row['title']); ?>">

                            <div class="card-body tours">
                                <h5 class="card-title"><?php echo htmlspecialchars($tours_row['title']); ?></h5>


                                <p><i class="bi bi-cash-coin me-1"></i> شروع قیمت از <?= $tours_row['price'] ?> تومان</p>

                                <p class="card-text"><?php echo substr($tours_row['description'], 0, 100); ?>...</p>
                                <br>
                                <div class="d-flex justify-content-center mb-3">
                                    <!-- لینک جزئیات با آیدی تور -->

                                    <a href="tours/tour-details.php?tour=<?= $tours_row['title'] ?>" class="btn btn-warning w-100 rounded-pill">دیدن تور</a>

                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                // اگر توری وجود نداشت
                echo '<div class="col-12 text-center"><p>تور نمایشگاهی موجود نیست</p></div>';
            }
            ?>
        </div>
    </div>




    <div class="parallax-container">
        <div class="parallax-image" style="background-image: url('img/24.jpg');"></div>
    </div>


    <hr>
    <div class="container">
        <div class="row">
            <a href="blog" style="text-decoration: none;">
                <h3 class="text-center mb-4">وبلاگ سرزمین مادری</h3>
            </a>

            <?php

            $query = "SELECT * FROM blog_posts WHERE status='published' ORDER BY created_at DESC LIMIT 3";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        ' . (!empty($row['featured_image']) ?
                        '<img src="' . str_replace('../', '', $row['featured_image']) . '" class="card-img-top" alt="' . $row['title'] . '" style="height: 200px; object-fit: cover;">' :
                        '<div class="text-center py-5 bg-light">بدون تصویر</div>') . '
                        <div class="card-body">
                            <h5 class="card-title">' . $row['title'] . '</h5>
                            <p class="card-text text-muted small">' . date('Y/m/d', strtotime($row['created_at'])) . '</p>
                            <p class="card-text">' . substr(strip_tags($row['content']), 0, 100) . '...</p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="blog/blog_post?slug=' . $row['slug'] . '" class="btn btn-outline-info btn-sm">مطالعه بیشتر</a>
                        </div>
                    </div>
                </div>
                ';
                }
            } else {
                echo '<div class="col-12 text-center py-5">
                <p>مقاله‌ای یافت نشد</p>
            </div>';
            }
            $conn->close();
            ?>
        </div>
    </div>




    <?php include 'footer.php'; ?>

</body>

</html>