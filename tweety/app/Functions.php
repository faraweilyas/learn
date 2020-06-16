<?php

use App\User;

/**
 * Prevents file caching for javascript or css files by adding last modified timestamp.
 *
 * @param string $file
 * @return string
 */
function preventFileCaching($file=NULL) : string
{
    $file       = "/".ltrim($file, "/");
    $filePath   = public_path().$file;
    if (!file_exists($filePath))
        return $file;

    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
    if (in_array($fileExtension, ['css', 'js', 'png', 'jpeg', 'jpg'])):
        $lastTimeModified   = filemtime($filePath);
        $file               .= "?mod={$lastTimeModified}";
    endif;
    return $file;
}

/**
 * Overrides default asset function to prevent file caching.
 *
 * @param string $asset
 * @return string
 */
function pc_asset($asset=NULL) : string
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

/**
 * Removes some part of a given string starting from the end
 *
 * @param string $value
 * @param int $length
 * @return string
 */
function stripper(string $value, int $length=1) : string
{
    $valueLength = strlen(trim($value));
    return substr($value, 0, $valueLength - $length);
}

/**
 * Formats a given amount
 *
 * @param string $digit
 * @param bool $round
 * @param mixed $prefix
 * @return string
 */
function formatAmount(string $digit, bool $round=FALSE, $prefix="&#8358;") : string
{
    if (empty($digit)) return "{$digit}";
    if (!$round)
        return $prefix.number_format($digit, 2, '.', ',');
    else
        return stripper($prefix.number_format($digit, 2, '.', ','), 3);
}

/**
 * Gets user for friends list
 *
 * @param mixed null|User $user
 * @return \App\User
 */
function user_profile($user=NULL) : User
{
    return is_object($user) ? $user : auth()->user();
}
