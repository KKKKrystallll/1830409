<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-05 define constant DEBUG
#TianzhenSun(1830409) 2021-03-06 define some useful constant
#TianzhenSun(1830409) 2021-03-09 define constant DATA_PATH
#

defined('DEBUG') or define('DEBUG', true);
defined('STUDENT_NAME') or define('STUDENT_NAME', 'TianzhenSun');
defined('STUDENT_NUMBER') or define('STUDENT_NUMBER', '1830409');
defined(' LOCAL_TAXES') or define('LOCAL_TAXES', 0.1205);

defined('DATA_PATH') or define('DATA_PATH', dirname(__DIR__) . '/data/');
//the path of purchases.txt
defined('PURCHASES_FILE') or define('PURCHASES_FILE', DATA_PATH . 'purchases.txt');

defined('LOG_PATH') or define('LOG_PATH', dirname(__DIR__) . '/logs/');
