<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تورهای نمایشگاهی | آژانس سرزمین مادری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="styles.css">

    <?php
    include 'includes.php';
    include '../config.php';

    // تنظیمات صفحه‌بندی
    $rows_per_page = 9;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $rows_per_page;

    // پردازش فرم جستجو
    $search_conditions = [];
    $search_params = [];

    if (isset($_GET['search'])) {
        if (!empty($_GET['title'])) {
            $search_conditions[] = "title LIKE ?";
            $search_params[] = '%' . $_GET['title'] . '%';
        }
        if (!empty($_GET['country_fa'])) {
            $search_conditions[] = "country_fa LIKE ?";
            $search_params[] = '%' . $_GET['country_fa'] . '%';
        }
        if (!empty($_GET['city_fa'])) {
            $search_conditions[] = "city_fa LIKE ?";
            $search_params[] = '%' . $_GET['city_fa'] . '%';
        }
        if (!empty($_GET['date_en'])) {
            $search_conditions[] = "date_en = ?";
            $search_params[] = $_GET['date_en'];
        }
    }

    $where_clause = '';
    if (!empty($search_conditions)) {
        $where_clause = 'WHERE ' . implode(' AND ', $search_conditions);
    }

    // گرفتن تعداد کل رکوردها
    $count_sql = "SELECT COUNT(*) as total FROM exhibition_tours $where_clause";
    $count_stmt = $conn->prepare($count_sql);

    if (!empty($search_params)) {
        $types = str_repeat('s', count($search_params));
        $count_stmt->bind_param($types, ...$search_params);
    }

    $count_stmt->execute();
    $total_rows = $count_stmt->get_result()->fetch_assoc()['total'];
    $total_pages = ceil($total_rows / $rows_per_page);

    // گرفتن داده‌های تورها
    $sql = "SELECT * FROM exhibition_tours $where_clause ORDER BY id DESC LIMIT ?, ?";
    $stmt = $conn->prepare($sql);

    if (!empty($search_params)) {
        $types = str_repeat('s', count($search_params)) . 'ii';
        $params = array_merge($search_params, [$offset, $rows_per_page]);
        $stmt->bind_param($types, ...$params);
    } else {
        $stmt->bind_param('ii', $offset, $rows_per_page);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    ?>


</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container py-5">
        <h1 class="text-center mb-5">تورهای نمایشگاهی</h1>

        <!-- فرم جستجو -->
        <div class="search-box">
            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="title" class="form-label">نام تور</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="<?= isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '' ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="country_fa" class="form-label">کشور</label>
                        <input type="text" class="form-control" id="country_fa" name="country_fa"
                            value="<?= isset($_GET['country_fa']) ? htmlspecialchars($_GET['country_fa']) : '' ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="city_fa" class="form-label">شهر</label>
                        <input type="text" class="form-control" id="city_fa" name="city_fa"
                            value="<?= isset($_GET['city_fa']) ? htmlspecialchars($_GET['city_fa']) : '' ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="date_en" class="form-label">تاریخ (میلادی)</label>
                        <input type="date" class="form-control" id="date_en" name="date_en"
                            value="<?= isset($_GET['date_en']) ? htmlspecialchars($_GET['date_en']) : '' ?>">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" name="search" class="btn btn-primary">جستجو</button>
                    <a href="?" class="btn btn-secondary">پاک کردن فیلترها</a>
                </div>
            </form>
        </div>

        <!-- نمایش تورها -->
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="tour-card">
                            <img src="<?= htmlspecialchars($row['tour_image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="tour-img mb-3">
                            <h3><?= htmlspecialchars($row['title']) ?></h3>
                            <p><strong>کشور:</strong> <?= htmlspecialchars($row['country_fa']) ?></p>
                            <p><strong>شهر:</strong> <?= htmlspecialchars($row['city_fa']) ?></p>
                            <p><strong>تاریخ میلادی:</strong> <?= htmlspecialchars($row['date_en']) ?></p>
                            <p><strong>تاریخ شمسی:</strong> <?= htmlspecialchars($row['date_fa']) ?></p>
                            <p><strong>قیمت:</strong> <?= number_format($row['price']) ?> تومان</p>
                            <a href="tour-details.php?idt=<?= $row['id']?>" class="btn btn-warning w-100">دیدن تور</a>
                            
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">تور نمایشگاهی یافت نشد</div>
                </div>
            <?php endif; ?>
        </div>


        <!-- صفحه‌بندی -->
        <?php if ($total_pages > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>" aria-label="First">
                                <span aria-hidden="true">&laquo;&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php
                    $start = max(1, $page - 2);
                    $end = min($total_pages, $page + 2);

                    if ($start > 1): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>

                    <?php for ($i = $start; $i <= $end; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($end < $total_pages): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $total_pages])) ?>" aria-label="Last">
                                <span aria-hidden="true">&raquo;&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>

    <?php include 'footer.php'; ?>
</body>

</html>