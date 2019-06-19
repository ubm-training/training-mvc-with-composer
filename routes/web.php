<?php

function route($name,$id=0) {
    global $router;
    switch ($name) {
        case 'GET_HOME': return $router->generate('GET_HOME',[]); break;
        case 'GET_BAN_CREATE': return $router->generate('GET_BAN_CREATE',[]);break;
        case 'GET_BAN_EDIT': return $router->generate('GET_BAN_EDIT',['id'=>$id]); break;
        case 'GET_BAN_SHOW': return $router->generate('GET_BAN_SHOW',['id'=>$id]); break;
        case 'GET_BAN_INDEX': return $router->generate('GET_BAN_INDEX',[]);break;
        case 'GET_USER_CREATE': return $router->generate('GET_USER_CREATE',[]);break;
        case 'GET_USER_EDIT': return $router->generate('GET_USER_EDIT',['id'=>$id]); break;
        case 'GET_USER_SHOW': return $router->generate('GET_USER_SHOW',['id'=>$id]); break;
        case 'GET_USER_INDEX': return $router->generate('GET_USER_INDEX',[]);break;
        case 'POST_BAN_STORE': return $router->generate('POST_BAN_STORE',[]);break;
        case 'POST_BAN_UPDATE': return $router->generate('POST_BAN_UPDATE',[]);break;
        case 'POST_BAN_DELETE': return $router->generate('POST_BAN_DELETE',[]);break;
        case 'POST_USER_STORE': return $router->generate('POST_USER_STORE',[]);break;
        case 'POST_USER_UPDATE': return $router->generate('POST_USER_UPDATE',[]);break;
        case 'POST_USER_DELETE': return $router->generate('POST_USER_DELETE',[]);break;
        default: return '';
    }
}

function getParam() {
    $param = [];
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        foreach($_GET as $key => $value) {
            $param[$key] = trim(htmlentities(strip_tags($value), ENT_QUOTES | ENT_IGNORE, "UTF-8"));
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach($_POST as $key => $value) {
            $param[$key] = trim(htmlentities(strip_tags($value), ENT_QUOTES | ENT_IGNORE, "UTF-8"));
        }
    } else {
        foreach($_REQUEST as $key => $value) {
            $param[$key] = trim(htmlentities(strip_tags($value), ENT_QUOTES | ENT_IGNORE, "UTF-8"));
        }
    }
    return $param;
}

function redirect($routeName) {
    global $dbConnection;
    global $projectBasePath;
    $routePath = route($routeName);
    $pageURL = 'http';
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $pageURL .= "s";
    $pageURL .= "://";
    $pageURL .= $_SERVER["SERVER_NAME"];
    if ($_SERVER["SERVER_PORT"] != '80') $pageURL .= ":".$_SERVER["SERVER_PORT"];
    if (strlen(trim($projectBasePath,'/'))>0) $pageURL .= trim($projectBasePath,'/');
    $url = $pageURL.$routePath;
    $dbConnection->close();
    if (strlen(trim($routePath))>0) header( 'Location: '.$url) ;
    else header( 'Location: '.$pageURL) ;
    exit();
}