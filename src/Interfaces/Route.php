<?php
namespace Julianschmuckli\Restwork\Interfaces;
use Julianschmuckli\Restwork\Helper\HttpResponse;

interface Route
{
    /**
     * The input event of the route, with the receiving data from the depending HTTP method.
     * @param {array} $data An associative array with the data from $_POST or $_GET or the php://input payload converted from JSON.
     */
    public function input($data);

    /**
     * The output of the route.
     * @return {?HttpResponse} The response object with necessary status and message, and the body with the actual data if needed.
     */
    public function output(): ?HttpResponse;
}
