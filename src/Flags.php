<?php

namespace Letggo;

class Flags implements FlagsAggregateInterface
{
        private array $flags = array();

        private BouncerInterface $bouncer;

        function __construct(BouncerInterface $bouncer = null)
        {
                $this->bouncer = $bouncer ?? new WarningBouncer;
        }

        function hasFlag(string $id): bool
        {
                foreach ($this->getIterator() as $flag)
                {
                        if ($flag->getID() === $id)
                        {
                                return true;
                        }
                }

                return false;
        }

        function getFlag(string $id): ?FeatureFlag
        {
                foreach ($this->getIterator() as $flag)
                {
                        if ($flag->getID() === $id)
                        {
                                return $flag;
                        }
                }

                return $this->bouncer->bounceMissing($id);
        }

        function addFlag(FeatureFlag $flag): FlagsAggregateInterface
        {
                $id = $flag->getID();
                if (!$this->hasFlag($id) || !$this->bouncer->bounceDuplicate($id))
                {
                        $this->flags[] = $flag;
                }

                return $this;
        }

        function isEnabled(string $id): bool
        {
                foreach ($this->getIterator() as $flag)
                {
                        if ($flag->getID() === $id)
                        {
                                return $flag->isEnabled();
                        }
                }

                return $this->bouncer->bounceEnabled($id);
        }

        function getIterator(): iterable
        {
                yield from $this->flags;
        }
}
