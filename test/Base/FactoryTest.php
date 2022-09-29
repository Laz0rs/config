<?php

namespace Laz0r\ConfigTest\Base;

use Laz0r\Config\Base\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Laz0r\Config\Base\Factory
 */
class FactoryTest extends TestCase {

	/**
	 * @covers ::fromFiles
	 *
	 * @return array
	 */
	public function testFromFilesArray(): array {
		$ret = Factory::fromFiles([__DIR__ . "/_files/test.ini"], false);

		$this->assertIsArray($ret);

		return $ret;
	}

	/**
	 * @covers ::fromFiles
	 *
	 * @return array
	 */
	public function testFromFilesObject(): array {
		$Sut = new class() extends Factory {

			protected const PRODUCT = Config::class;

		};

		$Result = $Sut->fromFiles([__DIR__ . "/_files/test.ini"], true);

		$this->assertInstanceOf(Config::class, $Result);

		return $Result->args;
	}

	/**
	 * @coversNothing
	 * @depends testFromFilesArray
	 * @depends testFromFilesObject
	 *
	 * @param array $a
	 * @param array $b
	 *
	 * @return void
	 */
	public function testFromFilesPassesConfig(array $a, array $b): void {
		$this->assertCount(1, $b);

		$b = array_pop($b);

		$this->assertSame($a, $b);
	}

}

/* vi:set ts=4 sw=4 noet: */
