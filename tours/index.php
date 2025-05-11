<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نمایش تور | آژانس سرزمین مادری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    include 'includes.php';
    include '../config.php';
    ?>

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Vazirmatn', sans-serif;
        }
        .tour-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-top: 40px;
        }
        .tour-header img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .tour-body {
            padding: 30px;
        }
        .tour-title {
            font-size: 28px;
            font-weight: bold;
            color: #0d6efd;
        }
        .tour-description {
            font-size: 18px;
            margin-top: 20px;
            line-height: 2;
        }
        .tour-info {
            margin-top: 25px;
            font-size: 16px;
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
        .badge-category {
            background: #0d6efd;
            color: white;
            padding: 5px 15px;
            border-radius: 25px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <?php
    if (isset($_GET['id_tour'])) {
        $id_tour = intval($_GET['id_tour']);
        $result = mysqli_query($conn, "SELECT * FROM exhibition_tours WHERE id = $id_tour");
        if ($row = mysqli_fetch_assoc($result)) {
    ?>

    <div class="tour-card">
        <div class="tour-header">
            <img src="<?= htmlspecialchars($row['tour_image']) ?>" alt="عکس تور">
        </div>
        <div class="tour-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="tour-title"><?= htmlspecialchars($row['title']) ?></h1>
                <span class="badge-category"><?= htmlspecialchars($row['category']) ?></span>
            </div>

            <div class="tour-description">
                <?= nl2br($row['description']) ?>
            </div>

            <div class="tour-info row mt-4">
                <div class="col-md-6">
                    <p><span class="info-label">تاریخ شمسی:</span> <?= htmlspecialchars($row['date_fa']) ?></p>
                    <p><span class="info-label">تاریخ میلادی:</span> <?= htmlspecialchars($row['date_en']) ?></p>
                    <p><span class="info-label">کشور:</span> <?= htmlspecialchars($row['country_fa']) ?> (<?= htmlspecialchars($row['country_en']) ?>)</p>
                    <p><span class="info-label">شهر:</span> <?= htmlspecialchars($row['city_fa']) ?> (<?= htmlspecialchars($row['city_en']) ?>)</p>
                </div>
                <div class="col-md-6">
                    <p><span class="info-label">شروع نرخ تور:</span> <?= number_format($row['price']) ?> تومان</p>
                </div>
            </div>
        </div>
    </div>

    <?php
        } else {
            echo "<div class='alert alert-danger mt-5'>تور مورد نظر پیدا نشد.</div>";
        }
    } else {
        echo "<div class='alert alert-warning mt-5'>شناسه تور ارسال نشده است.</div>";
    }
    ?>
</div>

</body>
</html>
