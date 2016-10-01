<?php

use ConfigServiceProvider\ConfigServiceProvider;
use Pimple\Container;

/**
 * Class JsonConfigParserTest
 * @author sangio90 <info@guidosangiovanni.com>
 */
class JsonConfigParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideFilePaths
     * @param $filePath
     */
    public function testMultipleLevelsConfigurationIsParsedCorrectly($filePath)
    {
        $pimple = new Container();
        $configServiceProvider = new ConfigServiceProvider();
        $configServiceProvider->setConfigFilePath($filePath);
        $configServiceProvider->register($pimple);

        $this->assertEquals($pimple['property'], 'value');
        $this->assertEquals($pimple['numericProperty'], 1.23);
        $this->assertEquals($pimple['booleanProperty'], true);
        $this->assertEquals($pimple['parentProperty']['childProperty'], 'childValue');
        $this->assertEquals($pimple['parentProperty']['secondChildProperty']['secondLevelChildProperty'], 'secondLevelChildValue');
        $this->assertEquals(true, is_array($pimple['parentProperty']));
        $this->assertEquals(true, array_key_exists('secondChildProperty', $pimple['parentProperty']));
    }

    public function provideFilePaths()
    {
        return [
            'json' => [__DIR__ . '/fixtures/jsontest.json'],
            'yaml' => [__DIR__ . '/fixtures/yamltest.yml']
        ];
    }
}