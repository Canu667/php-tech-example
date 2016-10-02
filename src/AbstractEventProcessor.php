<?php
namespace SSDMTechTest;

abstract class AbstractEventProcessor
{
  protected $eventProcessorName;
  /**
   * @return string
   */
  public function getEventProcessorName() {
    return $this->eventProcessorName;
  }

  /**
   * @param \SSDMTechTest\EventInterface $event
   *
   * @return EventInterface $event
   * @throws \SSDMTechTest\InvalidEventException
   */
  abstract public function process(EventInterface $event);
}