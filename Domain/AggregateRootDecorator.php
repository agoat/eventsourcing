<?php

namespace Agoat\EventSourcing\Domain;


class AggregateRootDecorator extends EventSourcedAggregateRoot
{
    private $aggregateRoot;


    public function __construct(EventSourcedAggregateRoot $aggregateRoot)
    {
        $this->aggregateRoot = $aggregateRoot;
    }

    public function getUncommittedEvents(): array
    {
        $uncommittedEvents = $this->aggregateRoot->uncommittedEvents;
        $this->aggregateRoot->uncommittedEvents = [];

        return $uncommittedEvents;
    }

    public function getVersion(): int
    {
        return $this->aggregateRoot->version;
    }


    public function setEntities(string $entityClass, array $entities)
    {
        foreach ($entities as $entity) {
            $this->aggregateRoot->entities[$entityClass] = [$entity->getEntityId() => $entity];
        }
    }

    public function getEntities(string $entityClass): ?array
    {
        if (array_key_exists($entityClass, $this->aggregateRoot->entities)) {
            return $this->aggregateRoot->entities[$entityClass];
        }

        return null;
    }

    public function reconstituteEntityFromHistory(string $className, string $entityId, array $historyEvents, $version)
    {
        /** @var $className EventSourcedEntity */
        $this->aggregateRoot->entities[$className] = [$entityId => $className::reconstituteEntityFromHistory($entityId, $this->aggregateRoot->getAggregateId(), $historyEvents, $version)];
    }

    public function getAggregateId() : string {}
    protected function apply($event) : void {}
}