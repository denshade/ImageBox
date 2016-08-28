<?php


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

function badFormat()
{
    http_response_code (400);
    exit();
}

function notFound()
{
    header("HTTP/1.0 404 Not Found");
    exit();
    
}