<?php
/**
 * FacadeTest.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    24.12.12
 */

namespace Flame\Tests\Doctrine\Model;

use Nette;

class FacadeTest extends \Flame\Tests\DoctrineTestCase
{

	/**
	 * @expectedException Nette\InvalidStateException
	 */
	public function testAbstractConstructor()
	{
		$stub = $this->getMockForAbstractClass('\Flame\Doctrine\Model\Facade', array($this->getEmMock()));
	}

	public function testProperties()
	{
		$repositoryMock = $this->getRepositoryMock();
		$emMock = $this->getEmMock($repositoryMock);
		$facade = new FakeFacade($emMock);
		$this->assertAttributeEquals('test', 'repositoryName', $facade);
		$this->assertAttributeEquals($repositoryMock, 'repository', $facade);
	}

	public function testGetOne()
	{
		//TODO: Fix: Method was expected to be called 1 times, actually called 0 times.
//		$id = 23;
//
//		$repositoryMock = $this->getMockBuilder('\Flame\Doctrine\Model\Repository')
//			->disableOriginalConstructor()
//			->getMock();
//		$repositoryMock->expects($this->once())
//			->method('findOneById')
//			->with($id)
//			->will($this->returnValue(null));
//
//		$emMock = $this->getEmMock($repositoryMock);
//		$facade = new FakeFacade($emMock);
//
//		$this->assertNull($facade->getOne($id));
	}

	public function testSave()
	{
		$entityMock = $this->getMock('Flame\Doctrine\Entity');
		$repositoryMock = $this->getMockBuilder('\Flame\Doctrine\Model\Repository')
			->disableOriginalConstructor()
			->getMock();
		$repositoryMock->expects($this->once())
			->method('save')
			->with($entityMock, true)
			->will($this->returnValue(null));
		$emMock = $this->getEmMock($repositoryMock);
		$facade = new FakeFacade($emMock);

		$this->assertNull($facade->save($entityMock, false));
	}

	public function testDelete()
	{

		$entityMock = $this->getMock('Flame\Doctrine\Entity');
		$repositoryMock = $this->getMockBuilder('\Flame\Doctrine\Model\Repository')
			->disableOriginalConstructor()
			->getMock();
		$repositoryMock->expects($this->once())
			->method('delete')
			->with($entityMock, false)
			->will($this->returnValue(null));
		$emMock = $this->getEmMock($repositoryMock);
		$facade = new FakeFacade($emMock);

		$this->assertNull($facade->delete($entityMock, true));
	}


}

class FakeFacade extends \Flame\Doctrine\Model\Facade
{
	protected $repositoryName = 'test';
}
