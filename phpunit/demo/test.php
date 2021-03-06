<?php
/*
 * Author : slack 
 * Email : yajin160305@gmail.com
 * File : test.php
 * CreateDate : 2016-12-01 00:57:18
 * */

use PHPUnit\Framework\TestCase;
class StackTest extends TestCase
{
 public function testPushAndPop()
 {
  $stack = [];
  $this->assertEquals(0, count($stack));
  array_push($stack, 'foo');
  $this->assertEquals('foo', $stack[count($stack)-1]);
  $this->assertEquals(1, count($stack));
  $this->assertEquals('foo', array_pop($stack));
  $this->assertEquals(0, count($stack));
  }
}

/* vim: set tabstop=4 set shiftwidth=4 */

