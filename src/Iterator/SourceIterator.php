<?php

namespace Lns\SocialFeed\Iterator;

use Lns\SocialFeed\SourceInterface;

/**
 * Iterate over source posts
 */
class SourceIterator implements \Iterator
{
    public $currentResultSet = null;
    public $position = 0;

    /**
     * __construct
     *
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    public function current()
    {
        if($this->position == 0) {
            $this->loadNextResultSet();
        }

        return $this->currentResultSet->getIterator()->current();
    }

    public function key()
    {
        return $this->position;
    }

    protected function loadNextResultSet() {
        if($this->currentResultSet && !$this->currentResultSet->hasNextResultSet()) {
            $this->currentResultSet = false;
            $this->position++;
            return false;
        }

        $provider = $this->source->getProvider();

        $options = $this->source->getOptions();

        // merge options
        if($this->currentResultSet) {
            $options = array_merge($options, $this->currentResultSet->getNextResultSetOptions());
        }

        $this->currentResultSet = $provider->getResult($options);

        return true;
    }

    public function next()
    {
        $this->currentResultSet->getIterator()->next();

        if(!$this->currentResultSet->getIterator()->valid()) {
            $this->loadNextResultSet();
        }

        $this->position++;
    }

    public function valid()
    {
       return ($this->position == 0) || $this->currentResultSet != false;
    }

    public function rewind()
    {
        $this->currentResultSet = null;
        $this->position = 0;
    }
}