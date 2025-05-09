<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پنل مدیریت - افزودن تور نمایشگاهی</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 1rem;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1rem;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .active-link {
            background-color: rgb(25, 51, 135);
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar">
                <h5 class="text-white text-center">پنل ادمین</h5>
                <a href="#" class="active-link">افزودن تور</a>
                <a href="#">لیست تورها</a>
                <a href="#">تنظیمات</a>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        افزودن تور نمایشگاهی
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان تور</label>
                                <input type="text" class="form-control" id="title" placeholder="مثلاً نمایشگاه کتاب تهران">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">توضیحات</label>
                                <textarea class="form-control" id="description" rows="4" placeholder="توضیحاتی درباره تور بنویسید..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">مکان برگزاری</label>
                                <input type="text" class="form-control" id="location" placeholder="مثلاً نمایشگاه بین‌المللی تهران">
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">تاریخ</label>
                                <input type="date" class="form-control" id="date">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">تصویر تور</label>
                                <input class="form-control" type="file" id="image">
                            </div>
                            <button type="submit" class="btn btn-info">ذخیره تور</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>