# Shoe Store

#### Epicodus PHP Week 4, 3/2017

#### By Stella Huayhuaca

## Description

A program to list out local shoe stores and the brands of shoes they carry.This lab is about experimenting with PHP and installing the silex and Twig frameworks and extending to mySQL.

## Setup/Installation Requirements
* See https://secure.php.net/ for details on installing _PHP_.  Note: PHP is typically already installed on Mac.
* See https://getcomposer.org/ for details on installing _composer_.
* See https://mamp.info/ for details on installing _MAMP_.
* Use MAMP `http://localhost:8888/phpmyadmin/` and `shoes.sql.zip` to import a `shoes` database.
* Use same MAMP website to copy to_do database to `shoes_test` database (if you would like to try PHPUnit tests).
* Use MAMP
* Clone project
* From project root, run > `composer install --prefer-source --no-interaction`
* To run PHPUnit tests from root > `vendor/bin/phpunit tests`
* In web browser open `localhost:8888`

## Known Bugs
* No known bugs

## Support and contact details
* No support

## Technologies Used
* PHP
* MAMP
* mySQL
* Composer
* PHPUnit
* Silex
* Twig
* HTML
* CSS
* Bootstrap
* Git

## Copyright (c)
* 2017 Stella Huayhuaca.

## License
* MIT

## Specifications
* Start MySQL.
* Start phpunit dependency.
* Create the database with tables and columns.
* Create Restaurant Class with name, cuisine_id.
* Create Cuisine Class with type.
* Test for functionality.
* Build class methods according to tests.
* Silex and Twig Dependencies
* Initial Silex framework
* Add classes functionality to routes.
* Twig forms

## MySQL commands used:
* start servers in MAMP
* /applications/mamp/library/bin/mysql --host=localhost -uroot -proot
* Create database shoes;
* Use shoes;
* Create table stores(id serial primary key, name varchar(255));
* Create table brands(id serial primary key, name varchar(255));
* Create table stores_brands(id serial primary key, store_id int, brand_id int);
* use shoes_test ; (after creating a copy(structure only) in /phpmyadmin browser.)


|Behavior|Input|Output|
|--------|-----|------|
|Store added|the user enters a shoe store name in a form |a list shows the new name added.|
|Shoe store selected|Selects the name of a store |takes to a new page where user can add brand names of shoes.|
|Brand added|user inputs name of brand in the form|a list show the name of brand being added.|
|Brand selected|user selects one of the brands|a new page shoes that stores where that brand can be found.|
|Name of store is edited|user edits the store information |new name is assigned to store.|
|Store is deleted|user clicks delete button to remove a store from the list|the list does not show the store who was deleted neither his brands.|
|All stores are deleted|user clicks on the "delete all"|the whole list of stores and its brands dissappear.|


* End specifications
