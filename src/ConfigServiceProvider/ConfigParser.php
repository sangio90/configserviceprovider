<?php
namespace ConfigServiceProvider;

use Pimple\Container;

/**
 * Class ConfigParser
 * @package ConfigServiceProvider
 * @author sangio90 <info@guidosangiovanni.com>
 */
abstract class ConfigParser
{

    abstract public function parseConfiguration(Container $pimple, $yamlFile, $key = '');

    protected function parseArrayConfiguration(Container $pimple, $configuration = []) {
        if (!is_array($configuration)) {
            throw new \Exception("Configuration must be an array");
        }
        foreach ($configuration as $subLevelKey => $value) {
            $pimple[$subLevelKey] = $value;
        }
        return $pimple;
    }
}