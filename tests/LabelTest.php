<?php

use PHPUnit\Framework\TestCase;

class LabelTest extends TestCase
{
    /**
     * @todo this
     *
     * @return void
     */
    public function testConnectionToApi()
    {
        $stack = [];
        $this->assertSame(0, count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack) - 1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }
}
