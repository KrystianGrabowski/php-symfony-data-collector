<?php

use App\Classer;
use PHPUnit\Framework\TestCase;

class ClasserTest extends TestCase
{
    public function classerBasicTest()
    {
        $classer = new Classer;
        $result = $classer->classerBasicFunction();
        $this->assertEquals(19, $result);
    }
}

?>