<?php
namespace X\Service\Youtube;
class ListResult implements \ArrayAccess, \Iterator, \Countable {
    /** @var array */
    private $data = array();
    /** @var string */
    public $nextPageToken = null;
    /** @var string */
    public $prevPageToken = null;
    /** @var int */
    public $totalCount = null;
    /** @var int */
    public $pageSize = null;
    
    /** @param array $data */
    public function __construct( $data ) {
        $this->data = $data;
    }
    
    /**
     * {@inheritDoc}
     * @see Countable::count()
     */
    public function count() {
        return count($this->data);
    }

    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetExists()
     */
    public function offsetExists($offset) {
        return array_key_exists($offset, $this->data);
    }

    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetGet()
     */
    public function offsetGet($offset) {
        return $this->data[$offset];
    }

    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value) {
        $this->data[$offset] = $value;
    }

    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }
    
    /**
     * {@inheritDoc}
     * @see Iterator::current()
     */
    public function current() {
        return current($this->data);
    }

    /**
     * {@inheritDoc}
     * @see Iterator::next()
     */
    public function next() {
        next($this->data);
    }

    /**
     * {@inheritDoc}
     * @see Iterator::key()
     */
    public function key() {
        return key($this->data);
    }

    /**
     * {@inheritDoc}
     * @see Iterator::valid()
     */
    public function valid() {
        return null !== key($this->data);
    }

    /**
     * {@inheritDoc}
     * @see Iterator::rewind()
     */
    public function rewind() {
        reset($this->data);
    }
}