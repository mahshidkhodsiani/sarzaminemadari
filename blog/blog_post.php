<?php
include 'includes.php';
include '../config.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

if (empty($slug)) {
    die('مقاله‌ای پیدا نشد.');
}

// جستجوی مقاله بر اساس اسلاگ
$stmt = $conn->prepare("SELECT * FROM blog_posts WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('مقاله‌ای با این آدرس پیدا نشد.');
}

$row = $result->fetch_assoc();
// $image = !empty($row['featured_image']) ? str_replace('../', '', $row['featured_image']) : null;

// echo $image;
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($row['title']) ?> | وبلاگ سرزمین مادری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container py-5">
        <h1 class="text-center mb-4"><?= htmlspecialchars($row['title']) ?></h1>
        <p class="text-muted text-center small"><?= date('Y/m/d', strtotime($row['created_at'])) ?></p>

        <?php if ($row['featured_image']): ?>
            <div class="text-center mb-4">
                <img src="<?= $row['featured_image'] ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
            </div>
        <?php endif; ?>

        <div class="content" style="line-height: 2; font-size: 1.1rem;">
            <?= $row['content'] ?>
        </div>

        <div class="mt-5 text-center">
            <a href="./" class="btn btn-outline-secondary">بازگشت به وبلاگ</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>