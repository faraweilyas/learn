<?php

namespace Chatter\Middleware;

use Aws\S3\S3Client;

class FileMove
{
    public function __invoke($request, $response, $next)
    {
        // $s3 = new S3Client([
        //     'version' => 'latest',
        //     'region'  => 'us-west-2'
        // ]);

        // $file 		= $request->getUploadedFiles()['file'];
        // $fileName 	= $file->getClientFilename();
        // $pngFile	= "assets/images/" . substr($fileName, 0, -4) . ".png";

        // try {
        //     $s3->putObject([
        //         'Bucket' => 'my-bucket',
        //         'Key'    => 'my-object',
        //         'Body'   => fopen($pngFile, 'w'),
        //         'ACL'    => 'public-read',
        //     ]);
        // } catch (Exception $e) {
        //     return $response->withStatus(400);
        // }
        return $next($request, $response);
    }
}
