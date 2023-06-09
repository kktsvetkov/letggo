<?php

namespace Letggo;

use IteratorAggregate;

interface FlagsAggregateInterface extends IteratorAggregate
{
        function hasFlag(string $id): bool;

        function getFlag(string $id): ?FeatureFlag;

        function addFlag(FeatureFlag $flag): FlagsAggregateInterface;

        function isEnabled(string $id): bool;
}
