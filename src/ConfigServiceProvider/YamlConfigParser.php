<?php
namespace ConfigServiceProvider;

use Pimple\Container;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlConfigParser
 * @package ConfigServiceProvider
 * @author sangio90 <info@guidosangiovanni.com>
 */
class YamlConfigParser extends ConfigParser
{
    public function __construct()
    {
        if (!class_exists('Symfony\\Component\\Yaml\\Yaml')) throw new \RuntimeException('Verify if Symfony Yaml Component is not installed.');
    }

    public function parseConfiguration(Container $pimple, $configuration, $parentKey = '')
    {
        if (!is_array($configuration)) {
            $configuration = Yaml::parse($configuration);
        }
        $pimple = $this->parseArrayConfiguration($pimple, $configuration);
        return $pimple;
    }

    public function supports($filename)
    {
        return (bool) preg_match('#\.ya?ml$#', $filename);
    }
}