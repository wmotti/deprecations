<?php
namespace Deprecations;

class Deprecation
{

    public $package_name;
    public $version_constraint;
    public $reason = null;
    public $resources = [];

    public function __construct($package_name, $version_constraint) {
        $this->package_name = $package_name;
        $this->version_constraint = $version_constraint;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    public function setResources($resources)
    {
        $this->resources = $resources;
    }
}
