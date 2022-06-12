<?php
namespace Julianschmuckli\Restwork\Helper;

class HttpResponse
{
    private $status = 500;
    private $message = "Nothing specified as message.";
    private $body = null;

    /**
     * Creates the response object.
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Sets the message of the response object.
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Sets the content of the response object.
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Returns the content of the response object.
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Prints the response object.
     */
    public function output()
    {
        $jsonData = array(
            "status" => $this->status,
            "message" => $this->message,
        );

        if ($this->body !== null) {
            $jsonData["body"] = $this->body;
        }

        $this->setHeaders();
        echo json_encode($jsonData);
    }

    private function setHeaders() {
        header("Content-Type: application/json");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    }
}
