<?php
header("refresh:300;url=waiting_act.html");
require_once(__DIR__."/../includes/functions.php");
require_once(__DIR__."/../includes/student.php");

if (!isset($_GET['uuid'])) redirect_to("notallowed.html");

include("layouts/header_reg.php");

$student = Student::find_by_id($_GET['uuid']);

if (!$student) {
  redirect_to("notregistered.php");
}

$allowed_types = array("docx", "doc", "txt", "rtf", "odt");
$uuid = $_GET['uuid'];
$student = new Student($uuid);
$msgConfirm ="";
$msgErr = "";
$br = "";

if (isset($_POST['l1activity'])) {
  $upload_ok = 0;
  $target_dir = "uploads/";
  $act_num = $_POST['l1activity'];
  $filename = basename($_FILES["upfile"]["name"]);
  $extension =  pathinfo($filename, PATHINFO_EXTENSION);
  if (in_array($extension, $allowed_types)) {
    $filename = base64_encode($filename);
    $target_file_pfx = $target_dir . $act_num . $uuid . "_";
    $target_file = $target_file_pfx . $filename;
    $upload_ok = 1;
    $file_exists = glob($target_file_pfx . "*");
    if ($file_exists) {
      unlink($file_exists[0]);
    }
  } else {
    $msgErr = "نوع ملف غير مسموح " . $extension;
  }    
  
  if ($upload_ok == 1) {
    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $target_file)) {
        $msgConfirm = "تم رفع الملف  ". basename( $_FILES["upfile"]["name"]). " بنجاح.";
        $msgConfirm .= "ان كنت انتهيت من تحميل الملفات من فضلك <a href='waiting_act.html'>اضغط هنا لتسجيل الخروج.</a>";
        $student->$act_num = $filename;
        $student->update();
    } else {
        $msgErr = "لم نتمكن من رفع الملف.";
    }
  }
}

if (isset($_POST['l2activity'])) {
  $upload_ok = 0;
  $target_dir = "uploads/";
  $act_num = $_POST['l2activity'];
  $filename = basename($_FILES["upfile"]["name"]);
  $extension =  pathinfo($filename, PATHINFO_EXTENSION);
  if (in_array($extension, $allowed_types)) {
    $filename = base64_encode($filename);
    $target_file_pfx = $target_dir . $act_num . $uuid . "_";
    $target_file = $target_file_pfx . $filename;
    $upload_ok = 1;
    $file_exists = glob($target_file_pfx . "*");
    if ($file_exists) {
      unlink($file_exists[0]);
    }
  } else {
    $msgErr = "نوع ملف غير مسموح " . $extension;
  }    
  
  if ($upload_ok == 1) {
    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $target_file)) {
        $msgConfirm = "تم رفع الملف  ". basename( $_FILES["upfile"]["name"]). " بنجاح.";
        $msgConfirm .= "ان كنت انتهيت من تحميل الملفات من فضلك <a href='waiting_act.html'>اضغط هنا لتسجيل الخروج.</a>";
        $student->$act_num = $filename;
        $student->update();
    } else {
        $msgErr = "لم نتمكن من رفع الملف.";
    }
  }
}

if (isset($_POST['l3activity'])) {
  $upload_ok = 0;
  $target_dir = "uploads/";
  $act_num = $_POST['l3activity'];
  $filename = basename($_FILES["upfile"]["name"]);
  $extension =  pathinfo($filename, PATHINFO_EXTENSION);
  if (in_array($extension, $allowed_types)) {
    $filename = base64_encode($filename);
    $target_file_pfx = $target_dir . $act_num . $uuid . "_";
    $target_file = $target_file_pfx . $filename;
    $upload_ok = 1;
    $file_exists = glob($target_file_pfx . "*");
    if ($file_exists) {
      unlink($file_exists[0]);
    }
  } else {
    $msgErr = "نوع ملف غير مسموح " . $extension;
  }    
  
  if ($upload_ok == 1) {
    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $target_file)) {
        $msgConfirm = "تم رفع الملف  ". basename( $_FILES["upfile"]["name"]). " بنجاح.";
        $msgConfirm .= "ان كنت انتهيت من تحميل الملفات من فضلك <a href='waiting_act.html'>اضغط هنا لتسجيل الخروج.</a>";
        $student->$act_num = $filename;
        $student->update();
    } else {
        $msgErr = "لم نتمكن من رفع الملف.";
    }
  }
}

$output = <<<FRM
  <h3>أهلا {$student->firstname} {$student->middlename} </h3>
  <h4><span style="color: red">لست {$student->firstname} {$student->middlename}؟</span> من فضلك اضغط على لوحة المفاتيح بالأسفل لتحميل اشتراكك.</h4>
  <span class="confirm" style="font-size: large;">{$msgConfirm}</span>{$br}
  <span class="err">{$msgErr}</span>{$br}
  <div class="frm">
    <form action="activities.php?uuid={$uuid}" method="POST" enctype="multipart/form-data">
      <fieldset>
        <legend>تسليم نشاط خاص بالدرس الأول</legend>
        من فضلك اضغط على الزر لاختيار الملف من جهازك<br>
        واختر النشاط من قائمة الأنشطة<br>
        ثم اضغط زر التسليم: <br><br>
        <input type="file" name="upfile" required>
        <select name="l1activity" required>
          <option disabled selected>اختر النشاط من القائمة</option>
          <option value="l1act1">نشاط 1 - المدى الحراري</option>
          <option value="l1act2">نشاط 2 - فصل الصيف</option>
          <option value="l1act3">نشاط 3 - مشكلة السيول</option>
        </select><br><br>
        <div dir="ltr">
        <button class="warning" type="submit">اضغط لتسليم النشاط</button>
        </div>
      </fieldset>
    </form>
    
    <form action="activities.php?uuid={$uuid}" method="POST" enctype="multipart/form-data">
      <fieldset>
        <legend>تسليم نشاط خاص بالدرس الثاني</legend>
        من فضلك اضغط على الزر لاختيار الملف من جهازك<br>
        واختر النشاط من قائمة الأنشطة<br>
        ثم اضغط زر التسليم: <br><br>
        <input type="file" name="upfile" required>
        <select name="l2activity" required>
          <option disabled selected>اختر النشاط من القائمة</option>
          <option value="l2act1">نشاط 1 - الأقاليم المناخية</option>
          <option value="l2act2">نشاط 2 - الاحتباس الحراري</option>
          <option value="l2act3">نشاط 3 - التغيرات المناخية</option>
        </select><br><br>
        <div dir="ltr">
        <button class="warning" type="submit">اضغط لتسليم النشاط</button>
        </div>
      </fieldset>
    </form>
    
    <form action="activities.php?uuid={$uuid}" method="POST" enctype="multipart/form-data">
      <fieldset>
        <legend>تسليم نشاط خاص بالدرس الثالث</legend>
        من فضلك اضغط على الزر لاختيار الملف من جهازك<br>
        واختر النشاط من قائمة الأنشطة<br>
        ثم اضغط زر التسليم: <br><br>
        <input type="file" name="upfile" required>
        <select name="l3activity" required>
          <option disabled selected>اختر النشاط من القائمة</option>
          <option value="l3act1">نشاط 1 - صور حيوانات برية</option>
          <option value="l3act2">نشاط 2 - جبل علبة</option>
          <option value="l3act3">نشاط 3 - الاحتباس الحراري والشعب المرجانية</option>
          <option value="l3act4">نشاط 4 - المحميات الطبيعية</option>
        </select><br><br>
        <div dir="ltr">
        <button class="warning" type="submit">اضغط لتسليم النشاط</button>
        </div>
      </fieldset>
    </form>
  </div>
FRM;
echo $output;
include("layouts/footer.php");
?>