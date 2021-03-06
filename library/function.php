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

function writeHead($title = '', $cssFiles = [], $jsFiles = []){
    writeTitle($title);
    writeHtmlMeta();
    writeCssFiles($cssFiles);
    writeJsFiles($jsFiles);
}

function writeCssFiles($cssFiles = []){
    foreach ($cssFiles as $cssFile) {
        echo "<link rel=\"stylesheet\" href=\"{$cssFile}\"/>";
    }
}

function writeJsFiles($jsFiles = []){
    foreach ($jsFiles as $jsFile) {
        echo "<script src=\"{$jsFile}\"></script>";
    }
}

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

function writeForm($form = [], $items = []){
    $html = '<form ';
    foreach ($form as $key =>$item) {
        if (is_numeric($key)) {
            $html .= " {$key} ";
        } else {
            $html .= " {$key}={$item} ";
        }
    }

    $html .= ' >';

    $template = '<div class="form-group">
<label class="form-label"><b>%s</b></label>
<div>%s</div>
<div class="error"></div>
</div>';

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

    $html .= '<div class="form-group-center">
            <button type="submit" class="form-btn">Submit</button>
        </div></form>';

    echo $html;
}


function writeTable($table = [], $heads = [], $data = []){
    $html = '<table ';
    foreach ($table as $key =>$item) {
        if (is_numeric($key)) {
            $html .= " {$key} ";
        } else {
            $html .= " {$key}={$item} ";
        }
    }

    $html .= ' >';

    $html .= '<thead><tr>';

    foreach ($heads as $head) {
        $class = isset($head['class']) ? $head['class'] : '';
        $html .= "<th class=\"{$class}\">{$head['title']}</th>";
    }
    $html .= '</tr></thead>';

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


function writeHeader() {
    header('Cache-control: must-revalidate, max-age=0, no-cache, no-store');
    header("Pragma: no-cache");
}