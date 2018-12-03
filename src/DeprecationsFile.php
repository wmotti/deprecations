<?php
namespace Deprecations;

use Composer\Json\JsonFile;
use Composer\Util\RemoteFilesystem;
use Composer\IO\IOInterface;

class DeprecationsFile extends JsonFile
{

    private $json;

    public function read()
    {
        $this->json = parent::read();
        $this->checkFileFormat();
        return new DeprecationsCollection($this->json['packages']);
    }

    private function checkFileFormat()
    {
        if ($this->json['_meta']['file_format'] != '2')
            throw new \RuntimeException('Unknown file format.');
    }
}
