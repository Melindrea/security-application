security application
=============

This is a project to showcase implementation of security measures in web applications

## Installation
This project is built in Laravel, which is a “PHP framework for artisans”, per their homepage http://laravel.com/ It requires a MySQL database and PHP 5.4+, with the PHP Mcrypt and XSL extensions installed. To run, it requires that the components have been installed, using [Composer](https://getcomposer.org/). Once Composer is installed, run `php composer.phar install` in the root of the project.

In development, it also requires the following components to be installed on the system:
* NPM (for Bower and Grunt)
* Ruby (for Sass with Compass)

The alternate way of dealing with the requirements to run and install an appropriate environment is to use Vagrant and the included Vagrantfile (building a box based on VirtualBox, using Ubuntu 12.04 Precise 32bits). This installation guide assumes that you are not using the included Vagrantfile, and that you are not interested in developing the frontend of the site, but rather focus on the middle- and backend with `PHP` and `MySQL`.

### Database
The database should be named `secapp`, and the system expects a user by the name of `root` with the password `password`. This is obviously a development setting, as in production one would use a more limited user with a far more secure password.

Laravel itself deals with the nitty-gritty of versioning-controlling the tables, so in the root folder of the project, in the terminal, run first `php laravel migrate` and then `php laravel db:seed`. The first command creates the tables `users`, `migrations`, `sessions` and `messages`, where `migrations` is a system table dealing with above-mentioned version control and `sessions` hold the current active sessions. The second command creates a few rows in the tables, to give a starting set of data.

### Server
To test most of the code, you can use the command `php laravel serve` in the root folder of the project, in the terminal, but the basic PHP server **does not** deal with SSL at all. In `setup` you can find the file `security-application.dev`, which is the Apache2 config file used by Vagrant, which can serve as a template.

Ensure you have created the folder `app/storage` and that it is writable by the server.

### Troubleshooting
If there are issues running the project, the most common one has to to do with permissions. The error messages are left to run in development, but are turned off by default in a production environment.

### Vagrant-specific details
* Domain: security-application.dev
* IP: 192.168.33.10

## Author(s)
* Marie Hogebrandt <iam@mariehogebrandt.se> (http://mariehogebrandt.se)
