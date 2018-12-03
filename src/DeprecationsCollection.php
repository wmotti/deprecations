<?php
namespace Deprecations;

class DeprecationsCollection implements \IteratorAggregate
{
    private $collection;

    public function __construct($packages) {
        foreach($packages as $package)
        {
            foreach ($package['deprecations'] as $deprecation)
                $name = $package['name'];
                $version = $deprecation['version'];
                $deprecation = new Deprecation($package['name'], $deprecation['version'], $deprecation['reason'], $deprecation['resources']);
                if (array_key_exists('reason', $deprecation) && !empty($deprecation['reason']))
                    $deprecation->setReason($deprecation['reason']);
                if (array_key_exists('resources', $deprecation) && !empty($deprecation['resources']))
                    $deprecation->setResources($deprecation['resources']);
                $collection[] = $deprecation;
        }
        $this->collection = $collection;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }
}
