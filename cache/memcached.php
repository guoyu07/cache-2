<?php

/**
 * The Memcached cache stores data using the Memcached extension for Memcached.
 * http://uk2.php.net/manual/en/book.memcached.php
 * 
 * Copyright (C) 2010 Jamie Furness (http://www.jamierf.co.uk)
 * License: http://www.gnu.org/licenses/gpl.html GPL version 3 or higher
 */

class Cache_Memcached extends Cache
{
	const DEFAULT_HOST = 'localhost';
	const DEFAULT_PORT = 11211;

	private $memcached;

	/**
	* Initialise a new Memcached cache.
	* 
	* @param	host	The memcached server host, defaults to localhost
	* @param	port	The memcached server port, defaults to 11211
	*/
	public function __construct($config)
	{
		$host = isset($config['host']) ? $config['host'] : self::DEFAULT_HOST;
		$port = isset($config['port']) ? $config['port'] : self::DEFAULT_PORT;

		$this->memcached = new Memcached();
		$this->memcached->addServer($host, $port);
	}

	protected function _set($key, $data)
	{
		if ($this->memcached->set($key, $data) === false)
			throw new Exception('Unable to write memcached cache: '.$key);
	}

	protected function _get($key)
	{
		$data = $this->memcached->get($key);
		if ($data === false)
			return self::NOT_FOUND;

		return $data;
	}

	public function delete($key)
	{
		$this->memcached->delete($key);
	}
}