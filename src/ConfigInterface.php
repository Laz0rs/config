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
	 * @param mixed  $default
	 *
	 * @return mixed
	 */
	public function get(string $name, $default = null);

	public function isReadOnly(): bool;

	public function merge(ConfigInterface $Config): ConfigInterface;

	public function setReadOnly(): void;

	public function toArray(): array;

}

/* vi:set ts=4 sw=4 noet: */
