<?php
namespace Julianschmuckli\Restwork;

class ErrorService implements Service
{
    private $status, $message;


    public function __construct($status, $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    public function setup()
    {
    }

    public function output(): HttpResponse
    {
        $response = new HttpResponse($this->status);
        $response->setMessage($this->message);
        return $response;
    }
}
