<?php
namespace ConfigServiceProvider;

/**
 * Class ConfigDriver
 * @package ConfigServiceProvider
 * @author sangio90 <info@guidosangiovanni.com>
 */
class ConfigDriver
{
    public function getDriver($filename)
    {
        $yamlConfigParser = new YamlConfigParser();
        if ($yamlConfigParser->supports($filename)) {
            return $yamlConfigParser;
        }

        $jsonConfigDriver = new JsonConfigParser();
        if ($jsonConfigDriver->supports($filename)) {
            return $jsonConfigDriver;
        }

        throw new \RuntimeException("File extension is not supported.");
    }
}