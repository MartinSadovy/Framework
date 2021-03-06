<?php
/**
 * CacheProvider.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    24.03.13
 */

namespace Flame\Caching;

use Flame\Tools\Files\FileSystem;
use Nette\Caching\Cache;
use Nette\Caching\Storages\FileStorage;
use Nette\Caching\Storages\IJournal;
use Nette\Object;

class CacheProvider extends Object
{

	const PERSIST_DIR = 'cache-persist';

	/** @var \Nette\Caching\Cache */
	private $cache;

	/** @var string */
	private $tempDir;

	/**
	 * @param \Nette\Caching\Cache $cache
	 */
	public function injectCache(Cache $cache = null)
	{
		$this->cache = $cache;
	}

	/**
	 * @param $tempDir
	 */
	public function __construct($tempDir)
	{
		$this->tempDir = (string)$tempDir;
	}

	/**
	 * @return \Nette\Caching\Cache
	 */
	public function getCache()
	{
		return $this->cache;
	}

	/**
	 * @param                                  $dir
	 * @param null                             $namespace
	 * @param \Nette\Caching\Storages\IJournal $journal
	 * @return \Nette\Caching\Cache
	 */
	public function createCache($dir = self::PERSIST_DIR, $namespace = null, IJournal $journal = null)
	{
		$dir = $this->tempDir . DIRECTORY_SEPARATOR . $dir;

		if (!file_exists($dir)) {
			FileSystem::mkDir($dir);
		}

		return new Cache(new FileStorage($dir, $journal), $namespace);
	}

}
