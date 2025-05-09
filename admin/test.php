<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>تقویم فارسی</title>
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@2.0.1/dist/js/persian-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@2.0.1/dist/css/persian-datepicker.min.css">
</head>
<body>
    <input type="text" id="persianDatePicker" placeholder="تاریخ را انتخاب کنید...">

    <script>
        $(document).ready(function() {
            $("#persianDatePicker").pDatepicker({
                format: 'YYYY/MM/DD',
                autoClose: true,
                initialValue: false,
                calendarType: 'persian',
                toolbox: {
                    enabled: true,
                    calendarSwitch: {
                        enabled: true,
                        format: 'YYYY/MM/DD'
                    }
                }
            });
        });
    </script>
</body>
</html>