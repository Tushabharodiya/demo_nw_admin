<?php defined('BASEPATH') OR exit('No direct script access allowed');
// ------ News ------ //
// Main Category Functions
$route['new-main-category'] = 'news/mainCategory/mainCategoryNew';
$route['view-main-category'] = 'news/mainCategory/mainCategoryView';
$route['view-main-category'.'/(:num)'] = 'news/mainCategory/mainCategoryView/$1';
$route['edit-main-category'.'/(:any)'] = 'news/mainCategory/mainCategoryEdit/$1';
$route['delete-main-category'.'/(:any)'] = 'news/mainCategory/mainCategoryDelete/$1';

// Sub Category Functions
$route['new-sub-category'] = 'news/subCategory/subCategoryNew';
$route['view-sub-category'] = 'news/subCategory/subCategoryView';
$route['view-sub-category'.'/(:num)'] = 'news/subCategory/subCategoryView/$1';
$route['view-sub-categories'.'/(:any)'] = 'news/subCategory/subCategoriesView/$1';
$route['view-sub-categories'.'/(:any)'.'/(:num)'] = 'news/subCategory/subCategoriesView/$1/$2';
$route['edit-sub-category'.'/(:any)'] = 'news/subCategory/subCategoryEdit/$1';
$route['delete-sub-category'.'/(:any)'] = 'news/subCategory/subCategoryDelete/$1';

// Blog Functions
$route['new-blog'] = 'news/blog/blogNew';
$route['view-blog'] = 'news/blog/blogView';
$route['view-blog'.'/(:num)'] = 'news/blog/blogView/$1';
$route['view-blogs'.'/(:any)'] = 'news/blog/blogsView/$1';
$route['view-blogs'.'/(:any)'.'/(:num)'] = 'news/blog/blogsView/$1/$2';
$route['edit-blog'.'/(:any)'] = 'news/blog/blogEdit/$1';
$route['delete-blog'.'/(:any)'] = 'news/blog/blogDelete/$1';

// Game Functions
$route['new-game'] = 'news/game/gameNew';
$route['view-game'] = 'news/game/gameView';
$route['view-game'.'/(:num)'] = 'news/game/gameView/$1';
$route['edit-game'.'/(:any)'] = 'news/game/gameEdit/$1';
$route['delete-game'.'/(:any)'] = 'news/game/gameDelete/$1';

// Page Functions
$route['new-page'] = 'news/page/pageNew';
$route['view-page'] = 'news/page/pageView';
$route['view-page'.'/(:num)'] = 'news/page/pageView/$1';
$route['edit-page'.'/(:any)'] = 'news/page/pageEdit/$1';
$route['delete-page'.'/(:any)'] = 'news/page/pageDelete/$1';

// Block Functions
$route['new-block'] = 'news/block/blockNew';
$route['view-block'] = 'news/block/blockView';
$route['view-block'.'/(:num)'] = 'news/block/blockView/$1';
$route['edit-block'.'/(:any)'] = 'news/block/blockEdit/$1';
$route['delete-block'.'/(:any)'] = 'news/block/blockDelete/$1';

// Contact Functions
$route['new-contact'] = 'news/contact/contactNew';
$route['view-contact'] = 'news/contact/contactView';
$route['view-contact'.'/(:num)'] = 'news/contact/contactView/$1';
$route['edit-contact'.'/(:any)'] = 'news/contact/contactEdit/$1';
$route['delete-contact'.'/(:any)'] = 'news/contact/contactDelete/$1';

// ------ Master ------ //
// User Functions
$route['new-user'] = 'master/user/userNew';
$route['view-user'] = 'master/user/userView';
$route['edit-user'.'/(:any)'] = 'master/user/userEdit/$1';
$route['user-profile'] = 'master/user/userProfile';

// Department Functions
$route['new-department'] = 'master/department/departmentNew';
$route['view-department'] = 'master/department/departmentView';
$route['edit-department'.'/(:any)'] = 'master/department/departmentEdit/$1';
$route['view-users'.'/(:any)'] = 'master/department/usersView/$1';

// Permission Functions
$route['new-permission'] = 'master/permission/permissionNew';
$route['view-permission'] = 'master/permission/permissionView';
$route['view-permissions'.'/(:any)'] = 'master/permission/permissionsView/$1';
$route['edit-permission'.'/(:any)'] = 'master/permission/permissionEdit/$1';
$route['department-rights'.'/(:any)'] = 'master/permission/departmentRights/$1';
$route['department-permission'.'/(:any)'] = 'master/permission/departmentPermission/$1';
$route['user-rights'.'/(:any)'] = 'master/permission/userRights/$1';
$route['user-permission'.'/(:any)'] = 'master/permission/userPermission/$1';

// Alias Functions
$route['new-alias'] = 'master/alias/aliasNew';
$route['view-alias'] = 'master/alias/aliasView';
$route['edit-alias'.'/(:any)'] = 'master/alias/aliasEdit/$1';

// Login Functions
$route['login-history'] = 'master/user/loginHistory';
$route['login-description'.'/(:any)'] = 'master/user/loginDescription/$1';
$route['login-activity'.'/(:any)'] = 'master/user/loginActivity/$1';

// Ip Functions
$route['new-ip'] = 'master/ip/ipNew';
$route['view-ip'] = 'master/ip/ipView';
$route['edit-ip'.'/(:any)'] = 'master/ip/ipEdit/$1';
$route['delete-ip'.'/(:any)'] = 'master/ip/ipDelete/$1';

// Logout Functions
$route['user-logout'.'/(:any)'] = 'logout/userLogout/$1';
$route['logout-activity'] = 'logout/logoutActivity';

// Session Functions 
$route['unset-session'] = 'SessionUnsetter/unsetSession';

// Common Settings
$route['default_controller'] = 'dashboard';
$route['404_override'] = 'error404';
$route['permission-denied'] = 'error404/permissionDenied';
$route['ip-denied'] = 'error404/ipDenied';
$route['time-denied'] = 'error404/timeDenied';
$route['translate_uri_dashes'] = FALSE;