<?php

namespace Letggo\Tests;

use Letggo\WarningBouncer;
use PHPUnit\Framework\TestCase;

class WarningBouncerTest extends TestCase
{
        function testBounceMissing()
        {
                $this->expectWarning();
                $this->expectWarningMessage('Trying to get a missing flag "proba"');

                $bouncer = new WarningBouncer;
                $this->assertNull($bouncer->bounceMissing('proba'));
        }

        function testBounceDuplicate()
        {
                $this->expectWarning();
                $this->expectWarningMessage('Adding already existing flag "proba"');

                $bouncer = new WarningBouncer;
                $this->assertTrue($bouncer->bounceDuplicate('proba'));
        }

        function testBounceEnabled()
        {
                $this->expectWarning();
                $this->expectWarningMessage('Asking for a missing flag "proba"');

                $bouncer = new WarningBouncer;
                $this->assertFalse($bouncer->bounceEnabled('proba'));
        }
}
