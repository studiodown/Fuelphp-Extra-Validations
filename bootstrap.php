<?php

/**
 * is_email (FuelPHP Package)
 *
 * This allows you to use the is_email function with the Validation class in the FuelPHP Framework.
 *
 * @package		is_email (FuelPHP Package)
 * @version		1.0
 * @author		Luke Armstrong <lukea@propcom.co.uk>
 * @copyright	2012 Propeller Communications
 * @license		http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link		https://github.com/propcom/fuel-is_email/
 */

/**
 * @package     is_email
 * @version		3.01.1 - Fixed examples and readme.txt
 * @author      Dominic Sayers <dominic@sayers.cc>
 * @copyright	2008-2011 Dominic Sayers
 * @license		http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link		http://www.dominicsayers.com/isemail
 */


Autoloader::add_core_namespace('Extra_Validation');

Autoloader::add_classes(array(
	'Extra_Validation\\Validation' => __DIR__.'/classes/validation.php',
));

