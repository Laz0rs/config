<?php

namespace Laz0r\ConfigTest\Base;

use Laz0r\Config\Base\Config;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Config\Base\Config
 */
class ConfigTest extends TestCase {

	/**
	 * @covers ::__construct
	 *
	 * @return void
	 */
	public function testConstructor(): void {
		$Property = (new ReflectionClass(Config::class))
			->getProperty("skipNextIteration");
		$Sut = new Config([]);

		$Property->setAccessible(true);
		$this->assertFalse($Property->getValue($Sut));
	}

}

/* vi:set ts=4 sw=4 noet: */
