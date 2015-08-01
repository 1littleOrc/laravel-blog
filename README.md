# laravel-blog
Simple blog CMS on Laravel 5.1

### Functionality ###

* blog with human readable urls
* comments with reCAPTCHA and email notifications
* infinite scrolling
* image uploading
* microformats
* static tags
* star rating
* XML SiteMap

### Requirements ###

* PHP >= 5.5.9 , Apache, MySQL
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension


### How to setup ###

You need git and [composer](https://getcomposer.org/download/)
```
git clone https://github.com/Hukuta/laravel-blog.git && cd laravel-blog/ 
php $YOUR_PATH_TO_COMPOSER/composer.phar install
```

Create your .env file as copy of .env.example, this file must contain valid credentials for database connection.

Put contents of "public" directory in your virtual host public directory.

You can create database schema via command:

```
php artisan migrate
```
