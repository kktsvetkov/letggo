<?php

namespace Letggo;

interface BouncerInterface
{
        /**
        * Handles attempts to access a flag that does not exist
        */
        function bounceMissing(string $id): ?FeatureFlag;

        /**
        * Handles attempts to add duplicate flag
        */
        function bounceDuplicate(string $id): bool;

        /**
        * Handles attempts to check a flag that does not exist
        */
        function bounceEnabled(string $id): bool;
}
