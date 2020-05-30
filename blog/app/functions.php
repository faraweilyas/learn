<?php

/**
 * Prevents file caching for javascript or css files by adding last modified timestamp.
 *
 * @param string $file
 * @return string
 */
function preventFileCaching(string $file='') : string
{
    $file       = "/".ltrim($file, "/");
    $filePath   = __DIR__.'/../public'.$file;
    if (file_exists($filePath)):
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        if (in_array($fileExtension, ['css', 'js'])):
            $lastTimeModified = filemtime($filePath);
            $file .= "?mod={$lastTimeModified}";
        endif;
    endif;
    return $file;
}

/**
 * Overrides default asset function to prevent file caching.
 *
 * @param string $asset
 * @return string
 */
function pc_asset(string $asset=NULL) : string
{
    return asset(preventFileCaching($asset));
}

/**
 * Activate selected link.
 *
 * @param string $path
 * @return string
 */
function activateLink(string $path) : string
{
    return (Request::path() == $path) ? " class='current_page_item'" : "";
}
