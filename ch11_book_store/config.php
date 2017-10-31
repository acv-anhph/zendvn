<?php

// ====================== PATHS ===========================
define('DS', '/');
define('ROOT_PATH', dirname(__FILE__));                                 // Định nghĩa đường dẫn đến thư mục gốc
define('LIBRARY_PATH', ROOT_PATH . DS . 'libs' . DS);                   // Định nghĩa đường dẫn đến thư mục thư viện
define('PUBLIC_PATH', ROOT_PATH . DS . 'public' . DS);                  // Định nghĩa đường dẫn đến thư mục public
define('APPLICATION_PATH', ROOT_PATH . DS . 'application' . DS);        // Định nghĩa đường dẫn đến thư mục application
define('MODULE_PATH', APPLICATION_PATH . 'module' . DS);                // Định nghĩa đường dẫn đến thư mục module
define('BLOCK_PATH', APPLICATION_PATH . 'block' . DS);                // Định nghĩa đường dẫn đến thư mục block
define('TEMPLATE_PATH', PUBLIC_PATH . 'templates' . DS);                // Định nghĩa đường dẫn đến thư mục template

define('ROOT_URL', DS . 'ch11_book_store' . DS);
define('APPLICATION_URL', 'application' . DS);
define('PUBLIC_URL', 'public' . DS);
define('VIEW_URL', 'views' . DS);
define('TEMPLATE_URL', PUBLIC_URL . 'templates' . DS);

// ====================== DATABASE ===========================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'book_store');
define('DB_TABLE', 'group');

// ====================== DATABASE TABLE===========================
define('GROUP_TABLE', 'group');
define('USER_TABLE', 'user');

// ====================== DEFAULT ===========================
define('DEFAULT_MODULE', 'default');
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_ACTION', 'index');
define('SESSSION_LOGIN', 3600);