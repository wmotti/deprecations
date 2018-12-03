<?php

namespace Deprecations;

use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;

class ConstraintCheckerProvider implements CommandProviderCapability
{
    public function getCommands()
    {
        return array(new ConstraintChecker);
    }
}
