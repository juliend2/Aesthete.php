<?php

require_once('../../simpletest/unit_tester.php');
require_once('../../simpletest/reporter.php');
require_once('../aesthete.php');

class ArrayTests extends UnitTestCase {
  function testWordArray(){
    $love = w(' i love you ');
    $this->assertEqual($love[0], 'i');
    $this->assertEqual($love[1], 'love');
    $this->assertEqual($love[2], 'you');
    $this->assertEqual(count($love), 3);

    $amour = w("je t'aime");
    $this->assertEqual($amour[0], "je");
    $this->assertEqual($amour[1], "t'aime");
    $this->assertEqual(count($amour), 2);
  }

  function testNormalArray(){
    $numbers = a('one', 2, array('trois'));
    $this->assertEqual($numbers[0], 'one');
    $this->assertEqual($numbers[1], 2);
    $this->assertEqual($numbers[2], array('trois'));
    $this->assertEqual(count($numbers), 3);
  }

  function testNestedArrays(){
    $things = a('one', a('two'), a(a(3)));
    $this->assertEqual($things[0], 'one');
    $this->assertEqual($things[1][0], 'two');
    $this->assertEqual($things[2][0][0], 3);
    $this->assertEqual(count($things), 3);
  }

  function testSimpleHashes(){
    $hash = h("
        key           = value
        another       = string
        number        = 23
        a_long_string = this is a long string
      ");
    $this->assertEqual($hash['key'], 'value');
    $this->assertEqual($hash['number'], '23');
    $this->assertFalse(is_int($hash['number']));
    $this->assertEqual($hash['a_long_string'], 'this is a long string');
  }

  function testComplexHashes(){
    $hash = h('
      long_string    = "this is a reaaaaaaaaaaaaaaaaaaaaalllyyyyy
      long string with multiple lines and no quotes around it."
    ');
    $this->assertEqual($hash['long_string'], 'this is a reaaaaaaaaaaaaaaaaaaaaalllyyyyy
      long string with multiple lines and no quotes around it.');

    // same but with single quotes for the value
    $hash = h("
      long_string    = 'this is a reaaaaaaaaaaaaaaaaaaaaalllyyyyy
      long string with multiple lines and no quotes around it.'
    ");
    $this->assertEqual($hash['long_string'], 'this is a reaaaaaaaaaaaaaaaaaaaaalllyyyyy
      long string with multiple lines and no quotes around it.');

    // constant
    define('MY_CONSTANT', 'lol');
    $hash = h("
      my_const = MY_CONSTANT
    ");
    $this->assertEqual($hash['my_const'], 'lol');

    // comment
    $hash = h("
      key = value     ; this is a comment
    ");
    $this->assertEqual($hash['key'], 'value');
  }

}

$test = new ArrayTests();
$test->run(new HtmlReporter());


