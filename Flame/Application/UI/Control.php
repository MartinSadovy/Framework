<?php
/**
 * Control
 *
 * @author  Jiří Šifalda
 * @package Flame
 *
 * @date    14.07.12
 */

namespace Flame\Application\UI;

use Nette\Callback;

/**
 * @property \Nette\Templating\FileTemplate template
 */
abstract class Control extends \Nette\Application\UI\Control
{

	public function render()
	{
		$this->template->render();
	}

	/**
	 * @param null $class
	 * @return \Nette\Templating\ITemplate
	 */
	protected function createTemplate($class = null)
	{
		$template = parent::createTemplate($class);
		if (file_exists($file = $this->getTemplateFile()))
			$template->setFile($file);

		return $template;
	}

	/**
	 * @return string
	 */
	protected function getTemplateFile()
	{
		$reflection = $this->getReflection();

		return dirname($reflection->getFileName()) . DIRECTORY_SEPARATOR . $reflection->getShortName() . '.latte';
	}
}
