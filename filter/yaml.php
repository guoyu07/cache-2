<?php

/**
 * The YAML filter serializes data into YAML string form.
 * This filter can be loaded by default as not all cache layers
 * support storing PHP objects.
 * http://uk2.php.net/manual/en/book.yaml.php
 *
 * Copyright (C) 2011 FluxBB (http://fluxbb.org)
 * License: LGPL - GNU Lesser General Public License (http://www.gnu.org/licenses/lgpl.html)
 */

class YAMLFilter implements Filter, Serializer
{

	/**
	* Initialise a new YAML filter.
	*/
	public function __construct($config)
	{
		if (!extension_loaded('yaml'))
			throw new Exception('The YAML filter requires the YAML extension.');
	}

	public function encode($data)
	{
		return yaml_emit($data, YAML_UTF8_ENCODING, YAML_LN_BREAK);
	}

	public function decode($data)
	{
		return yaml_parse($data);
	}
}
