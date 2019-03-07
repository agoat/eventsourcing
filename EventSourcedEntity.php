<?php

namespace Agoat\EventSourcing;


abstract class EventSourcedEntity
{
    use EventSourcingTrait;

    protected $aggregateRootId;
    protected $entityId;

    public function getEntityId(): string
    {
        return $this->entityId;
    }

    public function getAggregateRootId(): string
    {
        return $this->aggregateRootId;
    }

//    public static function createEntityWith(string $entityId, string $aggregateRootId)
//    {
//        $self = new static();
//        $self->entityId = $entityId;
//        $self->aggregateRootId = $aggregateRootId;
//
//        return $self;
//    }
//
//    public static function reconstituteEntityFromHistory(string $entityId, string $aggregateRootId, array $historyEvents, $version)
//    {
//        $instance = static::reconstituteFromHistory($historyEvents, $version);
//        $instance->entityId = $entityId;
//        $instance->aggregateRootId = $aggregateRootId;
//
//        return $instance;
//    }
}