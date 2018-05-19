<?php

namespace Eslider;

class NodeManager implements \Iterator
{
    /**
     * @var array NodeService
     */
    protected $list = [];

    /**
     * NodeManager constructor.
     *
     * @param array $nodeInfos
     */
    public function __construct(array $nodeInfos)
    {
        foreach ($nodeInfos as $nodeInfo) {
            $node         = new NodeService($nodeInfo);
            $this->list[] = $node;
        }
    }

    /**
     * Return the current element
     *
     * @link  http://php.net/manual/en/iterator.current.php
     * @return NodeService
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->list);
    }

    /**
     * Move forward to next element
     *
     * @link  http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        next($this->list);
    }

    /**
     * Return the key of the current element
     *
     * @link  http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->list);
    }

    /**
     * Checks if current position is valid
     *
     * @link  http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        $nodeService = $this->current();
        return $nodeService !== false && $nodeService !== null;
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->list);
    }
}
