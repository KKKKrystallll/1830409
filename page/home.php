<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-06 finish logo and nav
#TianzhenSun(1830409) 2021-03-06 add advertise
#TianzhenSun(1830409) 2021-03-06 use function to generate html tag
#
require_once '../library/init.php';
//products list
$products = require '../data/products.php';

//rand a product for ad
$randProductNo = rand(0, count($products) - 1);
$bigAd = $products[$randProductNo];

//the first product is twice price
$twiceProduct = $products[0];
//normal price
$normalProducts = array_slice($products, 1);

writeHeader();
?>
<?php writeDocumentType()?>
<?php writeHtmlStart();?>


<?php writeHead('Home', ['../css/style.css', '../css/home.css']);?>


<?php writeBodyStart();?>
<?php writeHtmlCommonTagStart('div', ['class' => 'content']);?>
<?php writeLogo();?>
<?php writeNav();?>

<!--.product start-->
<?php writeHtmlCommonTagStart('div', ['class' => 'product']);?>
<?php writeHtmlCommonTagStart('h2');?>
Advertising
<?php writeHtmlCommonTagEnd('h2');?>

<!--Advertising start-->
<?php writeHtmlCommonTagStart('div', ['class' => 'big']);?>
<?php writeHtmlCommonTagStart('div');?>
<?php writeHtmlCommonTagStart('a', ['href' => '//www.google.com']);?>
<?php writeHtmlCommonTagStart('img', ['src' => $bigAd['image']], false);?>
<?php writeHtmlCommonTagEnd('a');?>
<?php writeHtmlCommonTagEnd('div');?>

<?php writeHtmlCommonTagStart('div', ['class' => 'description']);?>
write some description. write some description. write some description. write some description.
write some description. write some description.
<?php writeHtmlCommonTagEnd('div', 'description');?>


<?php writeHtmlCommonTagEnd('div', 'big');?>
<!--Advertising end-->

<?php writeHtmlCommonTagStart('hr', ['class' => 'seperator'], false);?>

<?php writeHtmlCommonTagStart('div', ['class' => 'list']);?>
<?php writeHtmlCommonTagStart('div', ['class' => 'twice']);?>
<?php writeHtmlCommonTagStart('a', ['href' => '//www.google.com']);?>
<?php writeHtmlCommonTagStart('img', ['src' => $twiceProduct['image']], false);?>
<?php writeHtmlCommonTagEnd('a');?>

<?php writeHtmlCommonTagStart('div', ['class' => 'info']);?>
<?php writeHtmlCommonTagStart('div');?>
<?php echo $twiceProduct['name'];?>
<?php writeHtmlCommonTagEnd('div');?>
<?php writeHtmlCommonTagStart('div');?>
$<?php echo $twiceProduct['price'];?>
<?php writeHtmlCommonTagEnd('div');?>

<?php writeHtmlCommonTagEnd('div', 'info');?>

<?php writeHtmlCommonTagEnd('div', 'twice');?>


<?php foreach ($normalProducts as $item):?>
    <?php writeHtmlCommonTagStart('div', ['class' => 'normal']);?>

    <?php writeHtmlCommonTagStart('a', ['href' => '//www.google.com']);?>
    <?php writeHtmlCommonTagStart('img', ['src' => $item['image']], false);?>
    <?php writeHtmlCommonTagEnd('a');?>

    <?php writeHtmlCommonTagStart('div', ['class' => 'info']);?>
    <?php writeHtmlCommonTagStart('div');?>
    <?php echo $item['name'];?>
    <?php writeHtmlCommonTagEnd('div');?>
    <?php writeHtmlCommonTagStart('div');?>
    $<?php echo $item['price'];?>
    <?php writeHtmlCommonTagEnd('div');?>

    <?php writeHtmlCommonTagEnd('div', 'info');?>

    <?php writeHtmlCommonTagEnd('div', 'normal');?>

<?php endforeach;?>
<!--products list end-->

<?php writeHtmlCommonTagEnd('div', 'list');?>
<?php writeHtmlCommonTagEnd('div', 'product');?>
<!--.product end-->

<?php writeHtmlCommonTagEnd('div', 'content');?>
<!--.footer start-->
<?php writeFooter();?>

<!--.footer end-->


<?php writeBodyClose();?>
<?php writeHtmlClose();?>

