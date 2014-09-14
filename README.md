PHP-MVC Bare-bone Framework
===========================
Provides basic, bare-bone essentials to run any web project quickly.

Why this framework over others
----------------------------------
- Basic and simple MVC concept
- User-friendly URL structure
- Utilizes Composer to install dependancies
- Utilizes Twig with cache as a PHP template for views
- Utilizes Memcached (optional)
- Utilizes PHP PDO as prepared statement

Built for LEMP Stack
--------------------
This Framework is built with the new and powerful nginx in mind. It does not use any .htaccess with mod-rewrite. Simply set the root path to /public and the front-controller will take care of the rest. Apache servers may still be able to use this Framework. See below for nginx configuration.

Use Case Scenarios
------------------
The front-controller is able to translate any of these structures as defined:

**domain.com/**
```
HomeController->index();
```
**domain.com/this-is-an-item**
```
HomeController->index('this-is-an-item');
```
**domain.com/catalogue/**
```
CatalogueController->index();
```
**domain.com/catalogue/author/**
```
CatalogueController->author();
```
**domain.com/catalogue/author/jk-rowling**
```
CatalogueController->author('jk-rowling');
```
**domain.com/catalogue/category/**
```
CatalogueController->category();
```
**domain.com/catalogue/category/non-fiction**
```
CatalogueController->category('non-fiction');
```
As you would have noticed, these rules applies:
- The first parameter defines the Controller name and this file can be found in /application/controller/
- The second parameter defines the method to call (function) within the parent Class
- The third and above parameters will simply be attached as variable parameters to the method
- Should the first parameter not exist, it will automatically assigned to the HomeController
- Should the first parameter exist but is not found as a controller, it will be regarded as an item and fall under HomeController

Having such a setup allows the stakeholder to define the URL naming structure as he sees fit. This is especially useful for vanity URLs.

How to Install
--------------
*Disclaimer: Please note that this framework is stil in development and not ready for deployment.*

1. Download the latest release here > https://github.com/mosufy/php-mvc/releases
2. Unzip and push/upload to your remote or local server
3. Install dependencies via Composer

  ```
  $ cd /path/to/folder/php-mvc
  $ sudo composer install
  ```

4. Duplicate config-sample.php and rename as config.php
  
  ```      
  $ sudo cp /application/config/config-sample.php /application/config/config.php
  ```
  Update the configurations as required
5. Import/run the MySQL schema provided in /application/db/db_phpmvc.sql
6. Update nginx server block as defined below

Nginx Server Block
------------------
A slight tweak to the server block is required to make this work.
```
location / {
  root /path/to/folder/public   # ensure root points to the public folder

  location / {
    try_files $uri $uri/ @mvcrewrite;
  }

  location @mvcrewrite {
    rewrite ^(.+)$ /index.php?url=$1 last;
  }
}
```
Here's a full sample template
```
server {
  listen 80;
  listen [::]:80;

  root /var/www/domain_name/public;
  index index.php index.html index.htm;

  server_name domain_name.com;
  access_log /var/log/nginx/domain_name-access.log;
  error_log /var/log/nginx/domain_name-error.log;

  location / {
    try_files $uri $uri/ @mvcrewrite;
  }

  location @mvcrewrite {
    rewrite ^(.+)$ /index.php?url=$1 last;
  }

  error_page 404 /404.html;
  error_page 500 502 503 504 /50x.html;
  location = /50x.html {
    root /usr/share/nginx/html;
  }

  location ~ \.php$ {
    try_files $uri =404;
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_pass unix:/var/run/php5-fpm.sock;
    fastcgi_index index.php;
    include fastcgi_params;
  }

  # deny access to .htaccess files to prevent conflict
  location ~ /\.ht {
    deny all;
  }
}
```