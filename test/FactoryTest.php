<?php

namespace Laz0r\ConfigTest;

use Laz0r\Config\Base\FactoryInterface;
use Laz0r\Config\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Laz0r\Config\Factory
 */
class FactoryTest extends TestCase {

	/**
	 * @covers ::fromFiles
	 *
	 * @return void
	 */
	public function testFromFilesArray(): void {
		$files = range(5, 999);
		$Mock = new class() implements FactoryInterface {

			public static function fromFiles(
				array $files,
				bool $returnConfigObject = true,
				bool $useIncludePath = false
			) {
				return func_get_args();
			}

		};

		$result = Factory::fromFiles($files, false, true, $Mock);

		$this->assertIsArray($result);
		$this->assertCount(3, $result);
		$this->assertTrue(array_pop($result));
		$this->assertFalse(array_pop($result));
		$this->assertSame($files, array_pop($result));
	}

	/**
	 * @covers ::fromFiles
	 *
	 * @return array
	 */
	public function testFromFilesObject(): array {
		$Mock = new class() implements FactoryInterface {

			public static function fromFiles(
				array $files,
				bool $returnConfigObject = true,
				bool $useIncludePath = false
			) {
				assert(!$returnConfigObject);

				return range(4, 20);
			}

		};
		$Sut = new class() extends Factory {

			protected const PRODUCT = Config::class;

		};

		$Result = $Sut->fromFiles([], true, true, $Mock);

		$this->assertInstanceOf(Config::class, $Result);

		return $Result->args;
	}

}

/* vi:set ts=4 sw=4 noet: */
