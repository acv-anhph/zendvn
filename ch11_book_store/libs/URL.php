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
    
    public static function redirect($link){
        header('location: ' . $link);
        exit();
    }
}