<?php
require_once(__DIR__."/../../includes/functions.php");
require_once(__DIR__."/../../includes/student.php");
session_start();
if (!isset($_SESSION['loggedin'])) redirect_to("../notallowed.html");
include("header_admin.php");

$students = Student::find_all();


$studentsdata = "";

foreach ($students as $student) {
  $name = "{$student->firstname} {$student->middlename} {$student->lastname}";
  $l1mark = $student->l1mark == NULL ? "-" : $student->l1mark;
  $l2mark = $student->l2mark == NULL ? "-" : $student->l2mark;
  $l3mark = $student->l3mark == NULL ? "-" : $student->l3mark;
  $l1PreMark = $student->l1PreMark == NULL ? "-" : $student->l1PreMark;
  $l2PreMark = $student->l2PreMark == NULL ? "-" : $student->l2PreMark;
  $l3PreMark = $student->l3PreMark == NULL ? "-" : $student->l3PreMark;
  $studentsdata .= 
    "<tr>
       <td>{$name}</td>
       <td>{$l1PreMark}</td><td>{$l1mark}</td>
       <td>{$l2PreMark}</td><td>{$l2mark}</td>
       <td>{$l3PreMark}</td><td>{$l3mark}</td>
       <td><a href='studentUpdate.php?uuid={$student->uuid}'>تعديل</a></td>
     <tr>";
}

$output = <<<OP
<table class="stable">
  <tr>
    <th rowspan="2">اسم الطالب</th>
    <th colspan="2">الدرس الأول</th>
    <th colspan="2">الدرس الثاني</th>
    <th colspan="2">الدرس الثالث</th>
    <th rowspan="2"></th>
  </tr>
  <tr>
    <th class="subth">الاختبار القبلي</th>
    <th class="subth">الاختبار البعدي</th>
    <th class="subth">الاختبار القبلي</th>
    <th class="subth">الاختبار البعدي</th>
    <th class="subth">الاختبار القبلي</th>
    <th class="subth">الاختبار البعدي</th>
  <tr>
  {$studentsdata}
</table>
OP;
echo $output;
include("../layouts/footer.php");
?>