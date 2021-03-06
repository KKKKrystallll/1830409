<?php
#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-05 define constant DEBUG
#TianzhenSun(1830409) 2021-03-06 define some useful constant
#

defined('DEBUG') or define('DEBUG', true);
defined('STUDENT_NAME') or define('STUDENT_NAME', 'TianzhenSun');
defined('STUDENT_NUMBER') or define('STUDENT_NUMBER', '1830409');
defined(' LOCAL_TAXES') or define('LOCAL_TAXES', 0.1205);
//the path of purchases.txt
defined('PURCHASES_FILE') or define('PURCHASES_FILE', dirname(__DIR__) . '/data/purchases.txt');

defined('LOG_PATH') or define('LOG_PATH', dirname(__DIR__) . '/logs/');
