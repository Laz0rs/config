<?php

namespace Laz0r\Config;

use ArrayAccess;
use Countable;
use Iterator;

/**
 * @extends \ArrayAccess<string, mixed>
 * @extends \Countable
 * @extends \Iterator<string, mixed>
 */
interface ConfigInterface extends ArrayAccess, Countable, Iterator {

	/**
	 * @param string $name
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	public function get(string $name, $default = null);

	/**
	 * @return bool
	 */
	public function isReadOnly(): bool;

	/**
	 * @param \Laz0r\Config\ConfigInterface $Config
	 *
	 * @return $this
	 */
	public function merge(ConfigInterface $Config): self;

	/**
	 * @return void
	 */
	public function setReadOnly(): void;

	/**
	 * @return array
	 */
	public function toArray(): array;

}

/* vi:set ts=4 sw=4 noet: */
