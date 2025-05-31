<?php
session_start();

if (!isset($_SESSION['all_data'])) {
    header('Location: login.php');
    exit;
}

$all_data = $_SESSION['all_data'];
$id = $all_data['id'];

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پنل مدیریت - افزودن مقاله جدید</title>

    <?php include 'includes.php'; ?>
    <link rel="stylesheet" href="styles.css">


    <link href="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.js"></script>




</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        افزودن مقاله جدید
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="" method="POST">
                            <!-- عنوان مقاله -->
                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان مقاله *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <!-- slug -->
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug (نامک) *</label>
                                <input type="text" class="form-control" id="slug" name="slug" required>
                                <small class="text-muted">این فیلد به صورت خودکار از عنوان مقاله ایجاد می‌شود</small>
                            </div>

                            <!-- محتوای مقاله -->
                            <!-- <div class="mb-4">
                                <label for="content" class="form-label">محتوای مقاله *</label>
                                <textarea id="content" name="content"></textarea>
                            </div> -->


                            <textarea id="editor" name="content"></textarea>
                            <script>
                                const editor = new Jodit('#editor', {
                                    removeButtons: ['source'],
                                    language: 'fa',
                                    height: 500,

                                });
                            </script>




                            <!-- تصویر شاخص -->
                            <div class="mb-3">
                                <label for="featured_image" class="form-label">تصویر شاخص</label>
                                <input class="form-control" type="file" id="featured_image" name="featured_image" accept="image/*">
                                <small class="text-muted">فرمت‌های مجاز: JPG, PNG, GIF - حداکثر حجم: 2MB</small>
                            </div>


                            <!-- وضعیت -->
                            <div class="mb-3">
                                <label for="status" class="form-label">وضعیت انتشار *</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="published">منتشر شده</option>
                                    <option value="draft">پیش‌نویس</option>
                                    <option value="pending">در انتظار بررسی</option>
                                </select>
                            </div>

                            <!-- متا تگ‌ها -->
                            <div class="card mt-4 mb-4">
                                <div class="card-header bg-light">
                                    تنظیمات سئو
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">عنوان متا</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title">
                                        <small class="text-muted">حداکثر 60 کاراکتر</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">توضیحات متا</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="2"></textarea>
                                        <small class="text-muted">حداکثر 160 کاراکتر</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label">کلمات کلیدی متا</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords">
                                        <small class="text-muted">کلمات را با کاما جدا کنید</small>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <button name="submit" class="btn btn-info">ذخیره مقاله</button>
                            <br>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // ایجاد خودکار slug از عنوان
            $('#title').on('input', function() {
                const title = $(this).val();
                const slug = title.replace(/[^\u0600-\u06FFa-zA-Z0-9\s]/g, '')
                    .replace(/\s+/g, '-')
                    .toLowerCase();
                $('#slug').val(slug);
            });
        });
    </script>


    <script>
        $('form').submit(function() {
            $('#editor').val(editor.getEditorValue()); // انتقال محتوا به textarea
        });
    </script>
</body>

</html>

<?php
include "../config.php";

if (isset($_POST['submit'])) {
    // دریافت مقادیر از فرم
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];

    var_dump($content);
    // $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    // $content = $conn->real_escape_string($content);
    $status = $_POST['status'];
    $meta_title = $_POST['meta_title'] ?? '';
    $meta_description = $_POST['meta_description'] ?? '';
    $meta_keywords = $_POST['meta_keywords'] ?? '';
    $featured_image_path = '';
    $current_date = date('Y-m-d H:i:s');

    // اعتبارسنجی اولیه
    if (empty($title) || empty($slug) || empty($content)) {
        die("لطفا تمام فیلدهای الزامی را پر کنید");
    }

    // ذخیره اطلاعات مقاله در دیتابیس
    $sql = "INSERT INTO blog_posts 
            (title, slug, content, featured_image, status, 
             created_at, updated_at, meta_title, meta_description, meta_keywords, author_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, $id)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("خطا در آماده‌سازی query: " . $conn->error);
    }

    // پردازش تصویر شاخص
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['featured_image'];
        $upload_dir = "../uploads/blog/";

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $file_name = uniqid() . '.' . $file_extension;
        $temp_path = $upload_dir . $file_name;

        if (move_uploaded_file($image['tmp_name'], $temp_path)) {
            $featured_image_path = $temp_path;
        }
    }

    // بعد از اجرای کوئری و گرفتن ID پست، پوشه ایجاد شده و تصویر منتقل می‌شود
    if ($stmt->bind_param("ssssssssss", $title, $slug, $content, $featured_image_path, $status, $current_date, $current_date, $meta_title, $meta_description, $meta_keywords) && $stmt->execute()) {
        $post_id = $stmt->insert_id;

        // اگر تصویر آپلود شده بود، آن را به پوشه با ID پست منتقل می‌کنیم
        if (!empty($featured_image_path)) {
            $new_upload_dir = "../uploads/blog/" . $post_id . "/";
            if (!file_exists($new_upload_dir)) {
                mkdir($new_upload_dir, 0755, true);
            }

            $new_path = $new_upload_dir . $file_name;
            rename($featured_image_path, $new_path);

            // آپدیت مسیر تصویر در دیتابیس
            $update_sql = "UPDATE blog_posts SET featured_image = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $new_path, $post_id);
            $update_stmt->execute();
            $update_stmt->close();
        }

        echo "<div id='successToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' data-delay='3000' style='position: fixed; top: 20px; right: 20px; width: 300px; z-index: 1055;'>
            <div class='toast-header bg-success text-white'>
                <strong class='mr-auto'>موفقیت</strong>
            </div>
            <div class='toast-body'>
                مقاله با موفقیت ذخیره شد!
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#successToast').toast({
                    autohide: true,
                    delay: 3000
                }).toast('show');
                setTimeout(function(){
                    window.location.href = 'add_post';
                }, 3000);
            });
        </script>";
    } else {
        // اگر خطایی رخ داد، تصویر آپلود شده را پاک کنید
        if (!empty($featured_image_path) && file_exists($featured_image_path)) {
            unlink($featured_image_path);
        }

        echo "<div id='errorToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' data-delay='3000' style='position: fixed; top: 20px; right: 20px; width: 300px; z-index: 1055;'>
            <div class='toast-header bg-danger text-white'>
                <strong class='mr-auto'>خطا</strong>
            </div>
            <div class='toast-body'>
                خطایی در ذخیره مقاله رخ داد!<br>Error: " . htmlspecialchars($stmt->error) . "
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#errorToast').toast({
                    autohide: true,
                    delay: 3000
                }).toast('show');
            });
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>