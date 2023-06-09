<?php

namespace Letggo;

class Flags implements FlagsAggregateInterface
{
        private array $flags = array();

        function __construct(FeatureFlag ...$flags)
        {
                foreach ($flags as $flag)
                {
                        $this->addFlag($flag);
                }
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

                ;
                ;
                ;

                return null;
        }

        function addFlag(FeatureFlag $flag): FlagsAggregateInterface
        {
                $this->flags[] = $flag;
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

                ;
                ;
                ;

                return false;
        }

        function getIterator(): iterable
        {
                yield from $this->flags;
        }
}
