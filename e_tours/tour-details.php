<?php
include 'includes.php';
include '../config.php';

// ابتدا دریافت اطلاعات برای استفاده در تگ‌های Head
$tour_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $conn->prepare("SELECT * FROM exhibition_tours WHERE id = ?");
$stmt->bind_param("i", $tour_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $title = htmlspecialchars($row['title']);
    $description = mb_strimwidth(strip_tags($row['description']), 0, 160, "...");
    $current_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $display_date = $row['start_date_fa'] ?? ($row['date_fa'] ?? 'تعیین نشده');
} else {
    $title = "تور یافت نشد | سرزمین مادری";
    $description = "جزئیات تور مورد نظر یافت نشد.";
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?> | سرزمین مادری</title>
    <meta name="description" content="<?= $description ?>">
    <link rel="canonical" href="<?= $current_url ?? '' ?>">

    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:url" content="<?= $current_url ?? '' ?>">
    <meta property="og:site_name" content="سرزمین مادری">
    <meta property="og:image" content="<?= $row['tour_image'] ?? '' ?>">

    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="../img/logo.png">

    <?php if ($row): ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "<?= $title ?>",
        "image": "<?= $row['tour_image'] ?>",
        "description": "<?= $description ?>",
        "brand": {
            "@type": "Brand",
            "name": "سرزمین مادری"
        },
        "offers": {
            "@type": "Offer",
            "url": "<?= $current_url ?>",
            "priceCurrency": "IRT",
            "price": "<?= $row['price'] ?>",
            "availability": "https://schema.org/InStock"
        }
    }
    </script>
    <?php endif; ?>

</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container tour-container">
        <?php if ($row): ?>
        <div class="tour-main-wrapper">

            <div class="tour-content-area">
                <div class="modern-card">
                    <div class="modern-image-container">
                        <span class="tour-badge">تور برگزیده</span>
                        <img src="<?= $row['tour_image'] ?>" alt="رزرو <?= $title ?> - سرزمین مادری"
                            title="<?= $title ?>">
                    </div>

                    <h1 class="tour-main-title"><?= $title ?></h1>

                    <div class="feature-grid">
                        <div class="feature-item">
                            <i class="fas fa-globe"></i>
                            <span>کشور</span>
                            <strong><?= htmlspecialchars($row['country_fa']) ?></strong>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-city"></i>
                            <span>شهر</span>
                            <strong><?= htmlspecialchars($row['city_fa']) ?></strong>
                        </div>
                        <div class="feature-item">
                            <i class="far fa-calendar-check"></i>
                            <span>تاریخ شروع</span>
                            <strong><?= htmlspecialchars($display_date) ?></strong>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-hourglass-half"></i>
                            <span>مدت زمان</span>
                            <strong><?= htmlspecialchars($row['duration'] ?? '7') ?> روز</strong>
                        </div>
                    </div>

                    <div class="tour-description px-4">
                        <h2 class="fw-bold mb-3" style="color:#1a2a6c; font-size: 1.5rem;">درباره رویداد نمایشگاهی</h2>
                        <div class="content-text">
                            <?= $row['description'] ?>
                        </div>
                    </div>

                    <div class="gallery-thumbnails p-4">
                        <?php
                        $images = json_decode($row['gallery_images'] ?? '[]', true);
                        foreach ($images as $image) {
                            $img_url = htmlspecialchars(str_replace('../', '', $image));
                            echo '<img src="' . $img_url . '" class="thumbnail" alt="گالری تصاویر ' . $title . '">';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="tour-sidebar-area">
                <div class="sidebar-widget">
                    <div class="text-center">
                        <span class="text-muted d-block mb-1">شروع نرخ از:</span>
                        <h2 class="price-value text-primary fw-bold mb-3"><?= number_format($row['price']) ?> <small
                                style="font-size:14px">تومان</small></h2>
                        <a href="../request_form_tour?tour_id=<?= $row['id'] ?>"
                            class="btn btn-info btn-lg w-100 py-3 fw-bold text-white shadow-sm"
                            style="border-radius:15px;" rel="nofollow">
                            <i class="fas fa-paper-plane me-2"></i> درخواست رزرو فوری
                        </a>
                    </div>
                </div>

                <div class="sidebar-widget">
                    <h3 class="widget-title">آخرین تورهای نمایشگاهی</h3>
                    <?php
                    $recent_sql = "SELECT id, title, price, tour_image FROM exhibition_tours WHERE id != ? ORDER BY id DESC LIMIT 4";
                    $res_stmt = $conn->prepare($recent_sql);
                    $res_stmt->bind_param("i", $tour_id);
                    $res_stmt->execute();
                    $recent_result = $res_stmt->get_result();

                    while ($recent = $recent_result->fetch_assoc()) { ?>
                    <a href="tour-details.php?id=<?= $recent['id'] ?>" class="text-decoration-none text-dark"
                        title="<?= htmlspecialchars($recent['title']) ?>">
                        <div class="recent-tour-item">
                            <img src="<?= $recent['tour_image'] ?>" class="recent-tour-img"
                                alt="<?= htmlspecialchars($recent['title']) ?>">
                            <div class="recent-tour-info">
                                <h4><?= mb_strimwidth($recent['title'], 0, 40, "...") ?></h4>
                                <span class="price"><?= number_format($recent['price']) ?> تومان</span>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>

            </div>
        </div>
        <?php else: ?>
        <div class="alert alert-danger text-center mt-5">متاسفانه تور مورد نظر یافت نشد. <br> <a href="index.php">مشاهده
                لیست تمامی تورها</a></div>
        <?php endif; ?>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>