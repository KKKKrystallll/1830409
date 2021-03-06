<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-06 finish buying page,but not generate html tag with function
#TianzhenSun(1830409) 2021-03-06 modify footer
#TianzhenSun(1830409) 2021-03-06 use function to generate html tag
#

require_once '../library/init.php';
if (!empty($_POST)) {
    //the post data
    $productCode = htmlspecialchars($_POST['product_code']);
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $city = htmlspecialchars($_POST['city']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $comments = htmlspecialchars($_POST['comments']);

    //subtotal
    $subtotal = $price * $quantity;
    // taxes amount
    $taxesAmount = $subtotal * LOCAL_TAXES;
    // grand total
    $grandTotal = $subtotal + $taxesAmount;

    //keep 2 digits
    $price = number_format($price, 2);
    $subtotal = number_format(round($subtotal, 2), 2);
    $taxesAmount = number_format(round($taxesAmount, 2), 2);
    $grandTotal = number_format(round($grandTotal, 2), 2);

    //the final data that should save
    $data = [
        'ProductID' => $productCode,
        'FirstName' => $firstName,
        'LastName' => $lastName,
        'City' => $city,
        'Price' => $price,
        'Quantity' => $quantity,
        'Comments' => $comments,
        'Subtotal' => $subtotal,
        'TaxesAmount' => $taxesAmount,
        'GrandTotal' => $grandTotal,
    ];

    //save data, don't forget \n
    file_put_contents(PURCHASES_FILE, json_encode($data, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND);

    //give a tip when success
    echo '<script>alert("Submit success");</script>';
}

writeHeader();
?>

<?php writeDocumentType()?>
<?php writeHtmlStart();?>
<?php writeHead('Buying', ['../css/style.css', '../css/buying.css'], ['../js/jquery.min.js', '../js/buying.js']);?>
<?php writeBodyStart();?>
<?php writeHtmlCommonTagStart('div', ['class' => 'content']);?>
<?php writeLogo();?>
<?php writeNav(1);?>


<?php
$formAttributes = [
    'id' => 'buy-form',
    'method' => 'post',
    'action' => $_SERVER['PHP_SELF'],
    'autocomplete' => 'off',
];

$formItems = [
    [
        'label' => 'Product code',
        'tag' => 'input',
        'attributes' => [
            'type' => 'text',
            'name' => 'product_code',
            'class' => 'form-input',
            'maxlength' => '12',
            'placeholder' => 'Product code',
            'required',
        ]
    ],
    [
        'label' => 'First name',
        'tag' => 'input',
        'attributes' => [
            'type' => 'text',

            'name' => 'first_name',
            'class' => 'form-input',
            'maxlength' => '20',
            'placeholder' => 'First name',
            'required',
        ]
    ],
    [
        'label' => 'Last name',
        'tag' => 'input',
        'attributes' => [
            'type' => 'text',

            'name' => 'last_name',
            'class' => 'form-input',
            'maxlength' => '20',
            'placeholder' => 'Last name',
            'required',
        ]
    ],
    [
        'label' => 'City',
        'tag' => 'input',
        'attributes' => [
            'type' => 'text',

            'name' => 'city',
            'class' => 'form-input',
            'maxlength' => '8',
            'placeholder' => 'City',
            'required',
        ]
    ],
    [
        'label' => 'Comments',
        'tag' => 'textarea',
        'attributes' => [
            'type' => 'textarea',

            'name' => 'comments',
            'class' => 'form-input',
            'maxlength' => '200',
            'placeholder' => 'Comments(0-200)',
            'rows' => '4',
        ]
    ],
    [
        'label' => 'Price',
        'tag' => 'input',
        'attributes' => [
            'type' => 'text',

            'name' => 'price',
            'class' => 'form-input',
            'placeholder' => 'Price',
        ]
    ],
    [
        'label' => 'Quantity',
        'tag' => 'input',
        'attributes' => [
            'type' => 'number',

            'name' => 'quantity',
            'min' => 1,
            'max' => 99,
            'class' => 'form-input',
            'placeholder' => 'Quantity',
        ]
    ],

];
writeForm($formAttributes, $formItems);?>

<?php writeHtmlCommonTagEnd('div', 'content');?>
<!--.footer start-->
<?php writeFooter();?>

<!--.footer end-->


<?php writeBodyClose();?>
<?php writeHtmlClose();?>

