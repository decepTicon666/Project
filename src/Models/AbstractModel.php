<?php

namespace App\Models;

use ArrayAccess;

//Ermöglicht es allen models von diesem abstrakten Model zu erben
//ArrayAccess ermöglicht Arrayschreibweise bei allen Objektatributen
abstract class AbstractModel implements ArrayAccess
{

    public function offsetExists($offset)
    {
        /*if ($offset == "id"){
          return $id;
        }
        if ($offset == "title"){
          return $title;
        }
        if ($offset == "content"){
          return $content;
        }*/
        return isset($this->$offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
}

?>
