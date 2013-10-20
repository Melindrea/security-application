## A1-Injection
The Database layer uses Eloquent, the default ORM in Laravel. One of the large advantages to how Laravel is built is that it allows to change what kind of database is used. This system uses MySQL, but it is easy to change it to using SQLite or other drivers. This is doable because it uses PDO and prepared statements. Because it uses those, it is by default more secure against SQL Injection, since the prepared statements will only accept the proper arguments.

For instance, if the `username` column in a table is a string, and the data supplied from the user is “test); DROP TABLE users”, that is exactly what the username column will recieve. It will not be interpreted as a command.

## A2-Broken Authentication and Session Management
As the system is implemented (using Laravel default session management), the session expires when the browser is closed. It will also close the session if the user goes to the route `users/logout`, after which the user will be redirected back to the main page. However, it is important to know that there is [a known feature/bug](https://productforums.google.com/d/msg/chrome/9l-gKYIUg50/HOvdZbPiuXAJ) in Chrome where if you have the setting “on startup” set to “continue where I left off”, the session *will not* be destroyed.

The sessions are stored in the database, in a table called `sessions`, created by laravel.

## A3-Cross-Site Scripting (XSS)
There are two different routes that the system takes to protect against XSS. Fields that should not contain HTML (and which won’t be hashed/encrypted) get `htmlspecialchars` used on them, whereas fields that are expected to contain HTML are stored as-is in the database.

Fields that are expected to contain a certain amount of HTML are then treated right before they’re outputted. I have defined an HTML macro (a functionality of Laravel) called `markdown` to clean and transform the specified string. The macro is called in the blade template where it is relevant, so the original data is not transformed.

Note that users are discouraged to use HTML in their posts and such, and instead encouraged to use [Markdown](http://daringfireball.net/projects/markdown/), using the original syntax to be able to work with client side scripts that output a preview of the markdown (the client side scripts are not implemented in this version).

The following steps are taken to protect against XSS:

1. Using a quite permissive list of allowed HTML elements (see `app/config/purifier.php`), it cleans the data, in particular removing “dangerous” attributes, using the [HTMLPurifier](http://htmlpurifier.org/). The only allowed attributes are `href`, `class`, `width`, `height`, `alt` and `src`. Style is forbidden not because it is particularly dangerous, but because it risks messing up the design, and all the `on*` attributes are forbidden as JavaScript should not be allowed. An important HTML element that is of course removed is `<script>`, for the same reasons as `on*` being forbidden.
2. [PHP Markdown](http://michelf.ca/projects/php-markdown/) is then used to transform markdown into HTML. This includes some encoding into HTML entities, in particular code contained in codeblocks.
3. Final step of the `HTML::markdown` macro is unrelevant to protecting against XSS, but quite relevant for a more pleasing style, namely using [PHP Typography](https://github.com/adamaveray/PHPTypography) to create “curly quotes” and similar things.

## A4-Insecure Direct Object References
At current there are few places where this would be a concern. The system does not use the traditional definition of directories (being an MVC framework), with the exception of the `assets` directory. However, all directories are protected using Apache2 from being listed.

In a future implementation, there will be files that can be accessed, but they will all be stored above the public folder and served using routes to protect them from being exposed to the public.

## A5-Security Misconfiguration
The weakest link at the moment is this one. Laravel supports setting up different configs depending on environment, which will be done before the system goes live but is not yet. One of the key components is that rather than showing an error trace in production, it will log the errors and report more cleaned-up ones to the user.

The beginnings of ensuring a repeatable development/deployment/testing/production environment has been setup using Vagrant and shell recipes, but not finalized.

## A6-Sensitive Data Exposure
In this system, the e-mail is protected by being encrypted in the database, and using SSL throughout the more sensitive areas. The e-mail is considered “sensitive” as it is the only way to really identify the user, as any other personal information is limited and opt-in only.

## A7-Missing Function Level Access Control
The current iteration of the system does not have more granulated user roles than logged in/guest, but the principles that are applied currently will apply once it does.

The controller `Authorized` uses filters defined in Laravel (the details of individual filters can be found in `app/filters.php`) to determine whether a request should be let through or not. Controllers inheriting `Authorized` (for instance the `Users` controller) defines a whitelist of actions that *does not* require a user to be logged in, and may optionally define a guestlist of actions that requires the user to *not* be logged in.

That is, unless a specified action is in the array of whitelisted actions, before the HTTP-request is served, Laravel checks whether the person is logged in. If they are not, they will be redirected to the `login` route. Once they’ve logged in, the system will attempt to return them to the page they originally attempted to reach. Examples of whitelisted routes are `login` and `users.create`.

On the other hand, if the action is whitelisted and in the guestlist, the system will check that they are not logged in before giving them access to it. After all, why should someone access the login route when they are already logged in?

## A8-Cross-Site Request Forgery (CSRF)
Another of Laravel’s builtin filters is a CSRF-token that is made automatically on each form created using Laravel HTML functions. The `Base` controller runs a similar filter to the `Authorized` controller, but where `Authorized` checks the user capabilities, `Base` runs the `csrf` filter on all post-actions. If the token does not match, it throws a TokenMismatchException.

## A9-Using Components with Known Vulnerabilities
To make it easier to keep track of which components are used where and to in the extension be able to write tasks to check everything against at least the more comprehensive databases, all components in PHP use Composer, and all frontend components use Bower.

One of the development components for PHP is the [Security Checker](https://packagist.org/packages/sensiolabs/security-checker) from SensioLabs, which using a [gist by Barry vd. Heuvel](https://gist.github.com/barryvdh/6696739) was made into a service for laravel. To check the Composer components against Sensiolabs database, run `php artisan security:check`.

Obviously, running automated checks may not catch all vulnerabilities, but they’re a good, automated tool to supplement occasional manual checks, and as all components are documented in either `composer.json` or `bower.json`, it is easier to track them. There is no mentioning of `package.json`, as the NPM modules are only used in development, not in a production environment.

## A10-Unvalidated Redirects and Forwards
Not applicable, as no redirects use data supplied from the user to indicate destination.