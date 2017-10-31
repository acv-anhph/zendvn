<?php

class URL {
	
	public static function createLink( $module, $controller, $action, $param = null) {
        $url = 'index.php?module=' . $module . '&controller=' . $controller . '&action=' . $action;
        if (!empty($param)) {
            foreach ($param as $key => $value) {
                $url .= '&' . $key . '=' . $value;
            }
        }
		
		return $url;
	}

    public static function redirect($module, $controller, $action, $params = null){
        $link	= self::createLink($module, $controller, $action, $params);
        header('location: ' . $link);
        exit();
    }

    public static function checkRefreshPage($value, $module, $controller, $action, $params = null){
        if(Session::get('token') == $value){
            Session::delete('token');
            URL::redirect($module, $controller, $action, $params);
        }else{
            Session::set('token', $value);
        }
    }
}