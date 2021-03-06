<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-06 create some common function
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


function writeHtmlMeta() {
    echo '<meta charset="UTF-8"><meta http-equiv="Expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Cache" content="no-cache">';
}

function writeFooter(){
    $studentName = STUDENT_NAME;
    $studentNumber = STUDENT_NUMBER;
    $year = date('Y');

    echo "<div class=\"footer\">
        <p>Copyright {$studentName} ({$studentNumber}) {$year}.</p>
    </div>";
}

function writeTitle($title = '') {
    echo '<title>' . $title . '</title>';
}


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
            <li class="%s"><a href="page/home.html">Home</a></li>
            <li class="%s"><a href="page/buy.html">Buying</a></li>
            <li class="%s"><a href="page/order.html">Orders</a></li>
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

function writeHeader() {
    header('Cache-control: must-revalidate, max-age=0, no-cache, no-store');
    header("Pragma: no-cache");
}