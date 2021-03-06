<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-06 finish orders page except cheat sheet
#TianzhenSun(1830409) 2021-03-06 add cheat sheet download link
#TianzhenSun(1830409) 2021-03-06 modify footer
#TianzhenSun(1830409) 2021-03-06 use function to generate html tag
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

//format the data, so that can use writeTable() function
$orderList = [];
foreach ($list as $item) {
    $orderOne = [];
    foreach ($item as $key => $value) {
        $class = '';
        $unit = '';
        //Subtotal is special
        if ($key === 'Subtotal') {
            if ($value < 100.00) {
                $class = 'less';
            } else if ($value >= 100 && $value <=  999.99) {
                $class = 'between';
            } else {
                $class = 'more';
            }
        }

        //field about money should have unit
        if (in_array($key, ['Price', 'Subtotal', 'TaxesAmount', 'GrandTotal'], true)) {
            $unit = '$';
        }


        $orderOne[$key] = [
            'value' => $value . $unit,
            'class' => $class,
        ];
    }

    $orderList[] = $orderOne;
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

writeHeader();
?>

<?php writeDocumentType()?>
<?php writeHtmlStart();?>
<?php writeHead('Orders', ['../css/style.css', '../css/orders.css']);?>
<?php writeHtmlCommonTagStart('body', ['class' => $bodyClass]);?>
<?php writeHtmlCommonTagStart('div', ['class' => 'content']);?>
<?php writeLogo();?>
<?php writeNav(2);?>

<?php writeHtmlCommonTagStart('div', ['class' => 'cheatsheet']);?>
<?php writeHtmlCommonTagStart('a', ['href' => '../data/cheatsheet.txt', 'download' => 'cheatsheet.txt']);?>
    cheat sheet
<?php writeHtmlCommonTagEnd('a');?>
<?php writeHtmlCommonTagEnd('div', 'cheatsheet');?>

<?php
$heads = [
    ['title' => 'Product ID', 'column' => 'ProductID'],
    ['title' => 'First name', 'column' => 'FirstName'],
    ['title' => 'Last name', 'column' => 'LastName'],
    ['title' => 'City', 'column' => 'City'],
    ['title' => 'Comments', 'column' => 'Comments'],
    ['title' => 'Price', 'column' => 'Price'],
    ['title' => 'Quantity', 'column' => 'Quantity'],
    ['title' => 'Subtotal', 'column' => 'Subtotal'],
    ['title' => 'Taxes', 'column' => 'TaxesAmount'],
    ['title' => 'Grand Total', 'column' => 'GrandTotal'],
];
writeTable(['id' => 'orders-table'], $heads, $orderList);
?>
<?php writeHtmlCommonTagEnd('div', 'content');?>
<!--.footer start-->
<?php writeFooter();?>

<!--.footer end-->


<?php writeBodyClose();?>
<?php writeHtmlClose();?>