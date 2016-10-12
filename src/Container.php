<?php
namespace scratchers\nstest;
require __DIR__.'/../vendor/autoload.php';

class Container {
	static protected $registry = [];
	public static function get($key){
		if(!array_key_exists($key, static::$registry)){
			static::$registry[$key] = new $key;
		}
		return static::$registry[$key];
	}
}
