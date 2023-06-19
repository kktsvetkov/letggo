<?php

namespace Letggo;

class WarningBouncer implements BouncerInterface
{
        function triggerWarning(string $warning): void
        {
                trigger_error($warning, E_USER_WARNING);
        }

        function bounceMissing(string $id): ?FeatureFlag
        {
                $this->triggerWarning("Trying to get a missing flag \"{$id}\"");
                return null;
        }

        function bounceDuplicate(string $id): bool
        {
                $this->triggerWarning("Adding already existing flag \"{$id}\"");
                return true;
        }

        function bounceEnabled(string $id): bool
        {
                $this->triggerWarning("Asking for a missing flag \"{$id}\"");
                return false;
        }
}
