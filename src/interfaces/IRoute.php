<?php
namespace Julianschmuckli\Restwork;

interface Route
{
    /**
     * The input event of the route, with the receiving data from the depending HTTP method.
     */
    public function input($data);

    /**
     * The output of the route.
     */
    public function output(): ?HttpResponse;
}
