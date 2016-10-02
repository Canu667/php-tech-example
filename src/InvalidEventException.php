<?php
namespace SSDMTechTest;

class InvalidEventException extends \Exception {
  /**
   * @var \SSDMTechTest\EventInterface
   */
  protected $event;

  /**
   * EventProcessException constructor.
   *
   * @param \SSDMTechTest\EventInterface $event
   */
  public function __construct(EventInterface $event) {
    $this->event = $event;
  }

  /**
   * @return \SSDMTechTest\EventInterface
   */
  public function getEvent() {
    return $this->event;
  }
}