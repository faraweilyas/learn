<?php

namespace App;

use ArrayAccess;

class Container implements ArrayAccess
{
	protected $items = [];

	protected $cache = [];

	public function __construct(array $items=[])
	{
		foreach ($items as $offset => $item)
		{
			$this->offsetSet($offset, $item);
		}
	}

    public function offsetSet($offset, $value)
    {
        if (is_null($offset))
        {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetExists($offset) : bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
    	if (!$this->has($offset))
    		return NULL;

    	if (isset($this->cache[$offset]))
    		return $this->cache[$offset];


    	$item = $this->items[$offset]($this);

    	$this->cache[$offset] = $item;

		return $item;
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    public function has($offset) : bool
    {
        return $this->offsetExists($offset);
    }

    public function get($offset)
    {
        return $this->offsetGet($offset);
    }

    public function __get($property)
    {
        return $this->get($property);
    }
}
