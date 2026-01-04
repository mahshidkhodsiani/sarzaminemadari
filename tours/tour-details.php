<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>نمایش تور | آژانس سرزمین مادری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="جزئیات تورهای گردشگری آژانس سرزمین مادری">

    <link rel="stylesheet" href="styles.css">

    <?php
    include 'includes.php';
    include '../config.php';
    ?>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container tour-container">
        <?php
        // تغییر از tour (title) به id برای هماهنگی با سیستم رزرو
        if (isset($_GET['id'])) {
            $tour_id = (int)$_GET['id'];
            
            $stmt = $conn->prepare("SELECT * FROM tours WHERE id = ?");
            $stmt->bind_param("i", $tour_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
        ?>

        <div class="tour-main-wrapper" style="display: flex; gap: 30px; margin-top: 30px;">

            <div class="tour-content-area" style="flex: 2;">
                <div class="modern-card"
                    style="background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    <div class="modern-image-container" style="position: relative; height: 450px;">
                        <span class="tour-badge">پیشنهاد ویژه</span>
                        <img src="<?= htmlspecialchars($row['tour_image']) ?>"
                            alt="<?= htmlspecialchars($row['title']) ?>"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <div class="p-4">
                        <h1 class="tour-main-title" style="font-weight: 900; color: #2c3e50; margin-bottom: 25px;">
                            <?= htmlspecialchars($row['title']) ?></h1>

                        <div class="feature-grid"
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-bottom: 30px;">
                            <div class="feature-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>مقصد</span>
                                <strong><?= htmlspecialchars($row['country_fa']) ?></strong>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-city"></i>
                                <span>شهر</span>
                                <strong><?= htmlspecialchars($row['city_fa']) ?></strong>
                            </div>
                            <div class="feature-item">
                                <i class="far fa-calendar-alt"></i>
                                <span>تاریخ شروع</span>
                                <strong><?= htmlspecialchars($row['start_date_fa']) ?></strong>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-clock"></i>
                                <span>مدت سفر</span>
                                <strong><?= htmlspecialchars($row['duration']) ?></strong>
                            </div>
                        </div>

                        <div class="tour-description">
                            <h4 class="fw-bold mb-3"
                                style="color:#3498db; border-right: 4px solid #3498db; padding-right: 15px;">توضیحات کلی
                                تور</h4>
                            <div style="line-height: 2; color: #555;">
                                <?= nl2br($row['description']) ?>
                            </div>
                        </div>

                        <div class="gallery-thumbnails mt-5 d-flex gap-2">
                            <img src="<?= htmlspecialchars($row['tour_image']) ?>" class="thumbnail"
                                style="width: 100px; height: 75px; border-radius: 8px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="tour-sidebar-area" style="flex: 1;">
                <div class="sidebar-widget text-center">
                    <span class="text-muted d-block mb-1">شروع قیمت از:</span>
                    <h2 class="price-value text-primary fw-bold mb-4" style="font-size: 2.2rem;">
                        <?= number_format($row['price']) ?> <small style="font-size: 14px;">تومان</small>
                    </h2>

                    <a href="../request_form_tour?tour_id=<?= $row['id'] ?>"
                        class="btn btn-info btn-lg w-100 py-3 fw-bold text-white shadow-sm"
                        style="border-radius: 15px;">
                        <i class="fas fa-paper-plane me-2"></i> درخواست رزرو فوری
                    </a>
                </div>

                <div class="sidebar-widget">
                    <h3 class="widget-title">اطلاعات ضروری</h3>
                    <ul class="list-unstyled p-0 m-0">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-globe-americas text-primary me-2"></i>
                            <span class="ms-2">نام انگلیسی کشور: <?= htmlspecialchars($row['country_en']) ?></span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-city text-primary me-2"></i>
                            <span class="ms-2">نام انگلیسی شهر: <?= htmlspecialchars($row['city_en']) ?></span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="far fa-calendar-check text-primary me-2"></i>
                            <span class="ms-2">بازه میلادی:
                                <small dir="ltr"><?= htmlspecialchars($row['start_date_en']) ?> -
                                    <?= htmlspecialchars($row['end_date_en']) ?></small>
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="sidebar-widget">
                    <h3 class="widget-title">تورهای مشابه</h3>
                    <?php
                    // کوئری تورهای مشابه بر اساس جدول tours
                    $other_sql = "SELECT id, title, price, tour_image FROM tours WHERE id != ? ORDER BY id DESC LIMIT 3";
                    $other_stmt = $conn->prepare($other_sql);
                    $other_stmt->bind_param("i", $tour_id);
                    $other_stmt->execute();
                    $other_res = $other_stmt->get_result();

                    while ($other = $other_res->fetch_assoc()) { ?>
                    <a href="tour-details.php?id=<?= $other['id'] ?>" class="text-decoration-none text-dark">
                        <div class="recent-tour-item d-flex align-items-center mb-3">
                            <img src="<?= htmlspecialchars($other['tour_image']) ?>" class="recent-tour-img"
                                style="width: 60px; height: 60px; border-radius: 10px; object-fit: cover;">
                            <div class="ms-3 pr-2">
                                <h6 class="mb-1 fw-bold" style="font-size: 0.9rem;">
                                    <?= mb_strimwidth($other['title'], 0, 30, "...") ?></h6>
                                <span class="text-danger fw-bold"
                                    style="font-size: 0.8rem;"><?= number_format($other['price']) ?> تومان</span>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>

        </div>

        <?php
            } else {
                echo '<div class="alert alert-danger text-center mt-5 py-3">تور مورد نظر پیدا نشد.</div>';
            }
        } else {
            echo '<div class="alert alert-warning text-center mt-5 py-3">شناسه تور ارسال نشده است.</div>';
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>