<?php
// شروع سشن (اگر قبلاً شروع نشده باشد)
session_start();

// پاک کردن تمام داده‌های سشن
$_SESSION = array();


// نابود کردن سشن
session_destroy();

// هدایت به صفحه لاگین
header("Location: ../login.php");
exit();
?>