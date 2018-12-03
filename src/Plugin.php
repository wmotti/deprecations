<?php

namespace Deprecations;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
/*use Composer\EventDispatcher;*/
/*use Composer\Installer;*/
/*use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;*/
use Composer\Plugin\Capable;

class Plugin implements PluginInterface, Capable
{
    protected $composer;
    protected $io;

    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
    }

    public function getCapabilities()
    {
        return array(
            'Composer\Plugin\Capability\CommandProvider' => 'Deprecations\ConstraintCheckerProvider',
        );
    }
}
