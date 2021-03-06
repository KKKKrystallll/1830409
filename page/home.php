<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-06 finish logo and nav
#TianzhenSun(1830409) 2021-03-06 add advertise
#
require_once '../library/init.php';
$products = require '../data/products.php';

$randProductNo = rand(0, count($products) - 1);
$bigAd = $products[$randProductNo];

$twiceProduct = $products[0];
$normalProducts = array_slice($products, 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/home.css"/>
</head>
<body>
<div class="content">
    <div class="header">
        <div class="logo">
            <img src="../images/logo.jpg"/>
        </div>
        <div class="company">
            <p class="name">
                LWKK
            </p>
            <p class="description">
                The company is committed to bring convenience to people's life,
                mainly research and sale of various portable tableware,
                so that people can also use their own clean tableware when traveling.
            </p>

        </div>
    </div>
    <div class="nav">
        <ul>
            <li class="active"><a href="home.php">Home</a></li>
            <li><a href="buying.php">Buying</a></li>
            <li><a href="orders.php">Orders</a></li>
        </ul>
    </div>
    <div class="product">
        <h2>Advertising</h2>
        <div class="big">
            <div>
                <a href="//www.google.com"><img src="<?php echo $bigAd['image'];?>"/></a>
            </div>
            <div class="description">
                write some description. write some description. write some description. write some description.
                write some description. write some description.
            </div>
        </div>
        <hr class="seperator"/>
        <div class="list">
            <div class="twice">
                <a href="//www.google.com"><img src="<?php echo $twiceProduct['image'];?>"/></a>
                <div class="info">
                    <div><?php echo $twiceProduct['name'];?></div>
                    <div>$<?php echo $twiceProduct['price'];?></div>
                </div>
            </div>
            <?php foreach ($normalProducts as $item):?>
                <div class="normal">
                    <a href="//www.google.com"><img src="<?php echo $item['image'];?>"/></a>
                    <div class="info">
                        <div><?php echo $item['name'];?></div>
                        <div>$<?php echo $item['price'];?></div>
                    </div>
                </div>
            <?php endforeach;?>

        </div>

    </div>
</div>
<div class="footer">
    <p>Copyright TianzhenSun (1830409) 2022.</p>
</div>
</body>
</html>
