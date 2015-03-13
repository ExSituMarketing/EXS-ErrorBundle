Symfony 2.x ErrorBundle
==========================

Error bundle to log 4xx and 5xx errors and exceptions in the database. 

Bundle is installed as a service and traps all 4xx and 5xx http exceptions in the database. When used in conjunction with a crontab enabled monitor we can then alert the dev team when there are hightened number of errors on the site and issue a rapid fix if necessary.



#### Download ####

1. Clone the Github repo: 
```bash
https://github.com/rumpranger/EXSErrorBundle.git
```
2. The zip from my Github: 
```bash
https://github.com/rumpranger/EXSErrorBundle
```

## Installation ##

* Place the bundle in your src folder
* Register the bundle in AppKernel.php 

```php
    public function registerBundles()
    {
        $bundles = array(
  		...
            new EXS\ErrorBundle\EXSErrorBundle(),
			...
        );
	}
```

* Update your schema using the doctrine tool: 

```bash
php app/console generate:bundle --namespace=EXS/ErrorBundle
php app/console doctrine:schema:update --force
``` 

* Done.


You can test that it works by throwing 500 and 400 series errors from your app. The errors will be logged (along with useful debugging information) in your database in the following tables: 
* exception4xx
* exception5xx
* http://www.example.com/app_dev.php/_test/error/http/500
* http://www.example.com/app_dev.php/_test/error/http/404
* http://www.example.com/app_dev.php/_test/error/http/403
* http://www.example.com/app_dev.php/_test/error/http/405
* http://www.example.com/app_dev.php/_test/error/http/410
* http://www.example.com/app_dev.php/_test/error/php/fatal
* http://www.example.com/app_dev.php/_test/error/php/notice

#### Contributing ####
Anyone and everyone is welcome to contribute.
