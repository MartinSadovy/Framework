<?php
/**
 * ConfiguratorTest.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    24.12.12
 */

namespace Flame\Tests\Config;

use Nette\Config\Extensions;

class ConfiguratorTest extends \Flame\Tests\TestCase
{

	/** @var \Flame\Config\Configurator */
	private $configurator;

	public function setUp()
	{
		$this->configurator = new \Flame\Config\Configurator();
	}

	public function testProperties()
	{
		//TODO:
	}

	public function testCreateCompiler()
	{
		$compiler = new \Nette\Config\Compiler();
		$compiler->addExtension('php', new Extensions\PhpExtension)
			->addExtension('constants', new Extensions\ConstantsExtension)
			->addExtension('nette', new \Flame\Config\Extensions\NetteExtension)
			->addExtension('extensions', new Extensions\ExtensionsExtension);

		$createCompilerMethod = $this->getProtectedClassMethod('\Flame\Config\Configurator', 'createCompiler');
		$this->assertEquals($compiler, $createCompilerMethod->invoke($this->configurator));
	}

}