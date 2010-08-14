<?php

/**
 * The Zend Disk cache stores data using Zend disk.
 * http://files.zend.com/help/Zend-Platform/zend_cache_api.htm
 * 
 * Copyright (C) 2010 Jamie Furness (http://www.jamierf.co.uk)
 * License: http://www.gnu.org/licenses/gpl.html GPL version 3 or higher
 */

class Cache_Zend_Disk extends Cache
{
	const NAMESPACE = 'php-cache';

	/**
	* Initialise a new Zend Disk cache.
	*/
	public function __construct($config)
	{
		if (!extension_loaded('zendcache'))
			throw new Exception('The Zend Disk cache requires the ZendCache extension.');
	}

	private function key($key)
	{
		return self::NAMESPACE.'::'.$key;
	}

	protected function _set($key, $data)
	{
		if (zend_disk_cache_store($this->key($key), $data) === false)
			throw new Exception('Unable to write Zend Disk cache: '.$key);
	}

	protected function _get($key)
	{
		$data = zend_disk_cache_fetch($this->key($key));
		if ($data === null)
			return self::NOT_FOUND;

		return $data;
	}

	public function delete($key)
	{
		zend_disk_cache_delete($this->key($key));
	}

	public function clear()
	{
		zend_disk_cache_clear(self::NAMESPACE);
	}
}