<?php

namespace Laz0r\ConfigTest;

use Laz0r\Config\Config as BaseConfig;

class Config extends BaseConfig {

	public array $args = [];

	public function __construct() {
		$this->args = func_get_args();
	}

}

/* vi:set ts=4 sw=4 noet: */
