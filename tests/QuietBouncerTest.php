<?php

namespace Letggo\Tests;

use Letggo\QuietBouncer;
use PHPUnit\Framework\TestCase;

class QuietBouncerTest extends TestCase
{
        function testBounceMissing()
        {
                $bouncer = new QuietBouncer;
                $this->assertNull($bouncer->bounceMissing('proba'));
        }

        function testBounceDuplicate()
        {
                $bouncer = new QuietBouncer;
                $this->assertTrue($bouncer->bounceDuplicate('proba'));
        }

        function testBounceEnabled()
        {
                $bouncer = new QuietBouncer;
                $this->assertFalse($bouncer->bounceEnabled('proba'));
        }
}
