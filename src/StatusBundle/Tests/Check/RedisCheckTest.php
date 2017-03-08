<?php

namespace Markup\StatusBundle\Tests\Check;

use Markup\StatusBundle\Check\RedisCheck;
use Mockery as m;

class RedisCheckTest extends \PHPUnit_Framework_TestCase
{
    public function testCheck()
    {
        $check = new RedisCheck('redis://127.0.0.1:6379/0');
        $result = $check->doCheck();

        $this->assertTrue($result->getResult());
    }

    public function testFailureCheck()
    {
        $check = new RedisCheck('redis://127.0.0.1:6331/0');
        $result = $check->doCheck();

        $this->assertFalse($result->getResult());
    }
}
