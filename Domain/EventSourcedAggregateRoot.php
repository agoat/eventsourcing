<?php

namespace Agoat\EventSourcing\Domain;



abstract class EventSourcedAggregateRoot
{
    use EventSourcingTrait;

//    protected $entities = [];


    abstract public function getAggregateId(): string;

    abstract protected function apply($event): void;



//    protected function setEntity(EventSourcedEntity &$entity)
//    {
//        if (array_key_exists(get_class($entity), $this->entities)) {
//            if (array_key_exists($entity->getEntityId(), $this->entities[get_class($entity)])) {
//                throw new \Exception('Entity already registered'); // TODO better explanation
//            }
//        }
//
//        $this->entities[get_class($entity)] = [$entity->getEntityId() => $entity];
//    }
//
//    protected function getEntity(string $entityClass, string $entityId): EventSourcedEntity
//    {
//        if (! array_key_exists($entityClass, $this->entities)) {
//            throw new \Exception('Entity not registered'); // TODO better explanation
//        }
//
//        if (! array_key_exists($entityId, $this->entities[$entityClass])) {
//            throw new \Exception('Entity not registered'); // TODO better explanation
//        }
//
//        return $this->entities[$entityClass][$entityId];
//    }
}