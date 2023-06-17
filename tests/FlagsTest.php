<?php

namespace Letggo\Tests;

use Letggo\{Flags,FeatureFlag,QuietBouncer};
use PHPUnit\Framework\TestCase;

class FlagsTest extends TestCase
{
        private ?Flags $flags;

        function setUp(): void
        {
                $this->flags = new Flags(new QuietBouncer);
        }

        function tearDown(): void
        {
                unset($this->flags);
        }

        function testHasFlag()
        {
                $this->flags->addFlag(new FeatureFlag('proba'));
                $this->assertTrue($this->flags->hasFlag('proba'));
        }

        function testHasMissingFlag()
        {
                $this->flags->addFlag(new FeatureFlag('proba'));
                $this->assertFalse($this->flags->hasFlag('test'));
        }

        function testGetFlag()
        {
                $this->flags->addFlag($flag = new FeatureFlag('proba'));
                $this->assertEquals($this->flags->getFlag('proba'), $flag);
        }

        function testGetMissingFlag()
        {
                $this->flags->addFlag($flag = new FeatureFlag('proba'));
                $this->assertNull($this->flags->getFlag('test'));
        }

        function testIsFlagEnabled()
        {
                $this->flags->addFlag(new FeatureFlag('proba', fn() => true));
                $this->assertTrue($this->flags->isEnabled('proba'));
        }

        function testIsFlagDisabled()
        {
                $this->flags->addFlag(new FeatureFlag('proba', fn() => false));
                $this->assertFalse($this->flags->isEnabled('proba'));
        }

        function testWithDuplicateFlag()
        {
                $this->flags->addFlag(new FeatureFlag('proba', fn() => false));
                $this->flags->addFlag(new FeatureFlag('proba', fn() => true));
                $this->assertFalse($this->flags->isEnabled('proba'));
        }

        function testGetIterator()
        {
                $expected = array();
                $this->flags->addFlag($expected[] = new FeatureFlag('proba'));
                $this->flags->addFlag($expected[] = new FeatureFlag('test'));
                $this->assertEquals(iterator_to_array($this->flags), $expected);
        }
}
