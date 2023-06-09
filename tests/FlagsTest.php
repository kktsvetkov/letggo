<?php

namespace Letggo\Tests;

use Letggo\{Flags,FeatureFlag};
use PHPUnit\Framework\TestCase;

class FlagsTest extends TestCase
{
        function testHasFlag()
        {
                $flags = new Flags;
                $flags->addFlag(new FeatureFlag('proba'));
                $this->assertTrue($flags->hasFlag('proba'));
        }

        function testHasMissingFlag()
        {
                $flags = new Flags;
                $flags->addFlag(new FeatureFlag('proba'));
                $this->assertFalse($flags->hasFlag('test'));
        }

        function testGetFlag()
        {
                $flags = new Flags;
                $flags->addFlag($flag = new FeatureFlag('proba'));
                $this->assertEquals($flags->getFlag('proba'), $flag);
        }

        function testGetMissingFlag()
        {
                $flags = new Flags;
                $flags->addFlag($flag = new FeatureFlag('proba'));
                $this->assertNull($flags->getFlag('test'));
        }

        function testIsFlagEnabled()
        {
                $flags = new Flags;
                $flags->addFlag(new FeatureFlag('proba', fn() => true));
                $this->assertTrue($flags->isEnabled('proba'));
        }

        function testIsFlagDisabled()
        {
                $flags = new Flags;
                $flags->addFlag(new FeatureFlag('proba', fn() => false));
                $this->assertFalse($flags->isEnabled('proba'));
        }

        function testWithDuplicateFlag()
        {
                $flags = new Flags;
                $flags->addFlag(new FeatureFlag('proba', fn() => false));
                $flags->addFlag(new FeatureFlag('proba', fn() => true));
                $this->assertFalse($flags->isEnabled('proba'));
        }

        function testGetIterator()
        {
                $flags = new Flags;
                $expected = array();
                $flags->addFlag($expected[] = new FeatureFlag('proba'));
                $flags->addFlag($expected[] = new FeatureFlag('test'));
                $this->assertEquals(iterator_to_array($flags), $expected);
        }
}
