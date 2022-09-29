<?php

namespace Laz0r\Config\Base;

use Laminas\Config\Config as LaminasConfig;

class Config extends LaminasConfig {

	/**
	 * @param array $array
	 * @param bool $allowModifications
	 */
	public function __construct(
		array $array,
		bool $allowModifications = false
	) {
		parent::__construct($array, $allowModifications);

		$this->skipNextIteration = false;
	}

}

/* vi:set ts=4 sw=4 noet: */
