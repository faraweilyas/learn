<?php

namespace Blaze\Core;

use Symfony\Component\Routing\Route;
use Blaze\App\Controllers\BlogController;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * 
 */
class Router
{

	// Responds to HTTP verbs
	// Route::get($uri, $callback);
	// Route::post($uri, $callback);
	// Route::put($uri, $callback);
	// Route::patch($uri, $callback);
	// Route::delete($uri, $callback);
	// Route::options($uri, $callback);
	// Route::any($uri, $callback);
	// get, post etc
	// Route::match([$verbs], $uri, $callback);
	// 
	// Route::redirect('/here', '/there');
	// Route::redirect('/here', '/there', 301);
	// Route::permanentRedirect('/here', '/there');
	// Route::view('/welcome', 'welcome');
	// Route::view('/welcome', 'welcome', ['name' => 'Taylor']);
	// 
	// Route::get('posts/{post}/comments/{comment}', $callback($postId, $commentId));
	// Route::get('user/{name?}', function ($name = null) {
	//     return $name;
	// });
	// Route::get('user/{name?}', function ($name = 'John') {
	//     return $name;
	// });
	// Route::get('user/{name}', function ($name) {
    //
	// })->where('name', '[A-Za-z]+');

	// Route::get('user/{id}', function ($id) {
	//     //
	// })->where('id', '[0-9]+');

	// Route::get('user/{id}/{name}', function ($id, $name) {
	//     //
	// })->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
	// Encoded Forward Slashes are only supported within the last route segment.
	// Route::get('search/{search}', function ($search) {
	//     return $search;
	// })->where('search', '.*');
	// Route::get($uri, $callback)->name('profile');
	// Route::get('user/profile', 'UserProfileController@show')->name('profile');
	// Generating URLs...
	// $url = route('profile');
	// Generating Redirects...
	// return redirect()->route('profile');
	// Route::get('user/{id}/profile', function ($id) {
    //
	// })->name('profile');
	// $url = route('profile', ['id' => 1]);
	// Route::middleware(['first', 'second'])->group(function () {
	//     Route::get('/', function () {
	//         // Uses first & second Middleware
	//     });
	//     Route::get('user/profile', function () {
	//         // Uses first & second Middleware
	//     });
	// });
	// In order to ensure your subdomain routes are reachable, you should register subdomain routes before registering root domain routes. This will prevent root domain routes from overwriting subdomain routes which have the same URI path.
	// Route::domain('{account}.myapp.com')->group($routes);
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
	// Route::namespace('Admin')->group($routes);
	// Route::prefix('admin')->group($routes);
	// Route::prefix('admin')->name('admin.')->group($routes);
	// Route::name('admin.')->group(function () {
	//     Route::get('users', function () {
	//         // Route assigned name "admin.users"...
	//     })->name('users');
	// });
	// $route = Route::current();
	// $name = Route::currentRouteName();
	// $action = Route::currentRouteAction();
	

    /**
     * Convert the route to a Symfony route.
     *
     * @return \Symfony\Component\Routing\Route
     */
    public function toSymfonyRoute()
    {
        return new SymfonyRoute(
            preg_replace('/\{(\w+?)\?\}/', '{$1}', $this->uri()), $this->getOptionalParameterNames(),
            $this->wheres, ['utf8' => true, 'action' => $this->action],
            $this->getDomain() ?: '', [], $this->methods
        );
    }

    /**
     * Determine if the route only responds to HTTP requests.
     *
     * @return bool
     */
    public function httpOnly()
    {
        return in_array('http', $this->action, true);
    }

    /**
     * Determine if the route only responds to HTTPS requests.
     *
     * @return bool
     */
    public function httpsOnly()
    {
        return $this->secure();
    }

    /**
     * Determine if the route only responds to HTTPS requests.
     *
     * @return bool
     */
    public function secure()
    {
        return in_array('https', $this->action, true);
    }

    /**
     * Get or set the domain for the route.
     *
     * @param  string|null  $domain
     * @return $this|string|null
     */
    public function domain($domain = null)
    {
        if (is_null($domain)) {
            return $this->getDomain();
        }

        $this->action['domain'] = $domain;

        return $this;
    }

    /**
     * Get the domain defined for the route.
     *
     * @return string|null
     */
    public function getDomain()
    {
        return isset($this->action['domain'])
                ? str_replace(['http://', 'https://'], '', $this->action['domain']) : null;
    }

	public static function handle()
	{
		// _controller
		// _format
		// _fragment
		// _locale

		print "<p>=== First Route Collection ===</p>";
		$firstRouteCollection = new RouteCollection();
		$firstRouteCollection->add('blog_show', new Route('/blog/{slug}', ['_controller' => BlogController::class]));
		$firstRouteCollection->add('blog_new', new Route('/blog/{slug}/{id}', ['_controller' => BlogController::class]));
		$firstRouteCollection->setHost('{domain}.framework.whitegold.local', ['domain' => 'api']);
		$firstRouteCollection->addPrefix('/api');
		$firstRouteCollection->addNamePrefix('api_');
		dump($firstRouteCollection->all());

		print "<p>=== Second Route Collection ===</p>";
		$secondRouteCollection = new RouteCollection();
		$secondRouteCollection->add('blog_show', new Route(
			'blog/{slug}',
			[
				'_controller' => [BlogController::class, "show"],
			]
		));
		$secondRouteCollection->add('blog_new', new Route(
			'/blog/{slug}/{id}',
			[
				'_controller' => [BlogController::class, "new"],
				'id' => 1
			]
		));
		$secondRouteCollection->add('blog_edit', new Route(
			'/blog/edit/{id}',
			[
				'_controller' => function()
				{
					return [BlogController::class, "edit"];
				},
			],
			[
				'id' => '\d+'
			]
		));
		dump($secondRouteCollection->all());

		print "<p>=== All Route Collection ===</p>";
		$firstRouteCollection->addCollection($secondRouteCollection);
		dump($firstRouteCollection->all());

		print "<p>=== Request Context ===</p>";
		$context = new RequestContext();
		dump($context);

		try {

			print "<p>=== Match Route Collection ===</p>";
			// Routing can match routes with incoming requests
			$matcher = new UrlMatcher($firstRouteCollection, $context);
			// $parameters = $matcher->match('/blog/lorem-ipsum');
			// dump($parameters);
			$parameters = $matcher->match('/blog/3');
			dump($parameters);
			$parameters = $matcher->match('/blog/lorem-ipsum/7');
			dump($parameters);

			print "<p>=== Generate Url ===</p>";
			// Routing can also generate URLs for a given route
			$generator = new UrlGenerator($firstRouteCollection, $context);
			$url = $generator->generate('blog_show', [
			    // 'slug' => 'my-blog-post',
			    'slug' => '3',
			]);
			dump($url);

			$url = $generator->generate('blog_new', [
			    'slug' => 'my-blog-post-y',
			    // 'id' => 4,
			]);
			dump($url);
		} catch(Exception $e)
		{
			dump($e->getMessage());
		}
	}
}
