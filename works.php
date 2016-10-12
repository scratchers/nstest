<?php

class MyClass {
	public $prop = 'hi';
}

class Container {
	static protected $registry = [];
	public static function get($key){
		if(!array_key_exists($key, static::$registry)){
			static::$registry[$key] = new $key;
		}
		return static::$registry[$key];
	}
}

$obj = Container::get('MyClass');
echo $obj->prop;
