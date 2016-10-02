<?php
namespace SSDMTechTest\EventProcessors;
use SSDMTechTest\AbstractEventProcessor;
use SSDMTechTest\EventInterface;
use SSDMTechTest\InvalidEventException;

class FootballProcessor extends AbstractEventProcessor{
  protected $eventProcessorName = 'football';
  protected $allowedEvents = [
    'kickoff',
    'goal',
    'yellowcard',
    'redcard',
    'penalty',
    'halftime',
    'fulltime',
    'extratime',
    'freekick',
    'corner'
  ];

  protected function isValid(EventInterface $event) {
    return $event->getSport() === $this->getEventProcessorName()
            && in_array($event->getEventType(), $this->allowedEvents);
  }

  public function process(EventInterface $event) {
    if (!$this->isValid($event)) {
      throw new InvalidEventException($event);
    }

    return $event;
  }
}