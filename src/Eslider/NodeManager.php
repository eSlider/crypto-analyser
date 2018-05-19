<?php

namespace Eslider;

class NodeManager
{
    /**
     * @var array NodeService
     */
    protected $list = [];

    public function __construct(array $nodeInfos)
    {
        foreach ($nodeInfos as $nodeInfo) {
            $node         = new NodeService($nodeInfo);
            $this->list[] = $node;
        }
    }

    public function getStatus(): array
    {
        $r = [];
        foreach ($this->list as $node) {
            $status         = $node->getStatus();
            $url            = parse_url($node->apiUrl);
            $status['name'] = $url['host'];
            $r[]            = $status;
        }
        return $r;
    }
}
