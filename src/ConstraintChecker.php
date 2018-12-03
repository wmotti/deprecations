<?php
namespace Deprecations;

use Composer\Factory;
use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Composer\Command\BaseCommand;
use Composer\Package\Version\VersionParser;
use Composer\Semver\Constraint\Constraint;
use Composer\Json\JsonFile;

class ConstraintChecker extends BaseCommand
{
    const DEPRECATIONS_SPEC_FILE = "deprecated_packages.json";

    protected function configure()
    {
        $this
            ->setName('deprecations')
            ->setDescription('Show deprecated packages.')
            ->setDefinition(array(
                new InputOption('deprecations-file', 'f', InputOption::VALUE_REQUIRED, 'Specify a deprecations file (default: '.self::DEPRECATIONS_SPEC_FILE.')')
            ))
            ->setHelp(
                <<<EOT
The deprecations command displays a list of packages deprecated according to the
given specification.

EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $composer = $this->getComposer();
        $locker = $composer->getLocker();
        $packages = $locker->getLockedRepository();

        $io = $this->getIO();
        $deprecations_filename = $input->getOption('deprecations-file') ?: self::DEPRECATIONS_SPEC_FILE;
        $json = new DeprecationsFile($deprecations_filename, null, $io);
        $deprecations = $json->read();
        $errors = [];
        foreach ($deprecations as $deprecation)
        {
            if ($deprecated_package = $this->check($packages, $deprecation->package_name, $deprecation->version_constraint))
            {
                $errors[] = $deprecation;
                $message = "Version {$deprecated_package->getVersion()} of {$deprecated_package->getName()} has been deprecated with a constraint {$deprecation->version_constraint}.";
                if (!empty($deprecation->reason))
                    $message.= "\nReason: {$deprecation->reason}.";
                if (!empty($deprecation->resources))
                {
                    $resources_message = '';
                    foreach($deprecation->resources as $resource)
                        $resources_message .= "\n- {$resource}";
                    $message.= "\nFor more info please check: {$resources_message}";
                }
                $io->writeError($message);
            }
        }
        return count($errors);
    }

    private function check($packages, $package_name, $constraint)
    {
        return $packages->findPackage($package_name, $constraint);
    }
}
