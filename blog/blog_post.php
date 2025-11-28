<?php
include 'includes.php';
include '../config.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

if (empty($slug)) {
    die('مقاله‌ای پیدا نشد.');
}

// 1. جستجوی مقاله اصلی بر اساس اسلاگ
$stmt = $conn->prepare("SELECT id, title, content, featured_image, created_at FROM blog_posts WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('مقاله‌ای با این آدرس پیدا نشد.');
}

$row = $result->fetch_assoc();
$current_post_id = $row['id']; // ID مقاله فعلی برای استثنا کردن از مقالات اخیر

// 2. تابع واقعی برای گرفتن 5 مقاله اخیر (به جز مقاله فعلی)
function get_recent_posts($conn, $current_post_id, $limit = 5) {
    // گرفتن 5 مقاله آخر بر اساس تاریخ، به جز مقاله ای که در حال نمایش است.
    $stmt = $conn->prepare("SELECT title, slug, created_at FROM blog_posts WHERE id != ? ORDER BY created_at DESC LIMIT ?");
    $stmt->bind_param("ii", $current_post_id, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $posts = [];
    while ($recent_row = $result->fetch_assoc()) {
        $posts[] = $recent_row;
    }
    return $posts;
}

$recent_posts = get_recent_posts($conn, $current_post_id);

// 3. لینک‌های مهم برای سایدبار دوم
$important_links = [
    ['title' => 'رزرو هتل', 'url' => '../hotel', 'icon' => 'bi-building'],
    ['title' => 'تورهای مسافرتی', 'url' => '../tours', 'icon' => 'bi-compass'],
    ['title' => 'تورهای نمایشگاهی', 'url' => '../e_tours', 'icon' => 'bi-calendar-event'],
    ['title' => 'خدمات ویزا و بیمه', 'url' => '../services', 'icon' => 'bi-journal-check'],
];

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($row['title']) ?> | وبلاگ سرزمین مادری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <?php
    include 'header.php';
    include '../PersianCalendar.php'; // فرض بر این است که PersianCalendar.php شامل تابع mds_date است
    ?>

    <div class="container py-5">
        <div class="row">
            
            <div class="col-lg-8">
                <h1 class="mb-4 post-title"><?= htmlspecialchars($row['title']) ?></h1>
                
                <p class="text-muted small mb-4 post-meta">
                    <i class="bi bi-calendar-event"></i> منتشر شده در: <?= mds_date('Y/m/d', strtotime($row['created_at'])) ?>
                    <span class="mx-2">|</span>
                    <i class="bi bi-person"></i> نویسنده: نام نویسنده (اختیاری)
                </p>

                <?php if ($row['featured_image']): ?>
                    <div class="mb-4 featured-image-container">
                        <img src="<?= $row['featured_image'] ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="img-fluid rounded shadow-sm">
                    </div>
                <?php endif; ?>

                <div class="content post-content mb-5">
                    <?= $row['content'] ?>
                </div>

                <div class="mt-5 text-center">
                    <a href="./" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-right-short"></i> بازگشت به وبلاگ
                    </a>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                
                <div class="sidebar-box mb-4 p-4 shadow-sm rounded-3">
                    <h5 class="sidebar-title text-primary mb-3 pb-2 border-bottom">
                        <i class="bi bi-clock-history me-2"></i> آخرین مقالات
                    </h5>
                    <ul class="list-unstyled recent-posts-list">
                        <?php if (empty($recent_posts)): ?>
                            <li class="text-muted">مقاله دیگری یافت نشد.</li>
                        <?php else: ?>
                            <?php foreach ($recent_posts as $post): ?>
                                <li class="mb-3 border-bottom pb-3">
                                    <a href="<?= 'blog_post?slug=' . urlencode($post['slug']) ?>" class="text-dark d-block fw-bold text-decoration-none post-link">
                                        <?= htmlspecialchars($post['title']) ?> 
                                    </a>
                                    <span class="text-muted small">
                                        <i class="bi bi-calendar"></i> <?= mds_date('Y/m/d', strtotime($post['created_at'])) ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="sidebar-box mb-4 p-4 shadow-sm rounded-3">
                    <h5 class="sidebar-title text-primary mb-3 pb-2 border-bottom">
                        <i class="bi bi-link-45deg me-2"></i> لینک‌های مرتبط
                    </h5>
                    <div class="list-group important-links-list">
                        <?php foreach ($important_links as $link): ?>
                            <a href="<?= htmlspecialchars($link['url']) ?>" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi <?= htmlspecialchars($link['icon']) ?> me-3 text-secondary"></i>
                                <?= htmlspecialchars($link['title']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
            </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>