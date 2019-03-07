<?php

namespace Agoat\EventSourcing\Domain;


trait EventSourcingTrait
{
    protected $version = 0;
    protected $uncommittedEvents = [];

    protected function recordThat(DomainEvent $event): void
    {
        $this->version++;
        $this->uncommittedEvents[] = $event->withVersion($this->version);
        $this->apply($event);
    }


    public static function reconstituteFromHistory(array $historyEvents, ?EventSourcedAggregateRoot $appendTo = null)
    {
        $instance = $appendTo ?? new static();
        $instance->replay($historyEvents);

        return $instance;
    }


    protected function replay(array $historyEvents): void
    {
        foreach ($historyEvents as $pastEvent) {
            $this->version++;
            $this->apply($pastEvent);
        }
    }

    abstract protected function apply($event): void;
}