<?php

/**
 * The JSON filter serializes data into json string form.
 * This filter can be loaded by default as not all cache layers
 * support storing PHP objects.
 * http://uk2.php.net/manual/en/book.json.php
 *
 * Copyright (C) 2011 FluxBB (http://fluxbb.org)
 * License: LGPL - GNU Lesser General Public License (http://www.gnu.org/licenses/lgpl.html)
 */

class Flux_Cache_Filter_JSON implements Flux_Cache_Filter, Flux_Cache_Serializer
{

	/**
	* Initialise a new JSON filter.
	*/
	public function __construct($config)
	{

	}

	public function encode($data)
	{
		return json_encode($data);
	}

	public function decode($data)
	{
		return json_decode($data);
	}
}