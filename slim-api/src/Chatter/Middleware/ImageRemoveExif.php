<?php

namespace Chatter\Middleware;

class ImageRemoveExif
{
    public function __invoke($request, $response, $next)
    {

		// dd($request->getAttribute('routeInfo'));
		// $imagePath 	= "";
		// $newfile 	= $request->getUploadedFiles()['file'];
		// if (!is_null($newfile) AND $newfile->getError() === UPLOAD_ERR_OK)
		// {
		// $uploadFileName = $newfile->getClientFilename();
		// $imagePath 		= "assets/images/{$uploadFileName}";
		// $newfile->moveTo($imagePath);
		// }
        $file 		= $request->getUploadedFiles()['file'];
        $pngfile 	= "";
	    if (!is_null($file) AND $file->getError() === UPLOAD_ERR_OK)
	    {
	        $fileType 	= $file->getClientMediaType();
	        $fileName 	= $file->getClientFilename();
	        $pngfile 	= "assets/images/" . substr($fileName, 0, -4) . ".png";
	        $file->moveTo("assets/images/raw/$fileName");

	        if ('image/jpeg' == $fileType) {
	            $image = imagecreatefromjpeg("assets/images/raw/$fileName");
	            imagepng($image, $pngfile);
	        }
	    }

        $request = $request->withAttribute('filename', $pngfile);
        return $next($request, $response);
    }
}
