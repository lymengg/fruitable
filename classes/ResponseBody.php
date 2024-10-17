<?php
class ResponseBody
{

    private $success;
    private $code;
    private $body;

    function __construct($code, $success, $body)
    {
        $this->code = $code;
        $this->success = $success;
        $this->body = $body;
    }

    function set_success($success)
    {
        $this->success = $success;
    }

    function set_code($code)
    {
        $this->code = $code;
    }

    function set_body($body)
    {
        $this->body = $body;
    }

    function get_success()
    {
        $this->success;
    }

    function get_code()
    {
        $this->code;
    }

    function get_body()
    {
        return $this->body;
    }
}
