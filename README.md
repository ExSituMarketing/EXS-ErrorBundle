Symfony 2.x ErrorBundle
==========================

Error bundle to log 4xx and 5xx errors and exceptions in the database. 

Bundle is installed as a service and traps all 4xx and 5xx http exceptions in the database. When used in conjunction with a crontab enabled monitor we can then alert the dev team when there are hightened number of errors on the site and issue a rapid fix if necessary.



#### Download ####

1. Clone the Github repo: 
```bash
https://github.com/ExSituMarketing/EXS-ErrorBundle.git
```
2. The zip from this Github: 
```bash
https://github.com/ExSituMarketing/EXS-ErrorBundle/archive/master.zip
```

## Installation ##

* Register the bundle in AppKernel.php 

```js
//composer.json
//...
"require": {
        //other bundles
        "exs/error-bundle": "dev-master"
```

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

If you wish to test the exceptions being thrown via the included controller you can try updating your routing file with the following routes


```
// app/routing.yml
//...
error:
    resource: @EXSErrorBundle/Controller/
    type:     annotation
```

* http://www.example.com/app_dev.php/_test/error/http/500

* http://www.example.com/app_dev.php/_test/error/http/404

* http://www.example.com/app_dev.php/_test/error/http/403

* http://www.example.com/app_dev.php/_test/error/http/405

* http://www.example.com/app_dev.php/_test/error/http/410

* http://www.example.com/app_dev.php/_test/error/php/fatal

* http://www.example.com/app_dev.php/_test/error/php/notice

#### Contributing ####
Anyone and everyone is welcome to contribute.

If you have any questions or suggestions for the next step of our tutorial please [let us know][1].


[1]: http://www.ex-situ.com/
