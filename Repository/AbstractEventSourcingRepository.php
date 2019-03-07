<?php

namespace Agoat\EventSourcing\Repistory;


use Agoat\EventSourcing\EventSourcedAggregateRoot;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractEventSourcingRepository
{
    /** @var Serializer */
    protected $serializer;

    abstract public function save(EventSourcedAggregateRoot $aggregateRoot, array $metadata = []);

    abstract public function load(string $aggregateId): EventSourcedAggregateRoot;

    protected function convertDomainEventsToEventData(array $events, $metadata)
    {
        return array_map(function ($event) use ($metadata) {
            return new EventData(
                Uuid::uuid4(),
                get_class($event),
                true,
                $this->serializer->serialize($event, 'json'),
                $this->serializer->serialize($metadata, 'json')
            );
        }, $events);
    }

    protected function convertStreamEventsSliceToDomainEvents(StreamEventsSlice $streamEventsSlice)
    {
        return array_map(function($resolvedEvent) {
            /** @var ResolvedEvent $resolvedEvent */
            /** @var RecordedEvent $recordedEvent */
            $recordedEvent = $resolvedEvent->getRecordedEvent();
            return $this->serializer->deserialize($recordedEvent->getData(), $recordedEvent->getEventType(), 'json');
        }, $streamEventsSlice->getResolvedEvents());
    }
}