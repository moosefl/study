<?php

require_once 'Posld.php';

use PHPUnit\Framework\TestCase;

class PosldTest extends TestCase
{
    private $posled;
    public function setUp()
    {
        $this->posled = new Posld();
    }

    public function tearDown()
    {
        $this->posled = null;
    }

    /**
     * @dataProvider providePosld
     */
    public function testPosld($array, $expected)
    {
        $result = $this->posled->findPosld($array);

        $this->assertEquals($expected, $result);
    }

    public function providePosld() {
        return [
            [[2,1,5,6,4,3], 3],
            [[1,2,3], 1]
        ];
    }
}
