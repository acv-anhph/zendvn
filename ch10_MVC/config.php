<?php
    
    // ====================== PATHS ===========================
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT_PATH', dirname(__FILE__));                        // Định nghĩa đường dẫn đến thư mục gốc
    define('LIBRARY_PATH', ROOT_PATH . DS . 'libs' . DS);               // Định nghĩa đường dẫn đến thư mục thư viện
    define('CONTROLLER_PATH', ROOT_PATH . DS . 'controllers' . DS);     // Định nghĩa đường dẫn đến thư mục controllers
    define('MODEL_PATH', ROOT_PATH . DS . 'models' . DS);               // Định nghĩa đường dẫn đến thư mục models
    define('VIEW_PATH', ROOT_PATH . DS . 'views' . DS);                 // Định nghĩa đường dẫn đến thư mục views
    define('PUBLIC_PATH', ROOT_PATH . DS . 'public' . DS);              // Định nghĩa đường dẫn đến thư mục public
    
    define('ROOT_URL', DS . 'ch10_MVC');
    define('PUBLIC_URL', 'public' . DS);
    define('VIEW_URL', 'views' . DS);
    
    // ====================== DATABASE ===========================
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'zendvn');
    define('DB_TABLE', 'manage_user');