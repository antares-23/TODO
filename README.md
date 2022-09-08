
# TODO

A Simple TODO in PHP, HTML5, Boostrap and MAriaDB.

![Screenshot](./TODO/images/system.jpg)

## Requeriments

- Git
- PHP 7 or above
- MySQL 5.7 or above
- Apache 2.4 or above
- Laragon recomended for Windows

Also recommended:
-phpMyadmin


## Installation

Clone the project on your web root folder (www or equivalent)

```bash
  git clone https://github.com/antares-23/TODO.git
```

Go to the project directory

```bash
  cd TODO
```
Import database

Create a new database in your server, preferably named "db_todo"
Project database is located in main TODO directory, filename "db_todo.sql"

On console:

```bash
  mysql -u username -p database_name < db_todo.sql
```
Using PhpmyAdmin

- Create a new Database in "Databases" on top menu
- Select import database on top menu
- Select sql file to import
- Click import


Configure Database on TODO/db/config.php

Use the parameters from your MySQL Server

```bash
    $todoHost="your DB host";
    $todoDB="your DB";
    $todoUser="your DB username";
    $todoPass=" your DB pass"
```


## Login

There are by default two users for testing and administration

Administrator:

```bash
     user: admin@mail.com
     pass:123456   
    
```
User:

```bash
     user: user@mail.com
     pass:123456   
    
```

With Admin you can manage all TODOS from all users and administrate users, with user account ypu can only create and administrate your TODOs.
