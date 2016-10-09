<?php
require_once(__DIR__."/../../includes/functions.php");
require_once(__DIR__."/../../includes/student.php");
session_start();
if (!isset($_SESSION['loggedin'])) redirect_to("../notallowed.html");
include("header_admin.php");
$msgConfirmSt = "";
$br = "";

$student = new Student(Student::find_by_id($_GET['uuid']));

if (isset($_POST['update'])) {
  $student->firstname = $database->escape_value($_POST['firstname']);
  $student->middlename = $database->escape_value($_POST['middlename']);
  $student->lastname = $database->escape_value($_POST['lastname']);
  $student->l1PreMark = $_POST['l1PreMark'] == "" ? NULL : $database->escape_value($_POST['l1PreMark']);
  $student->l1mark = $_POST['l1mark'] == "" ? NULL : $database->escape_value($_POST['l1mark']);
  $student->l2PreMark = $_POST['l2PreMark'] == "" ? NULL : $database->escape_value($_POST['l2PreMark']);
  $student->l2mark = $_POST['l2mark'] == "" ? NULL : $database->escape_value($_POST['l2mark']);
  $student->l3PreMark = $_POST['l3PreMark'] == "" ? NULL : $database->escape_value($_POST['l3PreMark']);
  $student->l3mark = $_POST['l3mark'] == "" ? NULL : $database->escape_value($_POST['l3mark']);
  $student->update();
  $msgConfirmSt = "تم تحديث بيانات الطالب بنجاح";
  $br = "<br>";
}

if (isset($_POST['delete'])) {
  $database->query("DELETE FROM users WHERE uuid='{$student->uuid}'");
  redirect_to("students_progress.php");
}

$output = <<<FRM
  <div class="frm">
    <form action="studentUpdate.php?uuid={$student->uuid}" method="POST">
      <fieldset>
        <legend>تعديل بيانات ودرجات طالب</legend>
        <span class="confirm">{$msgConfirmSt}</span>{$br}
        <div class="frmrow">
        <div class="frmfields">
        اسم الطالب: 
        <input type="text" name="firstname" value="{$student->firstname}" required>
        </div>
        <div class="frmfields">
        اسم الأب: 
        <input type="text" name="middlename" value="{$student->middlename}" required>
        </div>
        <div class="frmfields">
        اسم الجد / اللقب: 
        <input type="text" name="lastname" value="{$student->lastname}" required>
        </div>
        </div>
        <br>
        <div class="frmrow">
        <fieldset class="frmfields marks">
          <legend>درجات الدرس الأول</legend>
          درجة الاختبار القبلي: <br>
          <input type="text" name="l1PreMark" size="4" value="{$student->l1PreMark}"><br>
          درجة الاختبار البعدي: <br>
          <input type="text" name="l1mark" size="4" value="{$student->l1mark}"><br>
        </fieldset>
        <fieldset class="frmfields marks">
          <legend>درجات الدرس الثاني</legend>
          درجة الاختبار القبلي: <br>
          <input type="text" name="l2PreMark" size="4" value="{$student->l2PreMark}"><br>
          درجة الاختبار البعدي: <br>
          <input type="text" name="l2mark" size="4" value="{$student->l2mark}"><br>
        </fieldset>
        <fieldset class="frmfields marks">
          <legend>درجات الدرس الثالث</legend>
          درجة الاختبار القبلي: <br>
          <input type="text" name="l3PreMark" size="4" value="{$student->l3PreMark}"><br>
          درجة الاختبار البعدي: <br>
          <input type="text" name="l3mark" size="4" value="{$student->l3mark}"><br>
        </fieldset>
        </div>
        <br>
        <div dir="ltr">
        <button class="warning" name="update" type="submit">تحديث البيانات</button>
        <button class="danger" name="delete" type="submit" onclick="return deletestudent()">حذف سجل الطالب</button>
        </div>
      </fieldset>
    </form>
  </div>
  <script>
    deletestudent = function () {
      return confirm("هل أنت واثق أنك تريد حذف سجل الطالب من قاعدة البيانات؟ لا يمكن الرجوع في هذا القرار.");
    }
  </script>
FRM;
echo $output;
include("../layouts/footer.php");
?>