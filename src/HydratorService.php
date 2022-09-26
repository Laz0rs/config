<?php

namespace Laz0r\Config;

class HydratorService implements HydratorInterface {

	public function extract(object $object): array {
		assert($object instanceof ConfigInterface);

		return $object->toArray();
	}

	public function hydrate(array $data, object $object) {
		/** @var mixed $value */
		foreach ($data as $key => $value) {
			$object->$key = $value;
		}

		return $object;
	}

}

/* vi:set ts=4 sw=4 noet: */
