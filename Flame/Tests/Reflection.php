<?php
/**
 * Reflection.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    29.01.13
 */

namespace Flame\Tests;

class Reflection extends \Tester\TestCase
{

	/**
	 * @param mixed $object
	 * @param string $methodName
	 * @return \ReflectionMethod
	 */
	protected function getAccessibleMethod($object, $methodName) {
		$reflaction = new \ReflectionClass($object);
		$method = $reflaction->getMethod($methodName);
		$method->setAccessible(true);
		return $method;
	}

	/**
	 * @param $object
	 * @param $name
	 * @return mixed
	 */
	protected function getAttributeValue($object, $name)
	{
		$attribute = new \ReflectionProperty($object, $name);

		if (!$attribute || $attribute->isPublic())
			return $object->$name;

		$attribute->setAccessible(true);
		$value = $attribute->getValue($object);
		$attribute->setAccessible(false);
		return $value;
	}

	/********************* Nette\Object behaviour ****************d*g**/

	/**
	 * @return \Nette\Reflection\ClassType
	 */
	public static function getReflection()
	{
		return new \Nette\Reflection\ClassType(get_called_class());
	}

	/**
	 * @param string $name
	 *
	 * @return mixed
	 */
	public function &__get($name)
	{
		return ObjectMixin::get($this, $name);
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value)
	{
		ObjectMixin::set($this, $name, $value);
	}

	/**
	 * @param string $name
	 * @param array $args
	 * @return mixed
	 */
	public function __call($name, $args)
	{
		return ObjectMixin::call($this, $name, $args);
	}

	/**
	 * @param string $name
	 *
	 * @return bool
	 */
	public function __isset($name)
	{
		return ObjectMixin::has($this, $name);
	}

	/**
	 * @param string $name
	 */
	public function __unset($name)
	{
		ObjectMixin::remove($this, $name);
	}

}
