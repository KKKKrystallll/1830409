<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-06 finish buying page,but not generate html tag with function
#TianzhenSun(1830409) 2021-03-06 modify footer
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buying</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/buying.css"/>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/buying.js"></script>
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
            <li><a href="home.php">Home</a></li>
            <li class="active"><a href="buying.php">Buying</a></li>
            <li><a href="orders.php">Orders</a></li>
        </ul>
    </div>

    <form id="buy-form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" autocomplete="off">
        <div class="form-group">
            <label class="form-label"><b>Product code</b></label>
            <div class="">
                <input type="text" name="product_code" class="form-input" maxlength="12" placeholder="Product code" required>
                <span class="star">*</span>
            </div>
            <div class="error">

            </div>
        </div>
        <div class="form-group">
            <label class="form-label"><b>First name</b></label>
            <div class="">
                <input type="text" name="first_name" class="form-input" maxlength="20" placeholder="First name" required>
                <span class="star">*</span>
            </div>
            <div class="error">

            </div>
        </div>
        <div class="form-group">
            <label class="form-label"><b>Last name</b></label>
            <div class="">
                <input type="text" name="last_name" class="form-input" maxlength="20" placeholder="Last name" required>
                <span class="star">*</span>
            </div>
            <div class="error">

            </div>
        </div>
        <div class="form-group">
            <label class="form-label"><b>City</b></label>
            <div class="">
                <input type="text" name="city" class="form-input" maxlength="8" placeholder="City" required>
                <span class="star">*</span>
            </div>
            <div class="error">

            </div>
        </div>
        <div class="form-group">
            <label class="form-label"><b>Comments</b></label>
            <div class="">
                <textarea name="comments" class="form-input" rows="4" maxlength="200" placeholder="Comments(0-200)"></textarea>
            </div>
            <div class="error">

            </div>
        </div>
        <div class="form-group">
            <label class="form-label"><b>Price</b></label>
            <div class="">
                <input type="text" name="price" class="form-input" placeholder="Price" required>
                <span class="star">*</span>
            </div>
            <div class="error">

            </div>
        </div>
        <div class="form-group">
            <label class="form-label"><b>Quantity</b></label>
            <div class="">
                <input type="number" name="quantity" class="form-input" min="1" max="99" placeholder="Quantity" required>
                <span class="star">*</span>
            </div>
            <div class="error">

            </div>
        </div>

        <div class="form-group-center">
            <button type="submit" class="form-btn">Submit</button>
        </div>
    </form>


</div>
<div class="footer">
    <p>Copyright TianzhenSun (1830409) 2022.</p>
</div>
</body>
</html>