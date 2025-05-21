<?php
include 'includes.php';
include '../config.php';

// تنظیم تعداد مقالات در هر صفحه
$limit = 9;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// گرفتن تعداد کل مقالات برای صفحه‌بندی
$total_query = $conn->query("SELECT COUNT(*) AS total FROM blog_posts");
$total_rows = $total_query->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// گرفتن مقالات برای این صفحه
$result = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>وبلاگ | آژانس سرزمین مادری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container py-5">
        <h1 class="text-center mb-5">وبلاگ سرزمین مادری</h1>

        <!-- نمایش مقالات -->
        <div class="row">
            <?php
            $i = 0;
            while ($row = $result->fetch_assoc()):
                $image = !empty($row['featured_image']) ? str_replace('../', '', $row['featured_image']) : null;
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if ($image): ?>
                            <img src="<?= $image ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="text-center py-5 bg-light">بدون تصویر</div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <p class="card-text text-muted small"><?= date('Y/m/d', strtotime($row['created_at'])) ?></p>
                            <p class="card-text"><?= mb_substr(strip_tags($row['content']), 0, 100) ?>...</p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="blog_post.php?slug=<?= urlencode($row['slug']) ?>" class="btn btn-outline-info btn-sm">مطالعه بیشتر</a>
                        </div>
                    </div>
                </div>
            <?php
                $i++;
            endwhile;
            ?>
        </div>

        <!-- صفحه‌بندی -->
        <?php if ($total_pages > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=1">&laquo;&laquo;</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">&laquo;</a>
                        </li>
                    <?php endif; ?>

                    <?php
                    $start = max(1, $page - 2);
                    $end = min($total_pages, $page + 2);
                    for ($i = $start; $i <= $end; $i++):
                    ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">&raquo;</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $total_pages ?>">&raquo;&raquo;</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>