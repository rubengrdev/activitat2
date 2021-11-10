<?php
/**
 * Returns URL route
 * 
 */
function getRoute():String{
    if(isset($_REQUEST['url'])){
        $url=$_REQUEST['url'];
    }else{
        $url='home';
    }
    switch($url){
        case 'login':
            return 'login';
        case 'register':
            return 'register';
        case 'login_action':
            return 'login_action';
        case 'register_action':
            return 'register_action';
        case 'dashboard':
            return 'dashboard';
        case 'cookies':
            return 'cookies';
        case 'logout':
            return 'logout';
        case 'lists_action':
            return 'lists_action';
        case 'lists':
            return 'lists';
        case 'modify_lists':
            return 'alter_lists_action';
        
    }
    return $url;
}