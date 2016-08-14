<?php
namespace ConfigServiceProvider;

use Pimple\Container;

/**
 * Class JsonConfigParser
 * @package ConfigServiceProvider
 * @author sangio90 <info@guidosangiovanni.com>
 */
class JsonConfigParser extends ConfigParser
{
    public function parseConfiguration(Container $pimple, $configuration, $parentKey = '')
    {
        if (!is_array($configuration)) {
            $configuration = json_decode($configuration, true);
        }
        $pimple = $this->parseArrayConfiguration($pimple, $configuration);
        return $pimple;
    }

    public function supports($filename)
    {
        return (bool) preg_match('#\.json$#', $filename);
    }
}