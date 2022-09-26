<?php

namespace Laz0r\Config\Base;

interface FactoryInterface {

	/**
	 * @param array $files
	 * @param bool  $returnConfigObject
	 * @param bool  $useIncludePath
	 *
	 * @return array|\Laz0r\Config\Base\Config
	 */
	public static function fromFiles(
		array $files,
		bool $returnConfigObject = true,
		bool $useIncludePath = false
	);

}

/* vi:set ts=4 sw=4 noet: */
