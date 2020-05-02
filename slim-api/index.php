<?php

include 'bootstrap.php';

use Chatter\Models\Message;
use Chatter\Middleware\Logging as ChatterLogging;
use Chatter\Middleware\Authentication as ChatterAuth;
use Chatter\Middleware\FileFilter;
use Chatter\Middleware\FileMove;
use Chatter\Middleware\ImageRemoveExif;

$app = new \Slim\App();
$app->add(new ChatterAuth());
$app->add(new ChatterLogging());

$app->group('/v1' , function() use ($app)
{
    $app->group('/messages', function()
    {
		$this->map(['GET'], '', function($request, $response, $args)
		{
		    $_message 	= new Message();
		    $messages 	= $_message->all();
		    $payload 	= [];
		    foreach ($messages as $message)
		    {
		        $payload[$message->id] = $message->output();
		    }
		    return $response->withStatus(200)->withJson($payload);
		})->setName('get_messages');

		$this->map(['POST'], '', function($request, $response, $args)
		{
		    $message 			= new Message();
		    $message->user_id 	= $request->getAttribute('user')->id;
		    $message->body 		= $request->getParsedBodyParam('message', '');
			$message->image_url = $request->getAttribute('filename');
		    $message->save();

		    if ($message->id) {
		        $payload = [
		        	'message_id' 	=> $message->id,
		            'href' 			=> "/messages/{$message->id}",
		            'user_id' 		=> $message->user_id,
		            'body' 			=> $message->body,
		            'image_url' 	=> $message->image_url
		        ];
		        return $response->withStatus(201)->withJson($payload);
		    } else {
		        return $response->withStatus(400);
		    }
		})->add(new FileFilter())->add(new ImageRemoveExif())->setName('create_messages');

		$this->map(['DELETE'], '/{message_id}', function($request, $response, $args)
		{
		    $message = Message::find($args['message_id']);
		    if (!$message) return $response->withStatus(400);
		    $message->delete();

		    if ($message->exists) {
		        return $response->withStatus(400);
		    } else {
		        return $response->withStatus(204);
		    }
		})->setName('delete_message');
	});
});

$app->group('/v2' , function() use ($app)
{
    $app->group('/messages', function()
    {
		$this->map(['GET'], '', function($request, $response, $args)
		{
		    $_message 	= new Message();
		    $messages 	= $_message->all();
		    $payload 	= [];
		    foreach ($messages as $message)
		    {
		        $payload[$message->id] = $message->output();
		    }
		    return $response->withStatus(200)->withJson($payload);
		})->setName('get_messages');

		$this->map(['POST'], '', function($request, $response, $args)
		{
		    $message 			= new Message();
		    $message->user_id 	= 1;
		    $message->body 		= $request->getParsedBodyParam('message', '');
			$message->image_url = $request->getAttribute('filename');
		    $message->save();

		    if ($message->id) {
		        $payload = [
		        	'message_id' 	=> $message->id,
		            'href' 			=> "/messages/{$message->id}",
		            'user_id' 		=> $message->user_id,
		            'body' 			=> $message->body,
		            'image_url' 	=> $message->image_url
		        ];
		        return $response->withStatus(201)->withJson($payload);
		    } else {
		        return $response->withStatus(400);
		    }
		})->add(new FileFilter())->add(new ImageRemoveExif())->add(new FileMove())->setName('create_messages');

		$this->map(['DELETE'], '/{message_id}', function($request, $response, $args)
		{
		    $message = Message::find($args['message_id']);
		    if (!$message) return $response->withStatus(400);
		    $message->delete();

		    if ($message->exists) {
		        return $response->withStatus(400);
		    } else {
		        return $response->withStatus(204);
		    }
		})->setName('delete_message');
	});
});

$app->run();
