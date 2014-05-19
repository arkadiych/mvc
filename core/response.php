<?php

class Response
{
    protected $output;

    public function __construct($output = '')
    {
        $this->output = $output;
    }

    public function getOutput()
    {
        return $this->output;
    }

}