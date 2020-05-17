<?php

error_reporting(E_ALL);

use DI\Container;
use App\Facades\Route;
use Blaze\Core\Router;
use Blaze\Core\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/vendor/autoload.php';

$config 				= [
	"env" 				=> 'dev', // dev | prod
	"APP_ENV" 			=> 'dev', // dev | prod
	"APP_DEBUG" 		=> FALSE, // false | true
	"definitions" 		=> __DIR__.'/config.php',
	"useAutowiring"  	=> TRUE,
	"useAnnotations"  	=> FALSE,
	"compilationDir" 	=> __DIR__.'/cache',
	"writeProxies"  	=> TRUE,
	"proxiesDir" 		=> __DIR__.'/cache/proxies',
];

$app = new Application($config);
dump(
	$app->container
	// , $app->get(Request::class)
	// , $app->get(Container::class)
	// , $app->get(Response::class)
	// , $app->get(Router::class)
	// , $app->get('FooBar')
);

// Route::get('/');
// Router::handle();

// Dependency Injection (DI) & Inversion of control (IoC)

interface ValidatorInterface
{
	public function setError(string $error) : ValidatorInterface;

	public function emptyErrors() : ValidatorInterface;

	public function getErrors() : array;

	public function getResult() : bool;

	public function validate(User $user) : bool;
}

class UserValidator implements ValidatorInterface
{
	public $errors = [];

	public function setError(string $error) : ValidatorInterface
	{
		$this->errors[] = $error;
		return $this;
	}

	public function emptyErrors() : ValidatorInterface
	{
		$this->errors = [];
		return $this;
	}

	public function getErrors() : array
	{
		return $this->errors;
	}

	public function getResult() : bool
	{
		return (empty($this->getErrors())) ? TRUE : FALSE;
	}

	public function validate(User $user) : bool
	{
		$this->emptyErrors();

		if (empty($user->firstName))
			$this->setError("Please add your first name");

		if (empty($user->lastName))
			$this->setError("Please add your last name");

		return $this->getResult();
	}
}

class AdminUserValidator extends UserValidator
{
	public function validate(User $user) : bool
	{
		parent::validate($user);

		if (strlen($user->password) < 5)
			$this->setError("Please minimum length of paassword is 5");

		return $this->getResult();
	}
}

interface UserValidationInterface
{
	public function isValid() : bool;

	public function getErrors() : array;
}

class UserValidation implements UserValidationInterface
{
	public function __construct(User $user, ValidatorInterface $userValidator)
	{
		$this->user 			= $user;
		$this->userValidator 	= $userValidator;
	}

	public function isValid() : bool
	{
		return $this->userValidator->validate($this->user);
	}

	public function getErrors() : array
	{
		// Validate before getting errors
		$this->userValidator->validate($this->user);
		return $this->userValidator->getErrors();
	}
}

class User
{
	public function __construct()
	{
		$this->id 			= 1;
		$this->accountType 	= "admin";
		$this->firstName 	= "iLyas";
		$this->lastName 	= "Farawe";
		$this->email 		= "faraweilyas@gmail.com";
		$this->sex 			= "Male";
		$this->dob 			= "01-10-1995";
		$this->password 	= "xxxxx";
	}

	public function getName() : string
	{
		return trim("{$this->firstName} {$this->lastName}");
	}
}

class UserController
{
	public function __construct()
	{
		$this->user = new User;
		// $this->userValidation = new UserValidation($this->user, new UserValidator);
		$this->userValidation = new UserValidation($this->user, new AdminUserValidator);
	}

	public function index()
	{
		dump($this->user);
		echo "Is ".$this->user->getName()." valid: ".($this->userValidation->isValid() ? "Yes!" : "No!");
		dump($this->userValidation->getErrors());
	}
}

(new UserController)->index();

// Dynamic method calling

class WebHookController
{
	public function handle($request)
	{
		$type 		= str_replace("_", "", ucwords($request->type, "_"));
		$handler 	= "handle{$type}";
		if (method_exists($this, $handler)) {
			$this->{$handler}($request);
		} else {
			$this->handleInvalidPayload($request);
		}
	}

	protected function handleInvalidPayload($request)
	{
		dump("handle invalid payload");
	}

	protected function handleCardInvalid($request)
	{
		dump("handle invalid card");
	}

	protected function handleCardDeclined($request)
	{
		dump("handle declined card");
	}

	protected function handleSubscriptionCanceled($request)
	{
		dump("handle canceled subscription");
	}
}

trait ExposesShortName
{
	public function getShortName()
	{
		return (new ReflectionClass($this))->getShortName();
	}
}

abstract class PaymentException extends Exception
{
	use ExposesShortName;

	abstract public function getResponse() : string;
}

class InvalidPayload extends PaymentException
{
	public function getResponse() : string
	{
		return "Payload was invalid";
	}
}

class CardInvalid extends PaymentException
{
	public function getResponse() : string
	{
		return "Card was invalid";
	}
}

class CardDeclined extends PaymentException
{
	public function getResponse() : string
	{
		return "Card was declined";
	}
}

class SubscriptionCanceled extends PaymentException
{
	public function getResponse() : string
	{
		return "Subscription has been canceled";
	}
}

class PaymentController
{
	public function store($request)
	{
		try {

			$this->makePayment($request);

		} catch (PaymentException $exception) {

			if (method_exists($this, $handler = "handle".$exception->getShortName())) {
				$this->{$handler}($exception);
			}
		}
	}

	protected function makePayment($request)
	{
		if (class_exists($type = str_replace("_", "", ucwords($request->type, "_")))) {
			throw new $type;
		} else {
			throw new InvalidPayload;
		}
	}

	protected function handleInvalidPayload(Exception $exception)
	{
		// dump($exception->getMessage());
		dump($exception->getResponse());
	}

	protected function handleCardInvalid(Exception $exception)
	{
		dump($exception->getResponse());
	}

	protected function handleCardDeclined(Exception $exception)
	{
		dump($exception->getResponse());
	}

	protected function handleSubscriptionCanceled(Exception $exception)
	{
		dump($exception->getResponse());
	}
}

$types 		= ['card_invalid', 'card_declined', 'subscription_canceled'];
$request 	= (object) [
	'user' 	=> (object) [
		'id' => 1,
		'name', 'iLyas',
		'sex', 'Male',
		'dob', '01-10-1995',
	],
	'type' 	=> $types[(int) ($_GET['id'] ?? 0)] ?? 0,
];
$controller = new WebHookController();
$controller->handle($request);

$controller = new PaymentController();
$controller->store($request);

exit;

class Database
{
	public function __construct(string $host, int $port, string $username, string $password, string $databaseName)
	{
		$this->host 		= $host;
		$this->port 		= $port;
		$this->username 	= $username;
		$this->password 	= $password;
		$this->databaseName = $databaseName;
	}
}

class SQLQueryBuilder
{
	public function __construct(Database $database)
	{
		$this->database = $database;
	}
}

class Model 
{
	public function __construct(SQLQueryBuilder $queryBuilder)
	{
		$this->queryBuilder = $queryBuilder;
	}
}

class Property extends Model
{
	// 
}
