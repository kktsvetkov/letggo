<?php

namespace Letggo\Tests;

use Letggo\FeatureFlag;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class FeatureFlagTest extends TestCase
{
        function testWithEmptyArgument()
        {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Non-empty feature flag $id is required');
                new FeatureFlag('');
        }

        function testWithResolverArgument()
        {
                $flag = new FeatureFlag('proba', fn() => true);
                $this->assertEquals($flag->isResolved(), false);
                $this->assertEquals($flag->isEnabled(), true);
                $this->assertEquals($flag->isResolved(), true);
        }

        function testReadingID()
        {
                $flag = new FeatureFlag('proba');
                $this->assertEquals($flag->getID(), 'proba');
                $this->assertEquals((string)$flag, 'proba');
        }

        function testUnresolvedFlag()
        {
                $flag = new FeatureFlag('proba');
                $this->assertEquals($flag->isResolved(), false);
        }

        function testEnablingFlag()
        {
                $flag = new FeatureFlag('proba');
                $flag->enable();

                $this->assertEquals($flag->isEnabled(), true);
                $this->assertEquals($flag->isResolved(), true);
        }

        function testDisablingFlag()
        {
                $flag = new FeatureFlag('proba');
                $flag->disable();

                $this->assertEquals($flag->isEnabled(), false);
                $this->assertEquals($flag->isResolved(), true);
        }

        function testResolvingFlag()
        {
                $flag = new FeatureFlag('proba');

                $flag->resolve(fn($id) => 'proba' == $id);
                $this->assertEquals($flag->isResolved(), false);

                $this->assertEquals($flag->isEnabled(), true);
                $this->assertEquals($flag->isResolved(), true);
        }

        function testInvokingFlag()
        {
                $flag = new FeatureFlag('proba');

                $this->assertEquals($flag(), false);
                $this->assertEquals($flag->isResolved(), true);
        }
}
