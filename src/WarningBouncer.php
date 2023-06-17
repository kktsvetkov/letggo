<?php

namespace Letggo;

class WarningBouncer implements BouncerInterface
{
        function bounceMissing(string $id): ?FeatureFlag
        {
                trigger_error("Trying to get a missing flag \"{$id}\"", E_USER_WARNING);
                return null;
        }

        function bounceDuplicate(string $id): bool
        {
                trigger_error("Adding already existing flag \"{$id}\"", E_USER_WARNING);
                return true;
        }

        function bounceEnabled(string $id): bool
        {
                trigger_error("Asking for a missing flag \"{$id}\"", E_USER_WARNING);
                return false;
        }
}
