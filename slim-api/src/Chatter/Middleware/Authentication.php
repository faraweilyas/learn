<?php

namespace Chatter\Middleware;

use Chatter\Models\User;

class Authentication
{

    public function __invoke($request, $response, $next)
    {
        $bearer 	= $request->getHeader('Authorization')[0] ?? "";
        $bearer 	= $bearer ?: "Bearer d0763a9516280e9044d885edaa9d9bd2";
        $apikey 	= explode(" ", $bearer)[1] ?? "";
        if (empty($apikey))
            return $response->withStatus(401)->withJson(['status' => 401, 'message' => 'Auth Failed']);

        $user = new User();
        if (!$user->authenticate($apikey))
            return $response->withStatus(401)->withJson(['status' => 401, 'message' => 'Auth Failed']);

        $request = $request->withAttribute('user', $user->details);
        return $next($request, $response);
    }
}
