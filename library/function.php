<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-06 create some common function
#TianzhenSun(1830409) 2021-03-09 add many comments
#

function writeDocumentType() {
    echo '<!DOCTYPE html>';
}

function writeHtmlStart() {
    echo '<html lang="en">';
}

function writeHtmlClose() {
    echo '</html>';
}

function writeBodyStart() {
    echo '<body>';
}

function writeBodyClose() {
    echo '</body>';
}

//write the head tag
function writeHead($title = '', $cssFiles = [], $jsFiles = []){
    writeTitle($title);
    writeHtmlMeta();
    writeCssFiles($cssFiles);
    writeJsFiles($jsFiles);
}

//write css file
function writeCssFiles($cssFiles = []){
    foreach ($cssFiles as $cssFile) {
        echo "<link rel=\"stylesheet\" href=\"{$cssFile}\"/>";
    }
}

//write js file
function writeJsFiles($jsFiles = []){
    foreach ($jsFiles as $jsFile) {
        echo "<script src=\"{$jsFile}\"></script>";
    }
}

//the html meta,about cache control and charset
function writeHtmlMeta() {
    echo '<meta charset="UTF-8"><meta http-equiv="Expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Cache" content="no-cache">';
}

//write logo
function writeLogo(){
    echo '<div class="header">
        <div class="logo">
            <img src="../images/logo.jpg"/>
        </div>
        <div class="company">
            <p class="name">
                LWKK
            </p>
            <p class="description">
                The company is committed to bring convenience to people\'s life,
                mainly research and sale of various portable tableware,
                so that people can also use their own clean tableware when traveling.
            </p>

        </div>
    </div>';
}

//write footer
function writeFooter(){
    $studentName = STUDENT_NAME;
    $studentNumber = STUDENT_NUMBER;
    $year = date('Y');

    echo "<div class=\"footer\">
        <p>Copyright {$studentName} ({$studentNumber}) {$year}.</p>
    </div>";
}

//write title
function writeTitle($title = '') {
    echo '<title>' . $title . '</title>';
}

//write common html tag start
function writeHtmlCommonTagStart($tag, $attributes = [], $isCloseTag = true) {
    $html = "<$tag ";
    foreach ($attributes as $key => $value) {
        if (is_numeric($key)) {
            $html .= $value;
        } else {
            $html .= "$key=\"{$value}\"";
        }
    }

    if ($isCloseTag) {
        $html .= ">";
    } else {
        $html .= "/>";
    }

    echo $html;
}

function writeHtmlCommonTagEnd($tag) {
    echo "</{$tag}>";
}

function writeNav($activeIndex = 0){
    $html = <<<EOD
<div class="nav">
        <ul>
            <li class="%s"><a href="home.php">Home</a></li>
            <li class="%s"><a href="buying.php">Buying</a></li>
            <li class="%s"><a href="orders.php">Orders</a></li>
        </ul>
    </div>
EOD;


    $s0 = '';
    $s1 = '';
    $s2 = '';

    switch ($activeIndex) {
        case 0:
            $s0 = 'active';
            break;

        case 1:
            $s1 = 'active';
            break;
        case 2:
            $s2 = 'active';
            break;

        default:
            break;
    }

    echo sprintf($html, $s0, $s1, $s2);
}

//write form of buying page
function writeForm($form = [], $items = []){
    $html = '<form ';
    //the attributes of form
    foreach ($form as $key =>$item) {
        if (is_numeric($key)) {
            $html .= " {$key} ";
        } else {
            $html .= " {$key}={$item} ";
        }
    }

    $html .= ' >';

    //the form item template
    $template = '<div class="form-group">
<label class="form-label"><b>%s</b></label>
<div>%s</div>
<div class="error"></div>
</div>';

    //form item
    foreach ($items as $item) {
        $formItemHtml = '';
        $attributesStr = '';
        foreach ($item['attributes'] as $key => $attribute) {
            if (is_numeric($key)) {
                $attributesStr .= " {$attribute} ";
            } else {
                $attributesStr .= " {$key}=\"{$attribute}\" ";
            }
        }
        switch ($item['tag']) {
            case 'input':
                $formItemHtml = '<input ' . $attributesStr . '/>';
                break;

            case 'textarea':
                $formItemHtml = '<textarea ' . $attributesStr . '></textarea>';
                break;
        }

        $html .= sprintf($template, $item['label'], $formItemHtml);
    }

    //the submit button
    $html .= '<div class="form-group-center">
            <button type="submit" class="form-btn">Submit</button>
        </div></form>';

    echo $html;
}

//write the table of orders page
function writeTable($table = [], $heads = [], $data = []){
    $html = '<table ';
    //the attributes of table
    foreach ($table as $key =>$item) {
        if (is_numeric($key)) {
            $html .= " {$key} ";
        } else {
            $html .= " {$key}={$item} ";
        }
    }

    $html .= ' >';

    $html .= '<thead><tr>';

    //the column head of table
    foreach ($heads as $head) {
        $class = isset($head['class']) ? $head['class'] : '';
        $html .= "<th class=\"{$class}\">{$head['title']}</th>";
    }
    $html .= '</tr></thead>';

    //the body
    $html .= '<tbody>';
    foreach ($data as $row) {
        $html .= "<tr>";

        foreach ($heads as $head) {
            $class = isset($row[$head['column']]['class']) ? $row[$head['column']]['class'] : '';

            $html .= "<td class=\"{$class}\">{$row[$head['column']]['value']}</td>";
        }
        $html .= "</tr>";
    }

    $html .= '</tbody></table>';
    echo $html;
}

//generate the html tag of advertise section
function writeAdvertises() {
    //products list
    $products = require DATA_PATH . 'products.php';


    //the first product is twice price
    $twiceProduct = array_shift($products);
    //normal price
    $normalProducts = $products;

    echo    '<div class="product" id="product">';
    echo    "<div class=\"product-item twice\">
                <a href=\"//www.google.com\"><img src=\" {$twiceProduct['image']}\"/></a>
                <div class=\"info\">
                    <div>{$twiceProduct['name']}</div>
                    <div>\${$twiceProduct['price']}</div>
                </div>
            </div>";

    foreach ($normalProducts as $item) {
        echo "<div class=\"product-item normal\">
                <a href=\"//www.google.com\"><img src=\"{$item['image']}\"/></a>
                <div class=\"info\">
                    <div>{$item['name']}</div>
                    <div>\${$item['price']}</div>
                </div>
            </div>";
    }

echo "</div>";
}

//write php cache control header
function writeHeader() {
    header('Cache-control: must-revalidate, max-age=0, no-cache, no-store');
    header("Pragma: no-cache");
}