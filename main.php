<?php
require __DIR__.'/vendor/autoload.php';
use scratchers\nstest\Container;
use scratchers\nstest\MyClass;

$obj = Container::get(MyClass::class);
echo $obj->prop;
