<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ادیتور پیشرفته</title>
  <style>
    .editor-container {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      max-width: 800px;
      margin: 20px auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      overflow: hidden;
    }

    .toolbar {
      background-color: #f5f5f5;
      padding: 10px;
      border-bottom: 1px solid #ddd;
      display: flex;
      flex-wrap: wrap;
      gap: 5px;
    }

    .toolbar button {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 3px;
      padding: 5px 10px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .toolbar button:hover {
      background: #e9e9e9;
    }

    .editor {
      min-height: 300px;
      padding: 15px;
      border: 1px solid #ddd;
      outline: none;
    }

    .image-modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 5px;
      width: 80%;
      max-width: 500px;
    }
  </style>
</head>

<body>
  <div class="editor-container">
    <div class="toolbar">
      <button onclick="formatText('bold')"><b>B</b></button>
      <button onclick="formatText('italic')"><i>I</i></button>
      <button onclick="formatText('underline')"><u>U</u></button>
      <button onclick="insertHeading()">عنوان</button>
      <button onclick="createLink()">لینک</button>
      <button onclick="showImageModal()">تصویر</button>
      <button onclick="insertList('ul')">لیست نقطه‌ای</button>
      <button onclick="insertList('ol')">لیست شماره‌ای</button>
      <button onclick="alignText('right')">راست</button>
      <button onclick="alignText('center')">وسط</button>
      <button onclick="alignText('left')">چپ</button>
    </div>

    <div id="editor" class="editor" contenteditable="true"></div>
    <textarea id="hiddenContent" name="content" style="display:none;"></textarea>
  </div>

  <div id="imageModal" class="image-modal">
    <div class="modal-content">
      <h3>درج تصویر</h3>
      <input type="file" id="imageUpload" accept="image/*">
      <p>یا آدرس تصویر:</p>
      <input type="text" id="imageUrl" placeholder="https://example.com/image.jpg">
      <button onclick="insertImage()">درج تصویر</button>
      <button onclick="hideImageModal()">انصراف</button>
    </div>
  </div>

  <script>
    // ذخیره محتوا قبل از ارسال فرم
    function prepareContent() {
      document.getElementById('hiddenContent').value = document.getElementById('editor').innerHTML;
      return true;
    }

    // فرمت‌دهی متن
    function formatText(format) {
      document.execCommand(format, false, null);
      document.getElementById('editor').focus();
    }

    // درج عنوان
    function insertHeading() {
      const selection = window.getSelection();
      if (selection.rangeCount) {
        const range = selection.getRangeAt(0);
        const heading = document.createElement('h2');
        heading.textContent = range.toString();
        range.deleteContents();
        range.insertNode(heading);
      }
    }

    // ایجاد لینک
    function createLink() {
      const url = prompt('آدرس لینک را وارد کنید:', 'http://');
      if (url) {
        document.execCommand('createLink', false, url);
      }
    }

    // مدیریت پنجره تصویر
    function showImageModal() {
      document.getElementById('imageModal').style.display = 'flex';
    }

    function hideImageModal() {
      document.getElementById('imageModal').style.display = 'none';
    }

    // درج تصویر
    function insertImage() {
      const urlInput = document.getElementById('imageUrl');
      const fileInput = document.getElementById('imageUpload');

      if (fileInput.files.length > 0) {
        // آپلود تصویر (در اینجا باید کد آپلود به سرور را اضافه کنید)
        alert('در حال توسعه: این بخش برای آپلود تصاویر به سرور نیاز دارد');
      } else if (urlInput.value) {
        const img = document.createElement('img');
        img.src = urlInput.value;
        img.style.maxWidth = '100%';
        insertAtCursor(img);
        hideImageModal();
      } else {
        alert('لطفاً یک تصویر انتخاب کنید یا آدرس آن را وارد نمایید');
      }
    }

    // درج در محل کرسر
    function insertAtCursor(node) {
      const selection = window.getSelection();
      if (selection.rangeCount) {
        const range = selection.getRangeAt(0);
        range.deleteContents();
        range.insertNode(node);
      } else {
        document.getElementById('editor').appendChild(node);
      }
      document.getElementById('editor').focus();
    }

    // درج لیست
    function insertList(type) {
      document.execCommand(type === 'ul' ? 'insertUnorderedList' : 'insertOrderedList');
    }

    // تراز متن
    function alignText(align) {
      document.execCommand('justify' + align.charAt(0).toUpperCase() + align.slice(1));
    }
  </script>
</body>

</html>