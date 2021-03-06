<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-06 finish orders page except cheat sheet
#TianzhenSun(1830409) 2021-03-06 add cheat sheet download link
#TianzhenSun(1830409) 2021-03-06 modify footer
#

require_once '../library/init.php';
//open purchase.txt
$fp = @fopen(PURCHASES_FILE, 'r');


//all orders
$list = [];
// open success
if (false !== $fp) {
    //read file one by one
    while(!feof($fp)) {
        $row = fgets($fp);

        //pay attention to last \n
        if (trim($row) !== '') {
            //convert json string to array
            $list[] = json_decode($row, true);
        }
    }

    //close file
    fclose($fp);
}

$command = isset($_GET['command']) ? $_GET['command'] : '';
$bodyClass = '';
switch ($command) {
    case 'print':
        $bodyClass = 'print';
        break;

    case 'color':
        $bodyClass = 'color';
        break;

    default:
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/orders.css"/>
    <style>

    </style>
</head>
<body class="<?php echo $bodyClass;?>">
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
            <li><a href="home.php">Home</a></li>
            <li><a href="buying.php">Buying</a></li>
            <li class="active"><a href="orders.php">Orders</a></li>
        </ul>
    </div>

    <div class="cheatsheet">
        <a href="../data/cheatsheet.txt" download="cheatsheet.txt">cheat sheet</a>
    </div>
    <table id="orders-table">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>City</th>
            <th>Comments</th>
            <th>Price</th>
            <th>Quantity</th>
            <th class="subtotal">Subtotal</th>
            <th>Taxes</th>
            <th>Grand total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $item):?>
        <tr>
            <td><?php echo $item['ProductID'];?></td>
            <td><?php echo $item['FirstName'];?></td>
            <td><?php echo $item['LastName'];?></td>
            <td><?php echo $item['City'];?></td>
            <td><?php echo $item['Comments'];?></td>
            <td><?php echo $item['Price'] . '$';?></td>
            <td><?php echo $item['Quantity'];?></td>
            <?php
            $subtotalClass = '';
            if ($item['Subtotal'] < 100.00) {
                $subtotalClass = 'less';
            } else if ($item['Subtotal'] >= 100 && $item['Subtotal'] <=  999.99) {
                $subtotalClass = 'between';
            } else {
                $subtotalClass = 'more';
            }

            ?>

            <td class="subtotal <?php echo $subtotalClass;?>"><?php echo $item['Subtotal'] . '$';?></td>
            <td><?php echo $item['TaxesAmount'] . '$';?></td>
            <td><?php echo $item['GrandTotal'] . '$';?></td>

        </tr>
        <?php endforeach;?>
        </tbody>
    </table>


</div>
<div class="footer">
    <p>Copyright TianzhenSun (1830409) 2022.</p>
</div>
</body>
</html>