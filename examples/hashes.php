<?php
require_once('../aesthete.php');

echo '<h2>A Hash: </h2>';
h("
 key            = value
 another        = string
 number         = 23
 a_long_string  = this is a long string
")->each(function($k, $v){
  echo "{$k} => {$v}<br/>";
});
