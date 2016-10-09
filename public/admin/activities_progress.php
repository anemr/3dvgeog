<?php
require_once(__DIR__."/../../includes/functions.php");
require_once(__DIR__."/../../includes/student.php");
session_start();
if (!isset($_SESSION['loggedin'])) redirect_to("../notallowed.html");
include("header_admin.php");

$students = Student::find_all();


$studentsdata = "";
$l1act = "";
$l2act = "";
$l3act = "";

foreach ($students as $student) {
  $name = "{$student->firstname} {$student->middlename} {$student->lastname}";
  $l1act1 = $student->l1act1 == NULL ? "-" : "<a href='../uploads/l1act1" . $student->uuid . "_" . $student->l1act1 . "' download='" . base64_decode($student->l1act1) . "'>" . base64_decode($student->l1act1) . "</a>";
  $l1act2 = $student->l1act2 == NULL ? "-" : "<a href='../uploads/l1act2" . $student->uuid . "_" . $student->l1act2 . "' download='" . base64_decode($student->l1act2) . "'>" . base64_decode($student->l1act2) . "</a>";
  $l1act3 = $student->l1act3 == NULL ? "-" : "<a href='../uploads/l1act3" . $student->uuid ."_" .  $student->l1act3 . "' download='" . base64_decode($student->l1act3) . "'>" . base64_decode($student->l1act3) . "</a>";
  $l2act1 = $student->l2act1 == NULL ? "-" : "<a href='../uploads/l2act1" . $student->uuid . "_" . $student->l2act1 . "' download='" . base64_decode($student->l2act1) . "'>" . base64_decode($student->l2act1) . "</a>";
  $l2act2 = $student->l2act2 == NULL ? "-" : "<a href='../uploads/l2act2" . $student->uuid . "_" . $student->l2act2 . "' download='" . base64_decode($student->l2act2) . "'>" . base64_decode($student->l2act2) . "</a>";
  $l2act3 = $student->l2act3 == NULL ? "-" : "<a href='../uploads/l2act3" . $student->uuid . "_" . $student->l2act3 . "' download='" . base64_decode($student->l2act3) . "'>" . base64_decode($student->l2act3) . "</a>";
  $l3act1 = $student->l3act1 == NULL ? "-" : "<a href='../uploads/l3act1" . $student->uuid . "_" . $student->l3act1 . "' download='" . base64_decode($student->l3act1) . "'>" . base64_decode($student->l3act1) . "</a>";
  $l3act2 = $student->l3act2 == NULL ? "-" : "<a href='../uploads/l3act2" . $student->uuid . "_" . $student->l3act2 . "' download='" . base64_decode($student->l3act2) . "'>" . base64_decode($student->l3act2) . "</a>";
  $l3act3 = $student->l3act3 == NULL ? "-" : "<a href='../uploads/l3act3" . $student->uuid . "_" . $student->l3act3 . "' download='" . base64_decode($student->l3act3) . "'>" . base64_decode($student->l3act3) . "</a>";
  $l3act4 = $student->l3act4 == NULL ? "-" : "<a href='../uploads/l3act4" . $student->uuid . "_" . $student->l3act4 . "' download='" . base64_decode($student->l3act4) . "'>" . base64_decode($student->l3act4) . "</a>";
  
  $l1act = <<<l1act
نشاط 1 - المدى الحراري: {$l1act1}<br>نشاط 2 - فصل الصيف: {$l1act2}<br>نشاط 3 - مشكلة السيول: {$l1act3}
l1act;

  $l2act = <<<l2act
نشاط 1 - الأقاليم المناخية: {$l2act1}<br>
نشاط 2 - الاحتباس الحراري: {$l2act2}<br>
نشاط 3 - التغيرات المناخية: {$l2act3}
l2act;

  $l3act = <<<l3act
نشاط 1 - صور حيوانات برية: {$l3act1}<br>
نشاط 2 - جبل علبة: {$l3act2}<br>
نشاط 3 - الاحتباس الحراري والشعب المرجانية: {$l3act3}<br>
نشاط 4 - المحميات الطبيعية: {$l3act4}
l3act;
  
  $studentsdata .= 
    "<tr style='font-size:small'>
       <td>{$name}</td>
       <td>
        {$l1act}
       </td>
       <td>
        {$l2act}
       </td>
       <td>
        {$l3act}
       </td>
     <tr>";
}

$output = <<<OP
<table class="stable">
  <tr>
    <th>اسم الطالب</th>
    <th>أنشطة الدرس الأول</th>
    <th>أنشطة الدرس الثاني</th>
    <th>أنشطة الدرس الثالث</th>
  </tr>
  {$studentsdata}
</table>
OP;
echo $output;
include("../layouts/footer.php");
?>