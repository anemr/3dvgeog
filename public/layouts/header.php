<?php
$output = <<<HD
<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' rel='stylesheet' type='text/css'>
    <link href="stylesheets/style.css" type="text/css" rel="stylesheet">
    <title>المناخ والحياة النباتية والحيوانية في مصر</title>
  </head>

  <body>
    
    <div class="bg">
  
    <header>
      <nav>
          
        <a href="index.php" class="brand">المناخ والحياة النباتية والحيوانية في مصر</a>
          
        <ul class="nav">
          <li>
            <a href="#">الدرس الأول - المناخ في مصر</a>
            <ul class="subnav">
              <li><a href="lesson1_1.php">أولًا : العوامل المؤثرة في مناخ مصر</a></li>
              <li><a href="lesson1_2.php">ثانيًا : مناخ مصر خلال فصول العام</a></li>
            </ul>
          </li>

          <li>
            <a href="#">الدرس الثاني - الأقاليم المناخية في مصر</a>
            <ul class="subnav">
              <li><a href="lesson2_1.php">أولًا : الأقاليم المناخية في مصر</a></li>
              <li><a href="lesson2_2.php">ثانيًا : التأثيرات المتوقعة نتيجة التغيرات المناخية</a></li>
            </ul>
          </li>
          
          <li>
            <a href="#">الدرس الثالث - النبات الطبيعي والحيوان البري في مصر</a>
            <ul class="subnav">
              <li><a href="lesson3_1.php">أولًا : النبات الطبيعي والحيوان البري في مصر</a></li>
              <li><a href="lesson3_2.php">ثانيًا : حماية الحياة الطبيعية في مصر</a></li>
            </ul>
          </li>
        </ul>
          
      </nav>
    </header>

    <main>
      <div class="container">
HD;
echo $output;
?>