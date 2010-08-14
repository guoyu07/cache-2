<?php

/**
 * The Memcache cache stores data using the Memcache extension for Memcached.
 * http://uk2.php.net/manual/en/book.memcache.php
 * 
 * Copyright (C) 2010 Jamie Furness (http://www.jamierf.co.uk)
 * License: http://www.gnu.org/licenses/gpl.html GPL version 3 or higher
 */

class Cache_Memcache extends Cache
{
	const DEFAULT_HOST = 'localhost';
	const DEFAULT_PORT = 11211;

	private $memcache;

	/**
	* Initialise a new Memcache cache.
	* 
	* @param	host	The memcached server host, defaults to localhost
	* @param	port	The memcached server port, defaults to 11211
	*/
	public function __construct($config)
	{
		$host = isset($config['host']) ? $config['host'] : self::DEFAULT_HOST;
		$port = isset($config['port']) ? $config['port'] : self::DEFAULT_PORT;

		$this->memcache = new Memcache();
		$this->memcache->connect($host, $port);
	}

	protected function _set($key, $data)
	{
		if ($this->memcache->set($key, $data) === false)
			throw new Exception('Unable to write memcache cache: '.$key);
	}

	protected function _get($key)
	{
		$data = $this->memcache->get($key);
		if ($data === false)
			return self::NOT_FOUND;

		return $data;
	}

	public function delete($key)
	{
		$this->memcache->delete($key);
	}
}