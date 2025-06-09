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

    <div class="tour-container">
        <?php
        if (isset($_GET['tour'])) {
            // استفاده از prepared statements برای جلوگیری از SQL Injection
            $stmt = $conn->prepare("SELECT * FROM tours WHERE title = ?");
            $stmt->bind_param("s", $_GET['tour']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
        ?>

                <div class="tour-card custom-card-style">
                    <div class="tour-content">
                        <div class="tour-image-col">
                            <span class="tour-badge">پیشنهاد ویژه</span>
                            <img src="<?= htmlspecialchars($row['tour_image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="img-fluid">
                        </div>

                        <div class="tour-details-col">
                            <h1 class="tour-title"><?= htmlspecialchars($row['title']) ?></h1>

                            <div class="tour-meta">
                                <div class="tour-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?= htmlspecialchars($row['country_fa']) ?> - <?= htmlspecialchars($row['city_fa']) ?>
                                </div>
                                <div class="tour-meta-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <?= htmlspecialchars($row['date_fa']) ?>
                                </div>
                                <div class="tour-meta-item">
                                    <i class="fas fa-clock"></i>
                                    مدت تور: ۷ روز
                                </div>
                            </div>

                            <div class="tour-description">
                                <?= nl2br($row['description']) ?>
                            </div>

                            <div class="tour-info">
                                <div class="info-row">
                                    <span class="info-label">کشور:</span>
                                    <span class="info-value"><?= htmlspecialchars($row['country_fa']) ?> (<?= htmlspecialchars($row['country_en']) ?>)</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">شهر:</span>
                                    <span class="info-value"><?= htmlspecialchars($row['city_fa']) ?> (<?= htmlspecialchars($row['city_en']) ?>)</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">تاریخ شمسی:</span>
                                    <span class="info-value"><?= htmlspecialchars($row['date_fa']) ?></span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">تاریخ میلادی:</span>
                                    <span class="info-value"><?= htmlspecialchars($row['date_en']) ?></span>
                                </div>
                            </div>

                            <div class="price-box">
                                <span class="price-label">شروع قیمت از</span>
                                <div class="price-value"><?= number_format($row['price']) ?> تومان</div>
                                <button class="btn-book">
                                    <i class="fas fa-shopping-cart"></i> رزرو تور
                                </button>
                            </div>

                            <div class="gallery-thumbnails">
                                <img src="<?= htmlspecialchars($row['tour_image']) ?>" class="thumbnail" alt="تور 1">
                                <img src="https://via.placeholder.com/300x200?text=تصویر+۲" class="thumbnail" alt="تور 2">
                                <img src="https://via.placeholder.com/300x200?text=تصویر+۳" class="thumbnail" alt="تور 3">
                                <img src="https://via.placeholder.com/300x200?text=تصویر+۴" class="thumbnail" alt="تور 4">
                            </div>
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