<?php

namespace Agoat\EventSourcing\Domain;


trait WhenMethodEventHandlingTrait
{
    protected function apply($event): void
    {
        $handler = $this->determineEventHandlerMethodFor($event);

        if (! \method_exists($this, $handler)) {
            return; // Ignore unknown events
        }

        $this->{$handler}($event);
    }

    protected function determineEventHandlerMethodFor($event): string
    {
        $classParts = \explode('\\', \get_class($event));
        return 'when' . \end($classParts);
    }
}