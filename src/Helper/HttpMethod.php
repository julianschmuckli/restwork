<?php
namespace Julianschmuckli\Restwork\Helper;

enum HttpMethod: String
{
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case DELETE = "DELETE";
    case OPTIONS = "OPTIONS";
}