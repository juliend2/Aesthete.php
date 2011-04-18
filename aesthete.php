<?php

class AestheteArray extends ArrayObject {

  function each ( $iterator_function ) 
  {
    foreach ( $this as $value )
    {
      $iterator_function($value);
    }
  }

}

class AestheteHash extends ArrayObject {
  function each ( $iterator_function )
  {
    foreach ( $this as $key => $value )
    {
      $iterator_function($key, $value);
    }
  }
}

// a('this', 'is', 1, 'array')
if ( !function_exists('a') )
{
  function a ()
  {
    return new AestheteArray(func_get_args());
  }
}

// w(' this is an array of words ')
if ( !function_exists('w') )
{
  function w ($words_string)
  {
    return new AestheteArray(preg_split('/\s+/', trim($words_string)));
  }
}

// h("
//  key:            value
//  another:        string
//  a_number:       23
//  a_long_string:  this is a long string
// ")
if ( !function_exists('h') )
{
  function h ($hash_string)
  {
    $delimiter = false;

    if (strpos($hash_string, "\n") !== false)
    {
      $delimiter = "\n";
    } 
    else if (strpos($hash_string, ',') !== false)
    {
      $delimiter = ",";
    }

    if ($delimiter)
    {
      $key_values = preg_split("/{$delimiter}/", ltrim($hash_string));
    }
    else $key_values = array(ltrim($hash_string));

    $hash = array();
    foreach ( $key_values as $element )
    {
      if (strpos($element, ':') === false) continue;
      $kv = explode(':', $element, 2);
      $hash[$kv[0]] = ltrim($kv[1]);
    }

    return new AestheteHash($hash);

  }
}



