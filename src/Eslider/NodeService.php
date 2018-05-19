<?php

namespace Eslider;

class NodeService
{
    /** @var string API Node URL */
    public $apiUrl;

    /**
     * NodeService constructor.
     *
     * @param $args
     */
    public function __construct($args)
    {
        foreach ($args as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Query node
     *
     * @param string $args
     * @param bool   $json Convert JSON result to Array?
     * @return string|array
     */
    public function query($args, $json = true)
    {
        $url      = $this->apiUrl . rawurlencode($args);
        $contents = file_get_contents($url);
        if ($json) {
            $contents = json_decode($contents, true);
        }
        return $contents;
    }

    /**
     * Get node status info
     *
     * @return array|string
     */
    public function getStatus()
    {
        return $this->query('mnsync status');
    }

    /**
     * Get node name
     *
     * @return string
     */
    public function getName()
    {
        $url            = parse_url($this->apiUrl);
        $status['name'] = $url['host'];
        return $url['host'];
    }
}