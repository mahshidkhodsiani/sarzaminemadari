<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>جزئیات تور نمایشگاهی | سرزمین مادری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        if (isset($_GET['id'])) {
            $tour_id = (int)$_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM exhibition_tours WHERE id = ?");
            $stmt->bind_param("i", $tour_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) { 
                // حل مشکل نمایش تاریخ در صورت نبودن فیلد جدید در دیتابیس قدیمی
                $display_date = $row['start_date_fa'] ?? ($row['date_fa'] ?? 'تعیین نشده');
                ?>

        <div class="tour-main-wrapper">

            <div class="tour-content-area">
                <div class="modern-card">
                    <div class="modern-image-container">
                        <span class="tour-badge">تور برگزیده</span>
                        <img src="<?= $row['tour_image'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    </div>

                    <h1 class="tour-main-title"><?= htmlspecialchars($row['title']) ?></h1>

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
                        <h3 class="fw-bold mb-3" style="color:#1a2a6c;">درباره رویداد:</h3>
                        <div class="content-text">
                            <?= $row['description'] ?>
                        </div>
                    </div>

                    <div class="gallery-thumbnails p-4">
                        <?php
                                $images = json_decode($row['gallery_images'] ?? '[]', true);
                                foreach ($images as $image) {
                                    echo '<img src="' . htmlspecialchars(str_replace('../', '', $image)) . '" class="thumbnail">';
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
                            style="border-radius:15px;">
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
                    <a href="tour-details.php?id=<?= $recent['id'] ?>" class="text-decoration-none text-dark">
                        <div class="recent-tour-item">
                            <img src="<?= $recent['tour_image'] ?>" class="recent-tour-img">
                            <div class="recent-tour-info">
                                <h4><?= mb_strimwidth($recent['title'], 0, 40, "...") ?></h4>
                                <span class="price"><?= number_format($recent['price']) ?> تومان</span>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>

                <div class="sidebar-widget">
                    <h3 class="widget-title">پیشنهادات ویژه</h3>
                    <?php
                            $recent_sql = "SELECT id, title, price, tour_image FROM exhibition_tours WHERE id != ? ORDER BY id DESC LIMIT 4";
                            $res_stmt = $conn->prepare($recent_sql);
                            $res_stmt->bind_param("i", $tour_id);
                            $res_stmt->execute();
                            $recent_result = $res_stmt->get_result();

                            while ($recent = $recent_result->fetch_assoc()) { ?>
                    <a href="tour-details.php?id=<?= $recent['id'] ?>" class="text-decoration-none text-dark">
                        <div class="recent-tour-item">
                            <img src="<?= $recent['tour_image'] ?>" class="recent-tour-img">
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

        <?php
            } else {
                echo '<div class="alert alert-danger text-center mt-5">تور یافت نشد.</div>';
            }
        }
        ?>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>