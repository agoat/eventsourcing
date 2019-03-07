<?php

namespace Agoat\EventSourcing;


abstract class DomainEvent
{
    public function withVersion(int $version)
    {
        $self = clone $this;
        $self->setVersion($version);

        return $self;
    }

    protected function setVersion(int $version)
    {
        $this->version = $version;
    }
}