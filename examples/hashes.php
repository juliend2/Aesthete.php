<?php
require_once('../aesthete.php');

echo '<h2>A Hash: </h2>';
h("
 key            = value
 another        = string
 number         = 23
 a_long_string  = this is a long string
 a_multiline_string = 'Lorem ipsum dolor sit amet, 
   consectetur adipiscing elit. In in mollis tortor. 
   Curabitur libero quam, dapibus ultrices lacinia at, fringilla a ligula.'
")->each(function($k, $v){
  echo "{$k} => {$v}<br/>";
});
