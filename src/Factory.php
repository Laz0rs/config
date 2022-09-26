<?php

namespace Laz0r\Config;

use Laz0r\Config\Base\Config as BaseConfig;
use Laz0r\Config\Base\Factory as BaseFactory;
use Laz0r\Config\Base\FactoryInterface as BaseFactoryInterface;
use ReflectionClass;

class Factory {

	protected const PRODUCT = Config::class;

	/**
	 * @param array                                   $files
	 * @param bool                                    $returnConfigObject
	 * @param bool                                    $useIncludePath
	 * @param null|\Laz0r\Config\Base\FactoryInterface $Factory
	 *
	 * @return array|\Laz0r\Config\ConfigInterface
	 */
	public static function fromFiles(
		array $files,
		bool $returnConfigObject = true,
		bool $useIncludePath = false,
		?BaseFactoryInterface $Factory = null
	) {
		$Factory ??= new BaseFactory();
		$config = $Factory->fromFiles($files, false, $useIncludePath);

		if (!$returnConfigObject) {
			assert(is_array($config));

			return $config;
		}

		/** @psalm-var class-string $qcn */
		$qcn = static::PRODUCT;
		$RC = new ReflectionClass($qcn);
		$Object = $RC->newInstanceArgs([$config]);

		assert($Object instanceof ConfigInterface);

		return $Object;
	}

}

/* vi:set ts=4 sw=4 noet: */
