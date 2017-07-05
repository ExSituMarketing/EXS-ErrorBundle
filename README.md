Symfony 2.x ErrorBundle
==========================

Error bundle to log 4xx and 5xx errors and exceptions in the database. 

Bundle is installed as a service listening for all 4xx and 5xx http exceptions and logs them in the database. When used in conjunction with a crontab enabled monitor we can then alert the dev team when there are hightened number of errors on the site and issue a rapid fix if necessary.



## Installing the ErrorBundle in a new Symfony2 project
So the ErrorBundle is ready for installation, great news but how do we install it.  The installation process is actually very simple.  Set up a new Symfony2 project with Composer.

Require from the command line directly:
```
composer require 'exs/error-bundle:1.0'
```

Once the new project is set up, open the composer.json file and add the exs/error-bundle as a dependency:
``` js
//composer.json
//...
"require": {
        //other bundles
        "exs/error-bundle": "~1.0@dev"
```
Save the file and have composer update the project via the command line:
``` shell
php composer.phar update
```
Composer will now update all dependencies and you should see our bundle in the list:
``` shell
  - Installing exs/error-bundle (dev-master 0c644b1)
    Cloning 0c644b1315e75cd4ff521eeea0ee3243faad0ce3
```

Now just update the app/AppKernel.php and app/config/routing.yml to include our bundle, clear the cache and update the schema:
``` php
//app/AppKernel.php
//...
    public function registerBundles()
    {
        $bundles = array(
            //Other bundles
            new EXS\ErrorBundle\EXSErrorBundle()
        );
```
add routing.yml:
```
#app/config/routing.yml
#...
contact:
    resource: "@EXSErrorBundle/Controller/"
    type:     annotation
    prefix:   /
```
add the bundle to orm configuration:
```
#app/config/config.yml
#...
    orm:
        auto_generate_proxy_classes: "%kernel.debug%"
        default_entity_manager: default
        entity_managers:
            default:
                connection: default
                mappings:
                    AppBundle:  ~
                    EXSErrorBundle: ~
```
add deprecated errors params:
```
# parameters.yml:
    deprecated_errors_logging: false

```
clear cache and update database:
``` shell
php app/console cache:clear
php app/console doctrine:schema:update --force
```

and now you're done.


You can test that it works by throwing 500 and 400 series errors from your app. The errors will be logged (along with useful debugging information) in your database in the following tables: 

* exception4xx

* exception5xx

If you wish to test the exceptions being thrown via the included controller you can try the following routes


* http://www.example.com/app_dev.php/_test/error/http/500

* http://www.example.com/app_dev.php/_test/error/http/404

* http://www.example.com/app_dev.php/_test/error/http/403

* http://www.example.com/app_dev.php/_test/error/http/405

* http://www.example.com/app_dev.php/_test/error/http/410

* http://www.example.com/app_dev.php/_test/error/php/fatal

* http://www.example.com/app_dev.php/_test/error/php/notice


If you want to test the console exceptions try:

``` shell
php app/console _test:command:fatal
php app/console _test:command:notice
php app/console _test:command:exception
```


#### Contributing ####
Anyone and everyone is welcome to contribute.

If you have any questions or suggestions please [let us know][1].


[1]: http://www.ex-situ.com/
