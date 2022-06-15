<?php
namespace Julianschmuckli\Restwork\Helper;

class HttpResponse
{
    private int $status = 500;
    private string $message = "Nothing specified as message.";
    private mixed $body = null;

    /**
     * Creates the response object.
     * @param {int} $status The status of the message, like in the schema of the HTTP status codes.
     */
    public function __construct(int $status)
    {
        $this->status = $status;
    }

    /**
     * Sets the message of the response object.
     * @param {string} $message The message, which describes the type of operation.
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * Sets the content of the response object.
     * @param {mixed} $body The content body.
     */
    public function setBody(mixed $body)
    {
        $this->body = $body;
    }

    /**
     * Returns the content of the response object.
     * @return {mixed} The body content
     */
    public function getBody() : mixed
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

    /**
     * Sets the default headers.
     */
    private function setHeaders() {
        header("Content-Type: application/json");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    }
}
