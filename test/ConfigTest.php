<?php

namespace Laz0r\ConfigTest;

use Laminas\Config\Config as LaminasConfig;
use Laz0r\Config\Base\Config as BaseConfig;
use Laz0r\Config\{Config, ConfigInterface};
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Config\Config
 */
class ConfigTest extends TestCase {

	/**
	 * @covers ::__clone
	 *
	 * @return void
	 */
	public function testClone(): void {
		$Stub = $this->createStub(BaseConfig::class);
		$RC = new ReflectionClass(Config::class);
		$Property = $RC->getProperty("Config");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);

		$Cloned = clone $Sut;

		$this->assertSame($Stub, $Property->getValue($Sut));
		$this->assertInstanceOf(get_class($Stub), $Property->getValue($Cloned));
		$this->assertNotSame($Stub, $Property->getValue($Cloned));
	}

	/**
	 * @covers ::__construct
	 *
	 * @return void
	 */
	public function testConstructor(): void {
		$Stub = $this->createStub(BaseConfig::class);
		$Property = (new ReflectionClass(Config::class))
			->getProperty("Config");
		$Sut = new Config([], true, $Stub);

		$Property->setAccessible(true);
		$this->assertSame($Stub, $Property->getValue($Sut));
	}

	/**
	 * @covers ::count
	 *
	 * @return void
	 */
	public function testCount(): void {
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("count")
			->will($this->returnValue(42));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$result = $Sut->count();

		$this->assertSame(42, $result);
	}

	/**
	 * @covers ::current
	 *
	 * @return void
	 */
	public function testCurrent(): void {
		$Stub = (object)[];
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("current")
			->will($this->returnValue($Stub));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Result = $Sut->current();

		$this->assertSame($Stub, $Result);
	}

	/**
	 * @covers ::get
	 *
	 * @return void
	 */
	public function testGet(): void {
		$StubA = (object)[];
		$StubB = (object)[];
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("get")
			->with(
				$this->identicalTo("HURRR"),
				$this->identicalTo($StubA),
			)
			->will($this->returnValue($StubB));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Result = $Sut->get("HURRR", $StubA);

		$this->assertSame($StubB, $Result);
	}

	/**
	 * @covers ::getConfig
	 *
	 * @return void
	 */
	public function testGetConfig(): void {
		$Stub = $this->createStub(BaseConfig::class);
		$RC = new ReflectionClass(Config::class);
		$Property = $RC->getProperty("Config");
		$Method = $RC->getMethod("getConfig");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Property->setAccessible(true);
		$Method->setAccessible(true);
		$Property->setValue($Sut, $Stub);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

	/**
	 * @covers ::isReadOnly
	 *
	 * @return void
	 */
	public function testIsReadOnly(): void {
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("isReadOnly")
			->will($this->returnValue(true));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$result = $Sut->isReadOnly();

		$this->assertTrue($result);
	}

	/**
	 * @covers ::key
	 *
	 * @return void
	 */
	public function testKey(): void {
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("key")
			->will($this->returnValue("DURRRRR"));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$result = $Sut->key();

		$this->assertSame("DURRRRR", $result);
	}

	/**
	 * @covers ::__get
	 *
	 * @return void
	 */
	public function testMagicGet(): void {
		$Stub = (object)[];
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("__get")
			->with($this->identicalTo("Imma"))
			->will($this->returnValue($Stub));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Result = $Sut->__get("Imma");

		$this->assertSame($Stub, $Result);
	}

	/**
	 * @covers ::__isset
	 *
	 * @return void
	 */
	public function testMagicIsset(): void {
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("__isset")
			->with($this->identicalTo("Firin"))
			->will($this->returnValue(true));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$result = $Sut->__isset("Firin");

		$this->assertTrue($result);
	}

	/**
	 * @covers ::__set
	 *
	 * @return void
	 */
	public function testMagicSet(): void {
		$Stub = (object)[];
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("__set")
			->with(
				$this->identicalTo("Mah"),
				$this->identicalTo($Stub),
			);
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Sut->__set("Mah", $Stub);
	}

	/**
	 * @covers ::__unset
	 *
	 * @return void
	 */
	public function testMagicUnset(): void {
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("__unset")
			->with($this->identicalTo("Laz0r"));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Sut->__unset("Laz0r");
	}

	/**
	 * @covers ::merge
	 *
	 * @return void
	 */
	public function testMerge(): void {
		$MockA = $this->createStub(ConfigInterface::class);
		$MockB = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$MockA->expects($this->once())
			->method("isReadOnly")
			->will($this->returnValue(false));
		$MockA->expects($this->once())
			->method("toArray")
			->will($this->returnValue([]));
		$MockB->expects($this->once())
			->method("merge")
			->with($this->isInstanceOf(LaminasConfig::class));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($MockB));

		$Result = $Sut->merge($MockA);

		$this->assertSame($Sut, $Result);
	}

	/**
	 * @covers ::next
	 *
	 * @return void
	 */
	public function testNext(): void {
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("next");
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Sut->next();
	}

	/**
	 * @covers ::offsetExists
	 *
	 * @return void
	 */
	public function testOffsetExists(): void {
		$Stub = (object)[];
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("offsetExists")
			->with($this->identicalTo($Stub))
			->will($this->returnValue(true));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$result = $Sut->offsetExists($Stub);

		$this->assertTrue($result);
	}

	/**
	 * @covers ::offsetGet
	 *
	 * @return void
	 */
	public function testOffsetGet(): void {
		$StubA = (object)[];
		$StubB = (object)[];
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("offsetGet")
			->with($this->identicalTo($StubA))
			->will($this->returnValue($StubB));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Result = $Sut->offsetGet($StubA);

		$this->assertSame($StubB, $Result);
	}

	/**
	 * @covers ::offsetSet
	 *
	 * @return void
	 */
	public function testOffsetSet(): void {
		$StubA = (object)[];
		$StubB = (object)[];
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("offsetSet")
			->with(
				$this->identicalTo($StubA),
				$this->identicalTo($StubB),
			);
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Sut->offsetSet($StubA, $StubB);
	}

	/**
	 * @covers ::offsetUnset
	 *
	 * @return void
	 */
	public function testOffsetUnset(): void {
		$Stub = (object)[];
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("offsetUnset")
			->with($this->identicalTo($Stub));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Sut->offsetUnset($Stub);
	}

	/**
	 * @covers ::rewind
	 *
	 * @return void
	 */
	public function testRewind(): void {
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("rewind");
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Sut->rewind();
	}

	/**
	 * @covers ::setReadOnly
	 *
	 * @return void
	 */
	public function testSetReadOnly(): void {
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("setReadOnly");
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$Sut->setReadOnly();
	}

	/**
	 * @covers ::toArray
	 *
	 * @return void
	 */
	public function testToArray(): void {
		$a = range(0xdead, 0xbeef, -1);
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("toArray")
			->will($this->returnValue($a));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$result = $Sut->toArray();

		$this->assertSame($a, $result);
	}

	/**
	 * @covers ::valid
	 *
	 * @return void
	 */
	public function testValid(): void {
		$Mock = $this->createStub(BaseConfig::class);
		$Sut = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->onlyMethods(["getConfig"])
			->getMock();

		$Mock->expects($this->once())
			->method("valid")
			->will($this->returnValue(true));
		$Sut->expects($this->once())
			->method("getConfig")
			->will($this->returnValue($Mock));

		$result = $Sut->valid();

		$this->assertTrue($result);
	}

}

/* vi:set ts=4 sw=4 noet: */
