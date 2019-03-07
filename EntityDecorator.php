<?php

namespace Agoat\EventSourcing;


class EntityDecorator extends EventSourcedEntity
{
    private $entity;


    public function __construct(EventSourcedEntity $entity)
    {
        $this->entity = $entity;
    }

    public function getUncommittedEvents(): array
    {
        return $this->entity->uncommittedEvents;
    }

    public function getVersion(): int
    {
        return $this->entity->version;
    }

    public function getStartVersion(): int
    {
        return $this->entity->version - count($this->entity->uncommittedEvents);
    }

    protected function apply($event): void {}
}