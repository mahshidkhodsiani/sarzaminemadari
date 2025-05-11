<?php
session_start();

if (!isset($_SESSION['all_data'])) {
    header('Location: login.php');
    exit;
}

$all_data = $_SESSION['all_data'];

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پنل کاربری</title>

    <?php include 'includes.php'; ?>
    <link rel="stylesheet" href="styles.css">




    <link type="text/css" rel="stylesheet" href="css/persianDatepicker.css" />
    <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="js/persianDatepicker.min.js"></script>
</head>

<body>
    <!-- دکمه همبرگر برای موبایل -->
    <button class="sidebar-toggle d-md-none" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>

            <!-- Main content -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
                <nav class="navbar navbar-expand navbar-light bg-white shadow-sm rounded mb-4">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">🌟 خوش آمدید!</a>
                    </div>
                </nav>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">داشبورد</h5>
                        <p class="card-text">به پنل ادمین خوش آمدید. از منوی سمت راست برای دسترسی به بخش‌های مختلف استفاده کنید.</p>
                    </div>
                </div>


                <input type="text" id="input1" />
                <span id="span1"></span>
            </main>
        </div>
    </div>


    <script type="text/javascript">
        $(function() {
            $("#input1, #span1").persianDatepicker();
        });



        $("#input1").persianDatepicker({
            months: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
            dowTitle: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه"],
            shortDowTitle: ["ش", "ی", "د", "س", "چ", "پ", "ج"],
            showGregorianDate: !1,
            persianNumbers: !0,
            formatDate: "YYYY/MM/DD",
            selectedBefore: !1,
            selectedDate: null,
            startDate: null,
            endDate: null,
            prevArrow: '\u25c4',
            nextArrow: '\u25ba',
            theme: 'default',
            alwaysShow: !1,
            selectableYears: null,
            selectableMonths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
            cellWidth: 25, // by px
            cellHeight: 20, // by px
            fontSize: 13, // by px                
            isRTL: !1,
            calendarPosition: {
                x: 0,
                y: 0,
            },
            onShow: function() {},
            onHide: function() {},
            onSelect: function() {},
            onRender: function() {}
        });
    </script>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('sidebar-mobile-show');

            // اضافه کردن overlay هنگام نمایش سایدبار
            if (sidebar.classList.contains('sidebar-mobile-show')) {
                createOverlay();
            } else {
                removeOverlay();
            }
        }

        function createOverlay() {
            const overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            overlay.onclick = function() {
                toggleSidebar();
            };
            document.body.appendChild(overlay);
        }

        function removeOverlay() {
            const overlay = document.querySelector('.sidebar-overlay');
            if (overlay) {
                overlay.remove();
            }
        }

        // بستن سایدبار هنگام تغییر سایز صفحه
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const sidebar = document.querySelector('.sidebar');
                sidebar.classList.remove('sidebar-mobile-show');
                removeOverlay();
            }
        });
    </script>
</body>

</html>