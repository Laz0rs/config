<?php

namespace Laz0r\Config;

use Laminas\Config\Config as LaminasConfig;
use Laz0r\Config\Base\Config as BaseConfig;
use Laz0r\Util\AbstractConstructOnce;

class Config extends AbstractConstructOnce implements ConfigInterface {

	private BaseConfig $Config;

	/**
	 * @return void
	 */
	public function __clone() {
		$this->Config = clone $this->Config;
	}

	/**
	 * @param array $array
	 * @param bool $allowModifications
	 * @param \Laz0r\Config\Base\Config|null $Config
	 */
	public function __construct(
		array $array = [],
		bool $allowModifications = false,
		?BaseConfig $Config = null
	) {
		parent::__construct();

		$Config ??= new BaseConfig($array, $allowModifications);
		$this->Config = $Config;
	}

	/**
	 * @param string $name
	 *
	 * @return mixed
	 */
	public function __get($name) {
		return $this->getConfig()->__get($name);
	}

	/**
	 * @param string $name
	 *
	 * @return bool
	 */
	public function __isset($name) {
		return $this->getConfig()->__isset($name);
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 *
	 * @return void
	 */
	public function __set($name, $value) {
		$this->getConfig()->__set($name, $value);
	}

	/**
	 * @param string $name
	 *
	 * @return void
	 */
	public function __unset($name) {
		$this->getConfig()->__unset($name);
	}

	/**
	 * @return int
	 */
	public function count() {
		return $this->getConfig()->count();
	}

	/**
	 * @return mixed
	 */
	public function current() {
		return $this->getConfig()->current();
	}

	public function get(string $name, $default = null) {
		return $this->getConfig()->get($name, $default);
	}

	public function isReadOnly(): bool {
		return $this->getConfig()->isReadOnly();
	}

	/**
	 * @return string
	 */
	public function key() {
		$ret = $this->getConfig()->key();

		assert(is_string($ret));

		return $ret;
	}

	public function merge(ConfigInterface $Config): ConfigInterface {
		$this->getConfig()->merge(
			new LaminasConfig($Config->toArray(), !($Config->isReadOnly())),
		);

		return $this;
	}

	/**
	 * @return void
	 */
	public function next() {
		$this->getConfig()->next();
	}

	/**
	 * @param mixed $offset
	 *
	 * @return bool
	 */
	public function offsetExists($offset) {
		return $this->getConfig()->offsetExists($offset);
	}

	/**
	 * @param mixed $offset
	 *
	 * @return mixed
	 */
	public function offsetGet($offset) {
		return $this->getConfig()->offsetGet($offset);
	}

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 *
	 * @return void
	 */
	public function offsetSet($offset, $value) {
		$this->getConfig()->offsetSet($offset, $value);
	}

	/**
	 * @param mixed $offset
	 *
	 * @return void
	 */
	public function offsetUnset($offset) {
		$this->getConfig()->offsetUnset($offset);
	}

	/**
	 * @return void
	 */
	public function rewind() {
		$this->getConfig()->rewind();
	}

	public function setReadOnly(): void {
		$this->getConfig()->setReadOnly();
	}

	public function toArray(): array {
		return $this->getConfig()->toArray();
	}

	/**
	 * @return bool
	 */
	public function valid() {
		return $this->getConfig()->valid();
	}

	/**
	 * @return \Laz0r\Config\Base\Config
	 */
	protected function getConfig(): BaseConfig {
		return $this->Config;
	}

}

/* vi:set ts=4 sw=4 noet: */
