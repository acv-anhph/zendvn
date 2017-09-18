<?php

// ====================== PATHS ===========================
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(__FILE__));                            // Định nghĩa đường dẫn đến thư mục gốc
define('LIBRARY_PATH', ROOT_PATH . DS . 'libs' . DS);                   // Định nghĩa đường dẫn đến thư mục thư viện
define('PUBLIC_PATH', ROOT_PATH . DS . 'public' . DS);                  // Định nghĩa đường dẫn đến thư mục public
define('APPLICATION_PATH', ROOT_PATH . DS . 'application' . DS);        // Định nghĩa đường dẫn đến thư mục application
define('TEMPLATE_PATH', PUBLIC_PATH . 'templates' . DS);                // Định nghĩa đường dẫn đến thư mục template

define('ROOT_URL', DS . 'ch11_multi_template' . DS);
define('APPLICATION_URL', 'application' . DS);
define('PUBLIC_URL', 'public' . DS);
define('VIEW_URL', 'views' . DS);
define('TEMPLATE_URL', PUBLIC_URL . 'templates' . DS);

// ====================== DATABASE ===========================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'zendvn');
define('DB_TABLE', 'manage_user');

// ====================== DEFAULT ===========================
define('DEFAULT_MODULE', 'default');
define('DEFAULT_CONTROLLER', 'user');
define('DEFAULT_ACTION', 'login');