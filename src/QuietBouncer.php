<?php

namespace Letggo;

class QuietBouncer implements BouncerInterface
{
        function bounceMissing(string $id): ?FeatureFlag
        {
                return null;
        }

        function bounceDuplicate(string $id): bool
        {
                return true;
        }

        function bounceEnabled(string $id): bool
        {
                return false;
        }
}
