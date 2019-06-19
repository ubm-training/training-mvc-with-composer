<?php
require __DIR__.'/../vendor/autoload.php';
//===========================================
// kết nối database
$dbConnection = dbOpen(); // mở kết nối database
//===========================================
// thực hiện route
$router = new AltoRouter();
$projectBasePath = '';
$router->setBasePath($projectBasePath);
try {
    $router->map('GET', '', 'WebHoanHao\TrainingMvc\Controller\HomeController@index','GET_HOME');
    $router->map('GET', '/', 'WebHoanHao\TrainingMvc\Controller\HomeController@index','GET_HOME_1');
    $router->map('GET', '/ban', 'WebHoanHao\TrainingMvc\Controller\BanController@index','GET_BAN_INDEX');
    $router->map('GET', '/ban/', 'WebHoanHao\TrainingMvc\Controller\BanController@index','GET_BAN_INDEX_1');
    $router->map('GET', '/ban/edit/[i:id]', 'WebHoanHao\TrainingMvc\Controller\BanController@edit','GET_BAN_EDIT');
    $router->map('GET', '/ban/edit/[i:id]/', 'WebHoanHao\TrainingMvc\Controller\BanController@edit','GET_BAN_EDIT_1');
    $router->map('GET', '/ban/create', 'WebHoanHao\TrainingMvc\Controller\BanController@create','GET_BAN_CREATE');
    $router->map('GET', '/ban/create/', 'WebHoanHao\TrainingMvc\Controller\BanController@create','GET_BAN_CREATE_1');
    $router->map('GET', '/ban/show/[i:id]', 'WebHoanHao\TrainingMvc\Controller\BanController@show','GET_BAN_SHOW');
    $router->map('GET', '/ban/show/[i:id]/', 'WebHoanHao\TrainingMvc\Controller\BanController@show','GET_BAN_SHOW_1');
    $router->map('GET', '/user', 'WebHoanHao\TrainingMvc\Controller\UserController@index','GET_USER_INDEX');
    $router->map('GET', '/user/', 'WebHoanHao\TrainingMvc\Controller\UserController@index','GET_USER_INDEX_1');
    $router->map('GET', '/user/edit/[i:id]', 'WebHoanHao\TrainingMvc\Controller\UserController@edit','GET_USER_EDIT');
    $router->map('GET', '/user/edit/[i:id]/', 'WebHoanHao\TrainingMvc\Controller\UserController@edit','GET_USER_EDIT_1');
    $router->map('GET', '/user/create', 'WebHoanHao\TrainingMvc\Controller\UserController@create','GET_USER_CREATE');
    $router->map('GET', '/user/create/', 'WebHoanHao\TrainingMvc\Controller\UserController@create','GET_USER_CREATE_1');
    $router->map('GET', '/user/show/[i:id]', 'WebHoanHao\TrainingMvc\Controller\UserController@show','GET_USER_SHOW');
    $router->map('GET', '/user/show/[i:id]/', 'WebHoanHao\TrainingMvc\Controller\UserController@show','GET_USER_SHOW_1');
    $router->map('POST', '/ban/store', 'WebHoanHao\TrainingMvc\Controller\BanController@store','POST_BAN_STORE');
    $router->map('POST', '/ban/update', 'WebHoanHao\TrainingMvc\Controller\BanController@update','POST_BAN_UPDATE');
    $router->map('POST', '/ban/delete', 'WebHoanHao\TrainingMvc\Controller\BanController@destroy','POST_BAN_DELETE');
    $router->map('POST', '/user/store', 'WebHoanHao\TrainingMvc\Controller\UserController@store','POST_USER_STORE');
    $router->map('POST', '/user/update', 'WebHoanHao\TrainingMvc\Controller\UserController@update','POST_USER_UPDATE');
    $router->map('POST', '/user/delete', 'WebHoanHao\TrainingMvc\Controller\UserController@destroy','POST_USER_DELETE');
} catch (Exception $e) {
    echo print_r($e,true);
}
$match = $router->match();
if ($match === false) {
    echo 'Lỗi 404 PAGE NOT FOUND';
} else {
    list($controller, $action) = explode('@', $match['target']);
    $controller = new $controller;
    if (is_callable(array($controller, $action))) {
        $params = (empty($match['params']))?getParam():$match['params'];
        call_user_func_array(array($controller, $action), array($params));
    } else {
        echo 'Lỗi: không chạy được method ' . get_class($controller) . '@' . $action;
    }
}
//============================================
// chạy hàm đóng kết nối database
$dbConnection->close();