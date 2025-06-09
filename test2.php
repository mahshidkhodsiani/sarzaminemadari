/* --- فونت‌ها --- */
@font-face {
  font-family: "Farhang";
  src: url("../fonts/FarhangFamily/Farhang2-Medium.ttf") format("truetype"),
    url("../fonts/woff/Farhang2-Medium.woff") format("woff"),
    url("../fonts/Farhang.ttf") format("truetype");
  font-weight: normal;
  font-style: normal;
}

body,
h1,
h2,
h3,
h4,
h5,
h6,
p,
a,
button,
input,
textarea,
table,
th,
td,
li,
ol,
ul {
  font-family: "Farhang", sans-serif !important; /* !important برای اطمینان از اعمال فونت بعد از بوت استرپ */
}

/* --- متغیرهای اصلی (Root Variables) --- */
:root {
  --primary-color: #2c3e50;
  --secondary-color: #3498db;
  --accent-color: #e74c3c;
  --light-bg: #f8f9fa;
  --dark-text: #2c3e50;
  --light-text: #7f8c8d;
  --border-radius: 12px;
  --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  --transition: all 0.3s ease;
}

/* --- استایل‌های عمومی بدنه (Body General Styles) --- */
body {
  background-color: var(--light-bg);
  color: var(--dark-text);
  line-height: 1.8;
  overflow-x: hidden; /* جلوگیری از اسکرول افقی در کل صفحه */
  direction: rtl; /* تنظیم جهت راست به چپ برای کل صفحه */
  text-align: right; /* متن‌ها به طور پیش‌فرض راست‌چین باشند */
}

/* --- استایل‌های مربوط به کانتینر تور (Tour Container Styles) --- */
.tour-container {
  max-width: 1200px; /* حداکثر عرض کانتینر */
  margin: 40px auto; /* فاصله از بالا و پایین و وسط‌چین کردن افقی */
  padding: 0 15px; /* اضافه کردن پدینگ به کانتینر اصلی */
  box-sizing: border-box;
}

/* --- استایل‌های کارت تور سفارشی (Custom Tour Card Styles) --- */
.custom-card-style {
  background: #fff;
  border-radius: var(--border-radius);
  overflow: hidden;
  box-shadow: var(--box-shadow);
  transition: var(--transition);
  margin-bottom: 20px;
  border: none;
}

.custom-card-style:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

/* --- استایل‌های ستون تصویر (Tour Image Column) --- */
.tour-image-col {
  position: relative;
}

.custom-image-style {
  width: 100%;
  height: 100%;
  object-fit: cover;
  min-height: 400px;
  border-top-right-radius: var(--border-radius);
  border-bottom-right-radius: var(--border-radius);
}

.tour-badge {
  position: absolute;
  top: 20px;
  right: 20px;
  background: var(--accent-color);
  color: white;
  padding: 8px 20px;
  border-radius: 30px;
  font-size: 14px;
  font-weight: bold;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  z-index: 2;
}

/* --- استایل‌های ستون جزئیات (Tour Details Column) --- */
.tour-details-col {
  box-sizing: border-box;
}

.tour-title {
  font-size: 32px;
  font-weight: 900;
  color: var(--primary-color);
  margin-bottom: 15px;
  position: relative;
  padding-bottom: 15px;
}

.tour-title::after {
  content: "";
  position: absolute;
  bottom: 0;
  right: 0;
  width: 80px;
  height: 4px;
  background: var(--secondary-color);
  border-radius: 2px;
}

.tour-meta {
  margin-bottom: 25px;
}

.tour-meta-item {
  color: var(--light-text);
  font-size: 15px;
}

.tour-meta-item i {
  color: var(--secondary-color);
  font-size: 18px;
}

.tour-description {
  font-size: 16px;
  margin: 25px 0;
  line-height: 1.9;
  text-align: right;
  word-wrap: break-word;
  overflow-wrap: break-word;
}

.tour-info {
  background: var(--light-bg);
  border-radius: var(--border-radius);
  padding: 20px;
  margin-top: 30px;
}

.info-row {
  padding: 12px 0;
  border-bottom: 1px dashed #e0e0e0;
}

.info-row:last-child {
  border-bottom: none;
}

.info-label {
  font-weight: bold;
  color: var(--primary-color);
}

.info-value {
  color: var(--dark-text);
  font-weight: 500;
}

/* --- استایل‌های جعبه قیمت (Price Box) --- */
.price-box {
  background: linear-gradient(135deg, var(--secondary-color), #2980b9);
  color: white;
  padding: 25px;
  border-radius: var(--border-radius);
  text-align: center;
  margin-top: 30px;
}

.price-label {
  font-size: 16px;
  margin-bottom: 10px;
  display: block;
}

.price-value {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 15px;
}

.btn-book {
  background: white;
  color: var(--secondary-color);
  border: none;
  padding: 12px 30px;
  border-radius: 30px;
  font-weight: bold;
  font-size: 16px;
  transition: var(--transition);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-book:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  color: var(--primary-color);
}

/* --- استایل‌های گالری بندانگشتی (Gallery Thumbnails) --- */
.gallery-thumbnails {
  display: flex;
  margin-top: 15px;
  overflow-x: auto;
  padding-bottom: 10px;
  justify-content: flex-end;
}

.thumbnail {
  width: 80px;
  height: 60px;
  border-radius: 6px;
  margin-left: 10px;
  cursor: pointer;
  object-fit: cover;
  border: 2px solid transparent;
  transition: var(--transition);
  flex-shrink: 0;
}

.thumbnail:hover {
  border-color: var(--secondary-color);
  transform: scale(1.05);
}

/* --- استایل‌های متفرقه (از CSS قبلی شما) --- */
.pagination {
  justify-content: center;
}

.search-box {
  background: #f8f9fa;
  padding: 20px;
  border-radius: 8px;
  margin-bottom: 30px;
}

.date-inputs {
  display: flex;
  gap: 10px;
}

/* --- استایل‌های جدید برای Navbar --- */
.navbar {
  padding: 1rem 0; /* فاصله از بالا و پایین نوار ناوبری */
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); /* یک سایه کوچک برای زیبایی */
}

.navbar-brand img {
  margin-right: 0; /* برای RTL */
  margin-left: 1rem; /* فاصله لوگو از منو */
}

.navbar-toggler {
  border: none; /* حذف حاشیه دکمه تاگل */
  outline: none !important; /* حذف خط دور دکمه هنگام فوکوس */
  padding: 0.25rem 0.75rem; /* پدینگ استاندارد بوت‌استرپ */
}

.navbar-toggler:focus {
  box-shadow: none; /* حذف سایه فوکوس */
}

.navbar-nav {
  flex-direction: row-reverse; /* آیتم‌های ناوبار از راست به چپ چیده شوند */
  width: 100%; /* برای اینکه justify-content-end کار کنه */
  justify-content: flex-start; /* آیتم‌ها در دسکتاپ به سمت راست (شروع) تراز شوند */
}

.nav-item {
  margin-left: 1.5rem; /* فاصله بین آیتم‌های اصلی ناوبار در دسکتاپ */
}

.nav-link {
  font-weight: bold;
  padding: 0.5rem 0 !important; /* پدینگ برای لینک‌ها */
  /* !important برای override کردن پدینگ پیش‌فرض بوت‌استرپ */
}

.nav-link:hover {
  color: var(--secondary-color) !important;
}

/* استایل دهی برای زیرمنوهای (Dropdown) اصلی */
.dropdown-menu {
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  padding: 10px 0;
  min-width: 180px; /* حداقل عرض برای زیرمنو */
  border: none;
  text-align: right; /* متن‌های زیرمنو راست‌چین باشند */
  right: 0 !important; /* برای RTL، از راست شروع شود */
  left: auto !important; /* از چپ خودکار شود */
}

.dropdown-item {
  padding: 10px 20px;
  font-weight: 500;
  transition: background-color 0.2s ease;
}

.dropdown-item:hover {
  background-color: var(--light-bg);
  color: var(--secondary-color);
}

/* استایل دهی برای زیرمنوهای تو در تو (Submenu Dropdowns) */
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  right: 100%; /* زیرمنو در سمت چپ آیتم والد باز شود (برای RTL) */
  margin-top: -1px;
  margin-right: 0;
  border-radius: var(--border-radius);
}

.dropdown-submenu:hover > .dropdown-menu {
  display: block;
}

/* آیکون فلش برای زیرمنوها در RTL */
.dropdown-toggle::after {
  display: inline-block;
  margin-right: 0.255em; /* فاصله فلش از متن در RTL */
  margin-left: 0;
  vertical-align: 0.255em;
  content: "";
  border-top: 0.3em solid transparent;
  border-right: 0.3em solid transparent;
  border-bottom: 0.3em solid transparent;
  border-left: 0.3em solid; /* فلش به سمت چپ باشد */
}

/* --- استایل‌های ریسپانسیو (Responsive Styles) --- */
@media (max-width: 991.98px) {
  /* برای موبایل و تبلت (lg breakpoint) */
  .tour-image-col,
  .tour-details-col {
    width: 100%;
    max-width: 100%;
  }

  .custom-image-style {
    border-radius: var(--border-radius) var(--border-radius) 0 0;
    min-height: 250px;
  }

  .tour-badge {
    top: 15px;
    right: 15px;
  }

  .tour-title {
    font-size: 26px;
    padding-bottom: 10px;
  }

  .tour-title::after {
    width: 60px;
  }

  .tour-meta {
    flex-direction: column;
    align-items: flex-end; /* برای RTL */
  }

  .tour-meta-item {
    margin-right: 0;
    margin-left: auto; /* برای راست‌چین کردن خود آیتم در کادر والد */
    padding-left: 10px; /* فضای کافی از سمت چپ برای متن */
  }

  .tour-description {
    margin: 20px 0;
    text-align: right;
  }

  .tour-info {
    margin-top: 20px;
    padding: 15px;
  }

  .info-row {
    text-align: right;
  }

  .price-box {
    margin-top: 20px;
    padding: 20px;
  }

  .price-value {
    font-size: 28px;
  }

  .btn-book {
    padding: 10px 25px;
    font-size: 15px;
  }

  .gallery-thumbnails {
    justify-content: flex-start;
  }

  .thumbnail {
    margin-right: 8px;
    margin-left: 0;
  }

  /* --- استایل‌های Navbar در موبایل --- */
  .navbar-nav {
    flex-direction: column; /* آیتم‌های منو زیر هم قرار بگیرند */
    align-items: flex-end; /* آیتم‌ها به سمت راست تراز شوند */
    width: 100%; /* برای اینکه align-items کار کنه */
    margin-top: 1rem;
  }

  .nav-item {
    width: 100%; /* هر آیتم کل عرض را بگیرد */
    text-align: right; /* متن آیتم‌ها راست‌چین شود */
    margin-left: 0;
    margin-bottom: 5px; /* فاصله بین آیتم‌ها */
  }

  .nav-link {
    padding: 0.5rem 1rem !important; /* افزایش پدینگ برای لینک‌ها در موبایل */
  }

  /* زیرمنوهای تو در تو در موبایل */
  .dropdown-menu {
    position: static !important; /* زیرمنو دیگر شناور نباشد */
    display: none; /* به طور پیش‌فرض مخفی باشد */
    float: none; /* شناور نباشد */
    border: none;
    box-shadow: none;
    border-radius: 0;
    margin-top: 0;
    padding-left: 10px; /* کمی تورفتگی برای آیتم‌های زیرمنو */
  }

  .dropdown-menu.show {
    display: block; /* هنگام باز شدن نمایش داده شود */
  }

  .dropdown-submenu > .dropdown-menu {
    right: auto; /* تنظیمات راست و چپ را خنثی کن */
    left: auto;
  }

  /* فلش برای زیرمنوهای تاگل در موبایل */
  .dropdown-toggle::after {
    border-top: 0.3em solid; /* فلش رو به پایین باشد */
    border-right: 0.3em solid transparent;
    border-left: 0.3em solid transparent;
    border-bottom: none;
    transform: rotate(0deg); /* اطمینان از جهت درست فلش */
  }
}

@media (max-width: 767.98px) {
  .tour-details-col {
    padding: 15px;
  }
}

@media (max-width: 575.98px) {
  .tour-title {
    font-size: 22px;
  }

  .price-value {
    font-size: 24px;
  }

  .tour-meta-item {
    font-size: 14px;
  }

  .btn-book {
    padding: 10px 20px;
    font-size: 14px;
  }
}
