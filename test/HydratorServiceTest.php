<?php

namespace Laz0r\ConfigTest;

use Laz0r\Config\{ConfigInterface, HydratorService};
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @coversDefaultClass \Laz0r\Config\HydratorService
 */
class HydratorServiceTest extends TestCase {

	/**
	 * @covers ::extract
	 *
	 * @return void
	 */
	public function testExtract(): void {
		$test = [(object)[]];
		$Mock = $this->createStub(ConfigInterface::class);
		$Sut = new HydratorService();

		$Mock->expects($this->once())
			->method("toArray")
			->will($this->returnValue($test));

		$result = $Sut->extract($Mock);

		$this->assertSame($test, $result);
	}

	/**
	 * @covers ::hydrate
	 *
	 * @return void
	 */
	public function testHydrate(): void {
		$Stub = new stdClass();
		$Sut = new HydratorService();

		$Result = $Sut->hydrate([
			"imma" => "FiRiN",
			"Mah" => "LAz0R",
		], $Stub);

		$this->assertSame($Stub, $Result);
		$this->assertObjectHasAttribute("imma", $Stub);
		$this->assertSame("FiRiN", $Stub->imma);
		$this->assertObjectHasAttribute("Mah", $Stub);
		$this->assertSame("LAz0R", $Stub->Mah);
	}

}

/* vi:set ts=4 sw=4 noet: */
