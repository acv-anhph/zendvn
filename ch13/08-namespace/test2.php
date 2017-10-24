<?php
namespace Foo\Bar;

require_once 'test1.php';

function hello() {
    echo __NAMESPACE__;
}

\Foo\Bar\hello();
