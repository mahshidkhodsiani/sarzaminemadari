<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>نمایش تور | آژانس سرزمین مادری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="جزئیات تورهای گردشگری آژانس سرزمین مادری">


    <link rel="stylesheet" href="styles.css">

</head>

<body>

    <?php
    // این شامل‌ها بهتره در ابتدای body یا حتی head باشن اگر خروجی HTML تولید نمی‌کنن
    include 'includes.php';
    include '../config.php';
    include 'header.php'; // هدر هم بهتره همینجا باشه
    ?>

    <div class="tour-container container-fluid">
        <?php
        // فرض می‌کنیم که هنوز این بخش برای نمایش جزئیات تور از دیتابیس استفاده میشه
        if (isset($_GET['tour'])) {
            $tour = mysqli_real_escape_string($conn, $_GET['tour']);
            $result = mysqli_query($conn, "SELECT * FROM tours WHERE title = '$tour'");

            if ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="tour-card custom-card-style">
                    <div class="row g-0 flex-row-reverse">
                        <div class="col-lg-6 col-md-12 tour-image-col p-0">
                            <span class="tour-badge">پیشنهاد ویژه</span>
                            <img src="<?= htmlspecialchars($row['tour_image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="img-fluid custom-image-style">
                        </div>

                        <div class="col-lg-6 col-md-12 tour-details-col p-4">
                            <h1 class="tour-title"><?= htmlspecialchars($row['title']) ?></h1>

                            <div class="tour-meta d-flex flex-wrap mb-4">
                                <div class="tour-meta-item d-flex align-items-center me-3">
                                    <i class="fas fa-map-marker-alt ms-2"></i>
                                    <?= htmlspecialchars($row['country_fa']) ?> - <?= htmlspecialchars($row['city_fa']) ?>
                                </div>
                                <div class="tour-meta-item d-flex align-items-center me-3">
                                    <i class="far fa-calendar-alt ms-2"></i>
                                    <?= htmlspecialchars($row['date_fa']) ?>
                                </div>
                                <div class="tour-meta-item d-flex align-items-center me-3">
                                    <i class="fas fa-clock ms-2"></i>
                                    مدت تور: ۷ روز
                                </div>
                            </div>

                            <div class="tour-description mb-4">
                                <?= nl2br($row['description']) ?>
                            </div>

                            <div class="tour-info p-3 mb-4 rounded">
                                <div class="info-row d-flex justify-content-between py-2">
                                    <span class="info-label">کشور:</span>
                                    <span class="info-value"><?= htmlspecialchars($row['country_fa']) ?> (<?= htmlspecialchars($row['country_en']) ?>)</span>
                                </div>
                                <div class="info-row d-flex justify-content-between py-2">
                                    <span class="info-label">شهر:</span>
                                    <span class="info-value"><?= htmlspecialchars($row['city_fa']) ?> (<?= htmlspecialchars($row['city_en']) ?>)</span>
                                </div>
                                <div class="info-row d-flex justify-content-between py-2">
                                    <span class="info-label">تاریخ شمسی:</span>
                                    <span class="info-value"><?= htmlspecialchars($row['date_fa']) ?></span>
                                </div>
                                <div class="info-row d-flex justify-content-between py-2 border-0">
                                    <span class="info-label">تاریخ میلادی:</span>
                                    <span class="info-value"><?= htmlspecialchars($row['date_en']) ?></span>
                                </div>
                            </div>

                            <div class="price-box p-4 text-center rounded">
                                <span class="price-label d-block mb-2">شروع قیمت از</span>
                                <div class="price-value mb-3"><?= number_format($row['price']) ?> تومان</div>
                                <button class="btn btn-book">
                                    <i class="fas fa-shopping-cart ms-2"></i> رزرو تور
                                </button>
                            </div>

                            <div class="gallery-thumbnails d-flex mt-3 overflow-auto pb-2">
                                <img src="<?= htmlspecialchars($row['tour_image']) ?>" class="thumbnail me-2" alt="تور 1">
                                <img src="https://via.placeholder.com/300x200?text=تور+۲" class="thumbnail me-2" alt="تور 2">
                                <img src="https://via.placeholder.com/300x200?text=تور+۳" class="thumbnail me-2" alt="تور 3">
                                <img src="https://via.placeholder.com/300x200?text=تور+۴" class="thumbnail me-2" alt="تور 4">
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                echo '<div class="alert alert-danger text-center mt-5 py-3">تور مورد نظر پیدا نشد.</div>';
            }
        } else {
            // این بخش جدید اطلاعات ثابت رو از HTML شما می‌گیره
            // اگر از این بخش به عنوان یک صفحه مجزا (مثلاً سوالات متداول) استفاده می‌کنید، خوبه.
            // در غیر این صورت، این بخش رو حذف کنید و از کد PHP بالا برای نمایش جزئیات تور استفاده کنید.
            ?>
            <div class="tour-card custom-card-style">
                <div class="row g-0">
                    <div class="col-12">
                        <img src="../img/18.jpg" alt="تور تایلند" class="img-fluid rounded-top w-100">
                    </div>

                    <div class="col-12 p-3">
                        <h3>سوالات متداول</h3>

                        <div class="mb-3">
                            <h5>• چند روز زمان برای سفر به تایلند کافی است؟</h5>
                            <p>حداقل زمان مورد نیاز برای دیدن حداقل جاذبه های تایلند 7 روز است ولی پیشنهاد ما سفری حداقل 10 روزه و یا دو هفته ای به این کشور برای لذت حداکثری از این سفر است.</p>
                        </div>

                        <div class="mb-3">
                            <h5>• ویزای تایلند چند روزه صادر میشود؟</h5>
                            <p>ویزای تایلند در بازه زمانی یک هفته تا 10 روز به صورت ویزای الکترونیک (e-visa) صادر میشود.</p>
                        </div>

                        <div class="mb-3">
                            <h5>• مدارک لازم برای ویزای تایلند</h5>
                            <ol>
                                <li>پاسپورت با حداقل 6 ماه مدت اعتبار (توجه داشته باشید در زمان ورود به کشور تایلند بایستی تاریخ اعتبار پاسپورت حداقل 6 ماه تمام باشد.)</li>
                                <li>تمکن مالی به مبلغ 50 میلون تومان برای هر نفر (برای فرزندان زیر 18 سال یکی از والدین میتواند این تمکن را تامین کند، به عنوان مثال برای یک پدر و فرزند 100 میلیون تومان تمکن مالی مورد نیاز است)</li>
                                <li>فایل عکس چهره جدید بدون روتوش</li>
                                <li>اسکن شناسنامه و کارت ملی</li>
                                <li>بلیط هواپیما و رزرو هتل با مهر آژانس هواپیمایی صادر کننده</li>
                                <li>بیمه مسافرتی حداقل یک ماهه (به دلیل هماهنگی با اکثر سفارت ها، حتی الامکان از بیمه سامان استفاده گردد.)</li>
                            </ol>
                        </div>

                        <div class="mb-3">
                            <h5>• آیا سفر تایلند سفر مناسبی برای خانواده است؟</h5>
                            <p>حتما، برخلاف ذهنیت غالب، کشور تایلند برای سفر به صورت خانوادگی کاملا مناسب است و میتوانید از بازارهای دیدنی، جاذبه های طبیعی بسیار زیبا و مکان های گردشگری متنوع آن بهره ببرید.</p>
                        </div>

                        <div class="mb-3">
                            <h5>• آیا سفر به تایلند تجربه جالبی برای کودکان خواهد بود؟</h5>
                            <p>تجربیاتی نظیر مشاهده پارک کروکودیل ها، فیل سواری، انواع تفریحات آبی در محیطی کاملا امن و قایق سواری در بازار شناور بانگکوک قطعا برای هر کودکی تجربه ای جالب و به یاد ماندنی خواهد بود.</p>
                        </div>
                    </div>

                    <div class="col-12 p-3">
                        <h3>درباره تایلند</h3>
                        <p>کشور تایلند در جنوب شرقی آسیا با پیشینه تاریخی و جاذبه های گردشگری بسیار زیاد شناخته میشود. این کشور که پیشتر با نام "سیام" شناخته میشده است، دارای سیستم حکمرانی مشروطه سلطنتی است و لذا پادشاه در این کشور دارای قدرت بسیار زیادی است. هرگونه توهین و اهانت به پادشاه این کشور میتواند عواقب حقوقی جدی داشته باشد لذا به مسافرین عزیز توصیه میکنیم از هرگونه اقدام در این خصوص حتی به شوخی به شدت اجتناب نمایند.</p>
                    </div>

                    <div class="col-12 p-3">
                        <h3>آب و هوای تایلند</h3>
                        <p>این کشور یکی دارای آب و هوای گرم و استوایی است و میتوان گفت فقط 2 فصل در این کشور وجود دارد: فصل گرم و فصل گرمتر. در این کشور در هر لحظه بایستی احتمال بارش شدید باران را دهید و این اتفاق بسیار مرسوم و معمولی در این کشور است. از سایت زیر در تمامی روزهای سال میتوانید آب و هوای شهرهای مختلف تایلند را به دقت خوبی تخمین بزنید:</p>
                        <p><a href="https://www.accuweather.com" target="_blank">https://www.accuweather.com</a></p>
                        <p>بعد از ورود به این وبسایت با وارد کردن شهرهای مورد نظر خود نظیر بانگکوک (Bangkok) و یا پوکت (Phuket) و یا سایر شهرهای تایلند، در انتهای صفحه در قسمت 10-Day Weather Forecast آب و هوای شهر مورد نظر خود را در بازه زمانی 10 روزه بررسی نمایید.</p>
                    </div>

                    <div class="col-12 p-3">
                        <h3>امنیت در تایلند</h3>
                        <p>اقتصاد تایلند به شدت به مسئله توریسم وابسته و به همین دلیل در امنیت و سلامت مسافرین ورودی به این کشور اهتمام ویژه ای شده است و امنیت برای مسافرین در این کشور در بیشترین حد ممکن تامین شده است و هیچگونه مشکلی در این خصوص تاکنون مشاهده نشده است. هرچند پیشنهاد میشود برای عدم یروز مشکل پیش از دریافت هرگونه کالا یا خدمات در این کشور از میزان دقیق مبلغ و شرایط کالا و خدمات اطلاع دقیق حاصل فرمایید. یکی از مشکلات جدی در معابد تایلند، آزادی عمل میمون ها در سرقت وسایل گردشگران است و به دلیل مقدس بودن این حیوان در افکار مردم تایلند، اجازه برخورد خشن با این حیوان داده نمیشود. لذا توصیه اکید میشود لوازم و وسایل قیمتی خود را پیش از حضور در این معابد به گونه ای قرار دهید که قابل دسترسی برای این حیوانات نباشد. (در صورتی که لوازمی از شما توسط این حیوانات سرقت شد معمولا با دادن چیزی مثل یک میوه یا خوراکی به آنان، کال</p>
                    </div>

                    <div class="col-12 p-3">
                        <h3>غذا و خوراک در تایلند</h3>
                        <p>در تایلند به دلیل وجود رستوران های چند ملیتی و حتی ایرانی هیچ دغدغه ای در خصوص غذا و خوراک نخواهید داشت و تنوع انواع غذاهای ملل در کشور تایلند میتواند تجربه بینظیری در این خصوص برای شما فراهم آورد. همچنین رستوران های ایرانی زیادی در این کشور فعال هستند که به پیوست نام و مشخصات تماس تعدادی از آنها معرفی میشوند:</p>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>نام رستوران</th>
                                        <th>شهر</th>
                                        <th>آدرس</th>
                                        <th>آدرس سایت یا آدرس شبکه های اجتماعی</th>
                                        <th>شماره تماس</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>رستوران ترنج</td>
                                        <td>پوکت (Phuket)</td>
                                        <td>Sai Kor, Pa Tong, Amphoe Kathu, Phuket 83150, Thailand</td>
                                        <td>------------------</td>
                                        <td>+66 85 831 1906</td>
                                    </tr>
                                    <tr>
                                        <td>Padiran Persian Cuisine</td>
                                        <td>پوکت (Phuket)</td>
                                        <td>204, 41 Soi La Diva, Pa Tong, Kathu District, Phuket 83150, Thailand</td>
                                        <td>--------------------</td>
                                        <td>+66 89 005 8042</td>
                                    </tr>
                                    <tr>
                                        <td>رستوران ایران کوچک (Little Persian)</td>
                                        <td>پوکت (Phuket)</td>
                                        <td>95 27 ซอย ใสยวน Rawai, Mueang Phuket District, Phuket 83000, Thailand</td>
                                        <td>foodpanda.co.th</td>
                                        <td>+66 82 060 3350</td>
                                    </tr>
                                    <tr>
                                        <td>Persian House</td>
                                        <td>بانگکوک (Bangkok)</td>
                                        <td>48/2-3 (Soi Wat Khak Pan Road Silom, Bangkok 105</td>
                                        <td>persianhousebkk.com</td>
                                        <td>+66 2 635 2674</td>
                                    </tr>
                                    <tr>
                                        <td>رستوران ایرانی فانوس</td>
                                        <td>بانگکوک (Bangkok)</td>
                                        <td>Sukhumvit Rd, Khlong Toei, Bangkok 10110, Thailand</td>
                                        <td>Instagram: fanoos_resturant_thailand</td>
                                        <td>+66 802863766</td>
                                    </tr>
                                    <tr>
                                        <td>رستوران محسن</td>
                                        <td>بانگکوک (Bangkok)</td>
                                        <td>Suriyawong, Bangrak 6 Soi Prachum (Silom) Silom Road, Silom Bangkok, Bangkok 10500 TH</td>
                                        <td>http://mohsen-restaurant.com/</td>
                                        <td>+66 64 239 3616</td>
                                    </tr>
                                    <tr>
                                        <td>رستوران ایرانی شمرون</td>
                                        <td>بانگکوک (Bangkok)</td>
                                        <td>11,Top of Hillary, 43 Sukhumvit 11 Alley, Khlong Toei Nuea, Watthana, Bangkok 10110, Thailand</td>
                                        <td>-----------------------------</td>
                                        <td>+66 92 756 6462</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 p-3">
                        <h3>شهرهای توریستی تایلند</h3>
                        <p>معروف ترین شهرهای توریستی تایلند در اینجا آورده شده است:</p>

                        <h4>بانکوک (بانگکوک)</h4>
                        <p>بانگکوک به عنوان پایتخت تایلند، شهری بدون خواب شناخته میشود و در 24 ساعت شبانه روز میتوانید تفریح و یا گشت و گذاری در این شهر بیابید. بازارهای این شهر نیز به طور تمام وقت فعال هستند و خصوصا در ایام شلوغ نظیر تعطیلات سال نو چینی و یا کریسمس این شهر لحظه ای خلوت نخواهد بود.</p>

                        <h5>جاذبه های بانکوک</h5>
                        <ul>
                            <li>بازار شناور</li>
                            <li>بازار چاتوچاک</li>
                            <li>بازار آسیاتک</li>
                            <li>خیابان خائوسان</li>
                            <li>باغ پروانه‌ها و حشرات زنده</li>
                            <li>موزه مادام توسو</li>
                            <li>مزرعه و باغ وحش تمساح‌ها</li>
                            <li>باغ وحش کهن دوسیت</li>
                            <li>میدان سیام بانکوک</li>
                            <li>پارک لومفینی</li>
                        </ul>

                        <p>این پارک به عنوان پارک مرکزی (central park) بانکوک شناخته میشود، بزرگترین پارک این کشور است. اسم این پارک از محل تولد بودا گرفته شده است. در مرکز این پارک دریاچه ای قرار دارد که میتواند انواع تفریحات آبی را در آن بیابید. دیدن این دریاچه در صورتی که سفر شما در بانکوک حداقل 3 روزه است پیشنهاد میشود.</p>

                        <h4>پاتایا</h4>

                        <h4>پوکت</h4>

                        <h4>جزیره فی فی</h4>

                        <h4>جزیره ساموئی</h4>

                        <h4>جزیره کرابی</h4>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <?php include 'footer.php'; ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>