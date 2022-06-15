<?php
namespace Julianschmuckli\Restwork\Helper;

/**
 * The available HTTP methods for this framework
 */
enum HttpMethod: String
{
    /**
     * The HTTP GET method.
     */
    case GET = "GET";

    /**
     * The HTTP POST method.
     */
    case POST = "POST";

    /**
     * The HTTP PUT method.
     */
    case PUT = "PUT";

    /**
     * The HTTP DELETE method.
     */
    case DELETE = "DELETE";

    /**
     * The HTTP OPTIONS method.
     */
    case OPTIONS = "OPTIONS";
}
