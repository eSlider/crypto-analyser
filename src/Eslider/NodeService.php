<?php

namespace Eslider;

class NodeService
{

    public $apiUrl;

    public function __construct($args)
    {
        foreach ($args as $key => $value) {
            $this->{$key} = $value;
        }
    }


    /**
     * @param string $args
     * @return string
     */
    public function query($args)
    {
        $url = $this->apiUrl . rawurlencode($args);
        return file_get_contents($url);
    }

    public function getStatus()
    {
        return json_decode($this->query('mnsync status'), true);
    }
}