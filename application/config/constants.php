<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|-------------------------------------------------------------------------------
| Panel Setting
|-------------------------------------------------------------------------------
*/
/* Common Setting */
define("URL", "https://syphnosys.com/news-admin/");
define("COPYRIGHT", "Copyright © 2019-2025 Reserved By - Syphnosys Apps.");
define("TITLE", "News Panel");
define("OTP", "admin");
define("AUTH_KEY", "5926478023654985");
define("IMAGE_PATH", "../uploads/image/");
define("THUMBNAIL_PATH", "../uploads/thumbnail/");
define("ICON_PATH", "../uploads/icon/");
define("DATA_PATH", "../uploads/data/");

/* Database Setting */
define("HOST", "localhost");
define("USER", "syphnosy_root");
define("PASS", 'SYS@dev#web#cloud#12');
define("DB", "syphnosys_news");

// =============================================================================
// ============================ Permission Alias ===============================
// =============================================================================
// Permission Alias Setting
define("MAIN_CATEGORY_ALIAS", "main_category_alias");
define("MAIN_CATEGORY_TOTAL_ALIAS", "main_category_total_alias");
define("MAIN_CATEGORY_PUBLISH_ALIAS", "main_category_publish_alias");
define("MAIN_CATEGORY_UNPUBLISH_ALIAS", "main_category_unpublish_alias");

define("SUB_CATEGORY_ALIAS", "sub_category_alias");
define("SUB_CATEGORY_TOTAL_ALIAS", "sub_category_total_alias");
define("SUB_CATEGORY_PUBLISH_ALIAS", "sub_category_publish_alias");
define("SUB_CATEGORY_UNPUBLISH_ALIAS", "sub_category_unpublish_alias");

define("BLOG_ALIAS", "blog_alias");
define("BLOG_TOTAL_ALIAS", "blog_total_alias");
define("BLOG_PUBLISH_ALIAS", "blog_publish_alias");
define("BLOG_UNPUBLISH_ALIAS", "blog_unpublish_alias");

define("GAME_ALIAS", "game_alias");
define("GAME_TOTAL_ALIAS", "game_total_alias");
define("GAME_PUBLISH_ALIAS", "game_publish_alias");
define("GAME_UNPUBLISH_ALIAS", "game_unpublish_alias");

define("PAGE_ALIAS", "page_alias");

define("BLOCK_ALIAS", "block_alias");

define("CONTACT_ALIAS", "contact_alias");
define("CONTACT_TOTAL_ALIAS", "contact_total_alias");
define("CONTACT_PUBLISH_ALIAS", "contact_publish_alias");
define("CONTACT_UNPUBLISH_ALIAS", "contact_unpublish_alias");

// =============================================================================
// ================================= Table =====================================
// =============================================================================
// News Table
define("MAIN_CATEGORY_TABLE", "news_main_category");
define("SUB_CATEGORY_TABLE", "news_sub_category");
define("BLOG_TABLE", "news_blog");
define("PAGE_TABLE", "news_page");
define("BLOCK_TABLE", "news_block");
define("GAME_TABLE", "news_game");
define("CONTACT_TABLE", "news_contact");

// Master Table
define("SUPER_USER_TABLE", "sys_zuser_super");
define("MASTER_USER_TABLE", "sys_zuser_master");
define("PERMISSION_USER_TABLE", "sys_permission_user");
define("PERMISSION_DEPARTMENT_TABLE", "sys_permission_department");
define("PERMISSION_MASTER_TABLE", "sys_permission_master");
define("PERMISSION_ALIAS_TABLE", "sys_permission_alias");
define("DEPARTMENT_TABLE", "sys_department");
define("IP_TABLE", "sys_allowed_ip");
define("LOGIN_DATA_TABLE", "sys_login_data");