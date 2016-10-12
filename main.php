<?php
require __DIR__.'/vendor/autoload.php';
use jpuck\nstest\Container;

$obj = Container::get('MyClass');
echo $obj->prop;
