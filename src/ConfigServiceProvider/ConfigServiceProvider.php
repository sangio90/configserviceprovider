<?php
namespace ConfigServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ConfigServiceProvider
 * @package ConfigServiceProvider
 * @author sangio90 <info@guidosangiovanni.com>
 */
class ConfigServiceProvider implements ServiceProviderInterface
{

    protected $configFilePath;

    public function register(Container $pimple)
    {
        if (!$this->configFilePath) {
            throw new \Exception("Config File Path not specified.");
        }

        $configFileContent = file_get_contents($this->configFilePath);
        $configDriverFactory = new ConfigDriver();
        $configParser = $configDriverFactory->getDriver($this->configFilePath);
        /** @var ConfigParser $configParser */
        $pimple = $configParser->parseConfiguration($pimple, $configFileContent);
        return $pimple;
    }

    /**
     * @param mixed $configFilePath
     */
    public function setConfigFilePath($configFilePath)
    {
        $this->configFilePath = $configFilePath;
    }

}