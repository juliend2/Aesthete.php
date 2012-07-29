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


# Generates a hash from an array
function _generate_hash_from_array($args) {
  $hash = array();
  $keys = array();
  $values = array();
  foreach ($args as $key => $arg) {
    if (($key) % 2 === 0) {
      $keys[] = $arg;
    } else {
      $values[] = $arg;
    }
  }
  if (count($values) !== count($keys)) {
    $remaining = array_pop($keys);
  }
  foreach ($keys as $index => $key) {
    $hash[$key] = $values[$index];
  }
  if (!empty($remaining)) {
    array_push($hash, $remaining);
  }
  return $hash;
}


// h("
//  key =            value
//  a_number =       23
//  a_long_string =  this is a long string
// ")
//
// OR
//
// h(
//  'key',          'value',
//  'a_number',     23,
//  'a_long_string','this is a long string'
// )
if ( !function_exists('h') )
{
  function h ($hash_string)
  {
    $args = func_get_args();
    if (count($args) === 1) {
      return new AestheteHash(parse_ini_string($hash_string, true));
    } else {
      return new AestheteHash(_generate_hash_from_array($args));
    }
  }
}


