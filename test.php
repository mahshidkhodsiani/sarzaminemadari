<!DOCTYPE html>
<html lang="fa">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تاریخ شمسی</title>

  <!-- Moment Core -->
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

  <!-- Moment Jalaali -->
  <script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js"></script>
</head>

<body>
  <form method="post" action="save.php">
    <input type="hidden" name="shamsi_date" id="shamsi_date">
    <button type="submit">ارسال</button>
  </form>

  <script>
    document.querySelector("form").addEventListener("submit", function () {
      let today = moment().locale('fa').format('jYYYY/jMM/jDD');
      document.getElementById("shamsi_date").value = today;
    });

    // فقط جهت تست در Console
    let m = moment().locale('fa').format('jYYYY/jMM/jDD');
    console.log("تاریخ شمسی:", m);

    let dateMiladi = moment.from('1403/02/20', 'fa', 'jYYYY/jMM/jDD').format('YYYY-MM-DD');
    console.log("تاریخ معادل میلادی:", dateMiladi);
  </script>
</body>

</html>
