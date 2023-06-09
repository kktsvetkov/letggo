<?php

namespace Letggo;

use InvalidArgumentException;

class FeatureFlag
{
        private string $id;

        private ?bool $isEnabled = null;

        private $resolver = null;

        function __construct(string $id, callable $resolver = null)
        {
                if (empty($id))
                {
                        throw new InvalidArgumentException(
                                'Non-empty feature flag $id is required'
                        );
                }

                $this->id = $id;
                $this->resolver = $resolver;
        }

        function getID(): string
        {
                return $this->id;
        }

        function isResolved(): bool
        {
                return null !== $this->isEnabled;
        }

        function isEnabled(): bool
        {
                if (!$this->isResolved())
                {
                        $this->isEnabled = false;
                        if ($this->resolver)
                        {
                                $this->isEnabled = (bool) ($this->resolver)($this->id);
                        }
                }

                return $this->isEnabled;
        }

        function enable(): self
        {
                $this->isEnabled = true;
                $this->resolved = null;
                return $this;
        }

        function disable(): self
        {
                $this->isEnabled = false;
                $this->resolved = null;
                return $this;
        }

        function resolve(callable $resolver): self
        {
                $this->isEnabled = null;
                $this->resolver = $resolver;
                return $this;
        }

        function __toString(): string
        {
                return $this->getID();
        }

        function __invoke(): bool
        {
                return $this->isEnabled();
        }
}
