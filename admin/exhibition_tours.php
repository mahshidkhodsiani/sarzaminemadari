<?php
include 'includes.php';
include '../config.php';

function createSlug($text)
{
    // تبدیل حروف فارسی و ایجاد slug
    $text = str_replace(['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'], ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], $text);
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $text;
}

if (isset($_GET['slug'])) {
    $slug = mysqli_real_escape_string($conn, $_GET['slug']);
    $result = mysqli_query($conn, "SELECT * FROM exhibition_tours WHERE slug = '$slug'");

    if ($row = mysqli_fetch_assoc($result)) {
?>
        <!DOCTYPE html>
        <html lang="fa" dir="rtl">

        <head>
            <meta charset="UTF-8">
            <title><?= htmlspecialchars($row['title']) ?> | آژانس سرزمین مادری</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?php include 'includes.php'; ?>
            <style>
                body {
                    background-color: #f9f9f9;
                    font-family: 'Vazirmatn', sans-serif;
                }

                .tour-card {
                    background: #fff;
                    border-radius: 20px;
                    overflow: hidden;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                    margin-top: 40px;
                }

                /* بقیه استایل‌ها... */
            </style>
        </head>

        <body>

            <?php include 'header.php'; ?>

            <div class="container">
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
            </div>

        </body>

        </html>
<?php
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "<div class='alert alert-danger mt-5'>تور مورد نظر پیدا نشد.</div>";
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    echo "<div class='alert alert-warning mt-5'>آدرس تور نامعتبر است.</div>";
}
?>