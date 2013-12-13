<?php
/**
 * App/Start/Global File.
 *
 * Calls to various global functions.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

/*
    Register The Artisan Commands
    --------------------------------------------------------------------------

     Each available Artisan command must be registered with the console so
     that it is available to be called. We'll register every command so
     the console gets access to each of the command object instances.

*/

Artisan::add(new Command\GenerateSitemapCommand());
