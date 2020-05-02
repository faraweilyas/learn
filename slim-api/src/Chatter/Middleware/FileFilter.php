<?php

namespace Chatter\Middleware;

class FileFilter
{
    protected $allowedFiles = ['image/jpeg', 'image/png'];

    public function __invoke($request, $response, $next)
    {
        $file 		= $request->getUploadedFiles()['file'];
        $fileType 	= $file->getClientMediaType();
        if (!in_array($fileType, $this->allowedFiles)) {
            return $response->withStatus(415);
        }

        return $next($request, $response);
    }
}
