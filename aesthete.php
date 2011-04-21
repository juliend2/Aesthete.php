<?php

class AestheteArray extends ArrayObject
{
  function each ( $iterator_function )
  {
    foreach ( $this as $value )
    {
      $iterator_function($value);
    }
  }
}

class AestheteHash extends ArrayObject
{
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
    return new AestheteHash(parse_ini_string($hash_string, true));
  }
}



