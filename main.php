<?php
require __DIR__.'/vendor/autoload.php';
use scratchers\nstest\Container;

$obj = Container::get('MyClass');
echo $obj->prop;
