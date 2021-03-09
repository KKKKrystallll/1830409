<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-06 finish logo and nav
#TianzhenSun(1830409) 2021-03-06 add advertise
#TianzhenSun(1830409) 2021-03-06 use function to generate html tag
#TianzhenSun(1830409) 2021-03-09 modify advertise section
#
require_once '../library/init.php';


writeHeader();
?>
<?php writeDocumentType()?>
<?php writeHtmlStart();?>


<?php writeHead('Home', ['../css/style.css', '../css/home.css'], ['../js/jquery.min.js', '../js/home.js']);?>


<?php writeBodyStart();?>
<?php writeHtmlCommonTagStart('div', ['class' => 'content']);?>
<?php writeLogo();?>
<?php writeNav();?>

<!--.product start-->
<?php writeAdvertises();?>
<!--.product end-->

<?php writeHtmlCommonTagEnd('div', 'content');?>
<!--.footer start-->
<?php writeFooter();?>

<!--.footer end-->


<?php writeBodyClose();?>
<?php writeHtmlClose();?>

