<?php

namespace Laz0r\Config\Base;

use Laminas\Config\Factory as LaminasFactory;
use ReflectionClass;

class Factory implements FactoryInterface {

	protected const PRODUCT = Config::class;

	public static function fromFiles(
		array $files,
		bool $returnConfigObject = true,
		bool $useIncludePath = false
	) {
		$config = LaminasFactory::fromFiles($files, false, $useIncludePath);

		if (!$returnConfigObject) {
			assert(is_array($config));

			return $config;
		}

		/** @psalm-var class-string $qcn */
		$qcn = static::PRODUCT;
		$RC = new ReflectionClass($qcn);
		$Object = $RC->newInstanceArgs([$config]);

		assert($Object instanceof Config);

		return $Object;
	}

}

/* vi:set ts=4 sw=4 noet: */
