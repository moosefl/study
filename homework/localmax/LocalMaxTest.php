<?php

require_once 'LocalMax.php';

use PHPUnit\Framework\TestCase;

class LocalMaxTest extends TestCase
{
    private $localmax;
    public function setUp()
    {
        $this->localmax = new LocalMax();
    }

    public function tearDown()
    {
        $this->localmax = null;
    }

    /**
     * @dataProvider provideLocalMax
     */
    public function testLocalMax($array, $expected)
    {
        $result = $this->localmax->setLocalMax($array);

        $this->assertEquals($expected, $result);
    }

    public function provideLocalMax() {
        return [
            [[1, 4, 3, 6, 5], [4, 6]],
            [[0, 0, 0], []]
        ];
    }
}
