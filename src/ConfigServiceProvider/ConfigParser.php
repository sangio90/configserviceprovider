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
    const SEPARATOR = '.';

    abstract public function parseConfiguration(Container $pimple, $yamlFile, $key = '');

    protected function parseArrayConfiguration(Container $pimple, $configuration = [], $parentKey = '') {
        if (!is_array($configuration)) {
            throw new \Exception("Configuration must be an array");
        }
        foreach ($configuration as $subLevelKey => $value) {
            if (!is_array($value)) {
                $key = !empty($parentKey) ? $parentKey . static::SEPARATOR : '';
                $pimple[$key . $subLevelKey] = $value;
            } else {
                $completePathKey = !empty($parentKey) ? $parentKey . static::SEPARATOR : '';
                $pimple = $this->parseArrayConfiguration($pimple, $value, $completePathKey . $subLevelKey);
            }
        }
        return $pimple;
    }
}