<?php

function getPostFile(\Slim\Http\Request $request)
{
    $files = $request->getUploadedFiles();
    $uploadedFiles = array_values($files);
    if (count($uploadedFiles) != 1){
        badFormat();
    }
    /**
     * @var UploadedFile $uploadFile 
     */
    $uploadFile = $uploadedFiles[0];
    return $uploadFile->file;
}

function getDemoFile($args)
{
    return "jpeg.jpg";
    if (!key_exists("filename", $args))
    {
        badFormat();
    }
    $filename = $args['filename'];
    if (!file_exists($filename))
    {
        notFound ();        
    }
    return $filename;
}

function forbidden()
{
    http_response_code (403);
    exit(); 
}

function badFormat($errormessage)
{
    header("HTTP/1.0 400 $errormessage");    
    exit();
}

function notFound()
{
    header("HTTP/1.0 404 Not Found");
    exit();
    
}