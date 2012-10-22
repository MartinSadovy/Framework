<?php
/**
 * TestCase.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    19.10.12
 */

namespace Flame\Tests;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{

	/**
	 * @return \Nette\DI\Container
	 */
	public function getContainer()
	{
		return Environment::getService('container');
	}

	/**
	 * @return mixed
	 */
	public function getContext()
	{
		return Environment::getContext();
	}

}