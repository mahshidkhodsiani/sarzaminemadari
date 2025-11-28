<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منوی ناوبار</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        .navbar {
            background: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 0.5rem 2rem;
        }

        .navbar-brand img {
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        /* استایل آیتم‌های منو */
        .navbar-nav .nav-item {
            margin: 0 8px;
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            font-size: 15px;
            color: #2c3e50 !important;
            padding: 10px 16px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-nav .nav-link i {
            font-size: 18px;
        }

        .navbar-nav .nav-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        /* استایل Dropdown */
        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            padding: 12px 0;
            margin-top: 8px;
            min-width: 220px;
        }

        .dropdown-item {
            font-weight: 500;
            font-size: 14px;
            padding: 10px 20px;
            color: #2c3e50;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item i {
            font-size: 16px;
            width: 20px;
            color: #667eea;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            color: #667eea;
            padding-right: 25px;
        }

        /* منوهای چندسطحی */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu > .dropdown-menu {
            top: 0;
            right: 100%;
            margin-right: -1px;
        }

        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }

        .dropdown-arrow {
            margin-right: auto;
            transition: transform 0.3s ease;
        }

        .dropdown-submenu:hover .dropdown-arrow {
            transform: translateX(-3px);
        }

        /* رنگ‌های مختلف برای بخش‌های مختلف */
        .nav-item:nth-child(1) .nav-link:hover { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .nav-item:nth-child(2) .nav-link:hover { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .nav-item:nth-child(3) .nav-link:hover { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .nav-item:nth-child(4) .nav-link:hover { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
        .nav-item:nth-child(5) .nav-link:hover { background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); }
        .nav-item:nth-child(6) .nav-link:hover { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); }

        /* ریسپانسیو */
        @media (max-width: 991px) {
            .navbar-nav {
                padding: 15px 0;
            }
            
            .dropdown-submenu > .dropdown-menu {
                position: static;
                margin-right: 15px;
                box-shadow: none;
                border-right: 2px solid #667eea;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="./" class="navbar-brand">
        <img src="img/logo.png" width="70px" height="70px" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">

            <!-- بلیط -->
            <li class="nav-item">
                <a href="ticket" class="nav-link">
                    <i class="fas fa-ticket-alt"></i>
                    بلیط
                </a>
            </li>

            <!-- هتل -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-hotel"></i>
                    هتل
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-end">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                            <i class="fas fa-map-marker-alt"></i>
                            داخلی
                            <span class="dropdown-arrow">◄</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-island-tropical"></i>کیش</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-island-tropical"></i>قشم</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-mosque"></i>مشهد</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                            <i class="fas fa-globe-americas"></i>
                            خارجی
                            <span class="dropdown-arrow">◄</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-flag"></i>ترکیه</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-flag"></i>امارات</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-flag"></i>ارمنستان</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-flag"></i>گرجستان</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-flag"></i>تایلند</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!-- تورها -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-plane-departure"></i>
                    تورها
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-end">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                            <i class="fas fa-map-marker-alt"></i>
                            داخلی
                            <span class="dropdown-arrow">◄</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-island-tropical"></i>کیش</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-island-tropical"></i>قشم</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-mosque"></i>مشهد</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                            <i class="fas fa-globe-americas"></i>
                            خارجی
                            <span class="dropdown-arrow">◄</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                    <i class="fas fa-flag"></i>
                                    ترکیه
                                    <span class="dropdown-arrow">◄</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>وان</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>فتحیه</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>استانبول</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>ازمیر</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>آنتالیا</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>کوشی آداسی</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                    <i class="fas fa-flag"></i>
                                    امارات
                                    <span class="dropdown-arrow">◄</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>دوبی</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                    <i class="fas fa-flag"></i>
                                    ارمنستان
                                    <span class="dropdown-arrow">◄</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>ایروان</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                    <i class="fas fa-flag"></i>
                                    گرجستان
                                    <span class="dropdown-arrow">◄</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>تفلیس</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>باتومی</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                    <i class="fas fa-flag"></i>
                                    تایلند
                                    <span class="dropdown-arrow">◄</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>پوکت</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>پاتایا</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>بانگوک</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>ترکیبی</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                    <i class="fas fa-flag"></i>
                                    هند
                                    <span class="dropdown-arrow">◄</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>آگرا</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>جیپور</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>دهلی</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>بمبئی</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                    <i class="fas fa-flag"></i>
                                    روسیه
                                    <span class="dropdown-arrow">◄</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>سن پترزبورگ</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>مسکو</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                    <i class="fas fa-flag"></i>
                                    عتبات
                                    <span class="dropdown-arrow">◄</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>نجف</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>کربلا</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-city"></i>اربیل</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!-- تورهای نمایشگاهی -->
            <li class="nav-item">
                <a class="nav-link" href="e_tours">
                    <i class="fas fa-building"></i>
                    تورهای نمایشگاهی
                </a>
            </li>

            <!-- خدمات -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-concierge-bell"></i>
                    خدمات
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-passport"></i>ویزا</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-shield-alt"></i>بیمه</a></li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">
                            <i class="fas fa-star"></i>
                            خدمات vip
                            <span class="dropdown-arrow">◄</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-tie"></i>لیدر و مترجم محلی</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-train"></i>قطار و پرواز بین شهری</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!-- سرزمین ما -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-info-circle"></i>
                    سرزمین ما
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-end">
                    <li><a class="dropdown-item" href="blog"><i class="fas fa-newspaper"></i>مجله</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-users"></i>درباره ما</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-bullhorn"></i>اخبار</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-bell"></i>اطلاعیه ها</a></li>
                </ul>
            </li>

        </ul>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // فعال‌سازی منوهای چندسطحی
    document.querySelectorAll('.dropdown-submenu > a').forEach(function(element) {
        element.addEventListener('click', function(e) {
            var submenu = this.nextElementSibling;
            if (submenu) {
                e.preventDefault();
                e.stopPropagation();
                
                // بستن سایر زیرمنوها
                var otherSubmenus = this.closest('.dropdown-menu').querySelectorAll('.dropdown-menu');
                otherSubmenus.forEach(function(menu) {
                    if (menu !== submenu) {
                        menu.style.display = 'none';
                    }
                });
                
                // تغییر وضعیت نمایش
                if (submenu.style.display === 'block') {
                    submenu.style.display = 'none';
                } else {
                    submenu.style.display = 'block';
                }
            }
        });
    });
</script>

</body>
</html>