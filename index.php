<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>آژانس مسافرتی سرزمین مادری</title>

    <link rel="stylesheet" href="css/styles.css">

    <?php include 'includes.php'; ?>
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
        <h2 class="d-flex justify-center">تورهای ویژه</h2>

        <div class="row g-3"> <!-- فاصله بین کاردها را کمی کمتر کردیم -->
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


</body>

</html>