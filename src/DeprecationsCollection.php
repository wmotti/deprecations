<?php
namespace Deprecations;

class DeprecationsCollection implements \IteratorAggregate
{
    private $collection;

    public function __construct($packages) {
        foreach($packages as $package)
        {
            foreach ($package['deprecations'] as $deprecation)
                $collection[] = new Deprecation($package['name'], $deprecation['version'], $deprecation['reason'], $deprecation['resources']);
        }
        $this->collection = $collection;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }
}
