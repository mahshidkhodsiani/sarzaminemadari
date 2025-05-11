<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>آژانس مسافرتی سرزمین مادری</title>

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
        <div class="row">
            <div class="col-md-2">
                <h2 class="d-flex justify-center">تورهای نمایشگاهی</h2>
            </div>
            <div class="col-md-8">
                <hr>
            </div>
            <div class="col-md-2">
                <a href="e_tours" class="btn btn-info">دیدن تمامی تورهای نمایشگاهی</a>
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


                                <p><i class="bi bi-cash-coin me-1"></i> شروع قیمت از <?= $exhibition_row['price'] ?> تومان</p>

                                <p class="card-text"><?php echo substr($exhibition_row['description'], 0, 100); ?>...</p>
                                <br>
                                <div class="d-flex justify-content-center mb-3">
                                    <!-- لینک جزئیات با آیدی تور -->

                                    <a href="tours?id_tour=<?= $exhibition_row['id'] ?>" class="btn btn-warning rounded-pill">جزئیات تور</a>
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
        <div class="row">
            <div class="col-md-2">
                <h2 class="d-flex justify-center">تورهای خارجی</h2>
            </div>
            <div class="col-md-8">
                <hr>
            </div>
            <div class="col-md-2">
                <a href="e_tours" class="btn btn-info">دیدن تمامی تورهای خارجی</a>
            </div>
        </div>

        <div class="row mt-2 g-3"> <!-- فاصله بین کاردها را کمی کمتر کردیم -->
            <!-- کارد 1 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 "> <!-- تغییر در col-6 -->
                <div class="card card-tours h-100">
                    <img src="img/4.jpg" class="card-img-top" alt="تور استانبول">
                    <div class="card-body tours">
                        <h5 class="card-title">تور استانبول</h5>
                        <p class="card-text">تور 5 روزه استانبول با پرواز مستقیم و اقامت در هتل 5 ستاره</p>
                        <br>
                        <div class="d-flex justify-content-center mb-3">
                            <a href="#" class="btn btn-warning rounded-pill">جزئیات تور</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- کارد 2 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="card card-tours h-100">
                    <img src="img/4.jpg" class="card-img-top" alt="تور کیش">
                    <div class="card-body tours">
                        <h5 class="card-title">تور کیش</h5>
                        <p class="card-text">تور 4 روزه جزیره کیش با برنامه‌های تفریحی متنوع</p>
                        <br>
                        <div class="d-flex justify-content-center mb-3">
                            <a href="#" class="btn btn-warning rounded-pill">جزئیات تور</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- کارد 3 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="card card-tours h-100">
                    <img src="img/4.jpg" class="card-img-top" alt="تور دبی">
                    <div class="card-body tours">
                        <h5 class="card-title">تور دبی</h5>
                        <p class="card-text">تور 6 روزه دبی با بازدید از برج خلیفه و مراکز خرید</p>
                        <br>
                        <div class="d-flex justify-content-center mb-3">
                            <a href="#" class="btn btn-warning rounded-pill">جزئیات تور</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- کارد 4 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="card card-tours h-100">
                    <img src="img/4.jpg" class="card-img-top" alt="تور شمال">
                    <div class="card-body tours">
                        <h5 class="card-title">تور شمال</h5>
                        <p class="card-text">تور 3 روزه شمال با اقامت در ویلاهای ساحلی</p>
                        <br>
                        <div class="d-flex justify-content-center mb-3">
                            <a href="#" class="btn btn-warning rounded-pill">جزئیات تور</a>
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
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <img src="img/8.png" style="max-width: 100%; height: auto;">
                </div>


            </div>
        </div>
    </div>


    <?php include 'footer.php'; ?>

</body>

</html>