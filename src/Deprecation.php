<?php
namespace Deprecations;

class Deprecation
{

    public $package_name;
    public $version_constraint;
    public $reason;
    public $resources;

    public function __construct($package_name, $version_constraint, $reason = '', $resources = []) {
        $this->package_name = $package_name;
        $this->version_constraint = $version_constraint;
        $this->reason = $reason;
        $this->resources = $resources;
    }
}
