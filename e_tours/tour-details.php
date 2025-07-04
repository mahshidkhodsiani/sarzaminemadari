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

            $encoded_tour = $_GET['tour'];
            $tour = urldecode($encoded_tour);

            // استفاده از prepared statement برای جلوگیری از SQL Injection
            $stmt = $conn->prepare("SELECT * FROM exhibition_tours WHERE title = ?");
            $stmt->bind_param("s", $tour);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) { ?>

                <div class="tour-card">
                    <div class="tour-content">
                        <div class="tour-image-col">
                            <span class="tour-badge">پیشنهاد ویژه</span>
                            <div class="tour-header">
                                <img
                                    src="<?= $row['tour_image'] ?>"
                                    alt="<?= htmlspecialchars($row['title']) ?>"
                                    class="tour-main-image img-fluid">
                            </div>
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
                                    مدت تور: <?= htmlspecialchars($row['duration'] ?? '۷ روز') ?>
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
                                <a class="btn-book" style="text-decoration: none;"
                                    href="../request_form_tour?tour_id=<?= urlencode($row['id']) ?>">
                                    <i class="fas fa-shopping-cart"></i> رزرو تور
                                </a>
                            </div>

                            <div class="gallery-thumbnails">
                                <?php
                                // نمایش تصاویر گالری
                                $images = json_decode($row['gallery_images'] ?? '[]', true);
                                foreach ($images as $index => $image) {
                                    echo '<img src="' . htmlspecialchars(str_replace('../', '', $image)) . '" 
                                         class="thumbnail" 
                                         alt="تصویر ' . ($index + 1) . ' تور ' . htmlspecialchars($row['title']) . '">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            } else {
                echo '<div class="alert alert-danger text-center mt-5 py-3">
                        تور مورد نظر پیدا نشد. <a href="tours.php">بازگشت به صفحه تورها</a>
                      </div>';
            }
        } else {
            echo '<div class="alert alert-warning text-center mt-5 py-3">
                    شناسه تور ارسال نشده است. <a href="tours.php">مشاهده تورهای موجود</a>
                  </div>';
        }
        ?>
    </div>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <?php include "footer.php"; ?>
</body>

</html>