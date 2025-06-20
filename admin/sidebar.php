<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="sidebar">
    <div class="text-center mb-4">
        <h5>👤 پنل کاربری</h5>
    </div>
    <a href="./" class="<?= $currentPage === 'index.php' ? 'active' : '' ?>">
        <i class="bi bi-house-door"></i> داشبورد
    </a>
    <a href="requests.php" class="<?= $currentPage === 'requests.php' ? 'active' : '' ?>">
        <i class="bi bi-arrow-up-square"></i> درخواست تورها
    </a>
    <a href="exhibition_tours.php" class="<?= $currentPage === 'exhibition_tours.php' ? 'active' : '' ?>">
        <i class="bi bi-airplane"></i> افزودن تور نمایشگاهی
    </a>
    <a href="add_tour.php" class="<?= $currentPage === 'add_tour.php' ? 'active' : '' ?>">
        <i class="bi bi-airplane-fill"></i> افزودن تور مسافرتی
    </a>
    <a href="add_post.php" class="<?= $currentPage === 'add_post.php' ? 'active' : '' ?>">
        <i class="bi bi-book"></i> افزودن مقاله جدید
    </a>

    <a href="#"><i class="bi bi-gear"></i> تنظیمات</a>
    <a href="logout.php">
        <i class="bi bi-box-arrow-right"></i> خروج
    </a>
</nav>