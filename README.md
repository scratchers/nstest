This works:
```php
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
```
> hi

But when I try to break it out into individual files, I get an error.

> PHP Fatal error:  Uncaught Error: Class 'MyClass' not found in /nstest/src/Container.php:9

This is line 9:
```php
    static::$registry[$key] = new $key;
```
What's crazy is that I can hard code it, and it works, so I know the namespace is correct.
```php
    static::$registry[$key] = new MyClass;
```
> hi

Obviously I don't want to hard code it because I need dynamic values. I've also tried:
```php
    $key = $key::class;
    static::$registry[$key] = new $key;
```
But that gives me this error:

> PHP Fatal error:  Dynamic class names are not allowed in compile-time ::class fetch

I'm at a loss. [Clone these files to reproduce][1]:

    .
    ├── composer.json
    ├── main.php
    ├── src
    │   ├── Container.php
    │   └── MyClass.php
    ├── vendor
    │   └── ...
    └── works.php

Don't forget the autoloader.

    composer dumpautoload

# composer.json

    {
    	"autoload": {
    		"psr-4": {
    			"scratchers\\nstest\\": "src/"
    		}
    	}
    }

# main.php
```php
    require __DIR__.'/vendor/autoload.php';
    use scratchers\nstest\Container;
    
    $obj = Container::get('MyClass');
    echo $obj->prop;
```
# src/Container.php

```php
    namespace scratchers\nstest;
    
    class Container {
    	static protected $registry = [];
    	public static function get($key){
    		if(!array_key_exists($key, static::$registry)){
    			static::$registry[$key] = new $key;
    		}
    		return static::$registry[$key];
    	}
    }
```
# src/MyClass.php
```php
    namespace scratchers\nstest;
    
    class MyClass {
    	public $prop = 'hi';
    }
```
  [1]: https://github.com/scratchers/nstest



