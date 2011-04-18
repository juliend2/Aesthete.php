<?php
require_once('aesthete.php');

echo '<h2>An array: </h2>';
a('one', 'two', 3, 4)->each(function($thing){
  echo "{$thing}<br/>";
});

echo '<h2>Another array: </h2>';
w(' this is an array of words ')->each(function($w){
  echo "{$w}<br/>";
});

