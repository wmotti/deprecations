<?php
namespace Deprecations;

class DeprecationsCollection implements \IteratorAggregate
{
    private $collection;

    public function __construct($packages) {
        foreach($packages as $package)
        {
            foreach ($package['deprecations'] as $deprecation_spec)
                $name = $package['name'];
                $version = $deprecation_spec['version'];
                $deprecation = new Deprecation($package['name'], $deprecation_spec['version']);
                if (array_key_exists('reason', $deprecation_spec) && !empty($deprecation_spec['reason']))
                    $deprecation->setReason($deprecation_spec['reason']);
                if (array_key_exists('resources', $deprecation_spec) && !empty($deprecation_spec['resources']))
                    $deprecation->setResources($deprecation_spec['resources']);
                $collection[] = $deprecation;
        }
        $this->collection = $collection;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }
}
