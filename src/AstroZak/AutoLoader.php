<?php

namespace AstroZak;

class AutoLoader 
{
	protected $namespaces = array();

	public function register($prepend = false)
	{
		spl_autoload_register(array($this, 'load'), true, $prepend);
	}

	/**
	* Method registers an array of namespaces
	* @param array $namespaces An array of namespaces (namespaces as keys and locations as values)
	*/
	public function registerNamespaces(array $namespaces)
	{
		foreach ($namespaces as $namespace => $locations) 
		{
			$this->namespaces[$namespace] = (array) $locations;
		}
	}

	/**
	* Method registers a namespace.
	* @param string       $namespace The namespace
	* @param array|string $paths     The location(s) of the namespace
	*/
	public function registerNamespace($namespace, $paths)
	{
		$this->namespaces[$namespace] = (array) $paths;
	}

	public function load($class_name)
	{
		$class = ('\\' == $class_name[0]) ? substr($class_name, 1) : $class_name;
		
		if (false !== $pos = strrpos($class, '\\')) 
		{
			// namespaced class name
			$namespace = substr($class, 0, $pos);
			$short_name = substr($class, $pos + 1);
			$normalized_class = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR.str_replace('_', DIRECTORY_SEPARATOR, $short_name).'.php';
			foreach ($this->namespaces as $ns => $dirs) 
			{
				if (0 !== strpos($namespace, $ns)) 
				{
					continue;
				}
				foreach ($dirs as $dir) 
				{
					
					$file = $dir.DIRECTORY_SEPARATOR.$normalized_class;
					if (file_exists($file))
					{
						require_once($file);
					}
				}
			}
		}
	}
}
