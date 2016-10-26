<?
session_start();


// Познать namespace и autoload я еще не успел - простите!
require_once (realpath("app/other/ValidationRules.php"));
require_once (realpath("app/other/Validator.php"));
require_once (realpath('app/other/Session.php'));
require_once (realpath('app/other/Database.php'));
require_once (realpath('app/controllers/Controller.php'));
require_once (realpath('app/controllers/RegistrationLockController.php'));
require_once (realpath('app/controllers/RegisterController.php'));
require_once (realpath('app/controllers/LoginController.php'));
require_once (realpath('app/models/User.php'));
