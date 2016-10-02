<?php
namespace SSDMTechTest;

use SSDMTechTest\EventProcessors\FootballProcessor;

class EventProcessorManager {
  /**
   * @var \SSDMTechTest\EventStorageInterface
   */
  protected $storage;

  /**
   * @var array
   */
  protected $processorsMapping = [];

  /**
   * EventProcessor constructor.
   *
   * @param \SSDMTechTest\EventStorageInterface $storage
   */
  public function __construct(EventStorageInterface $storage) {
    $this->storage = $storage;

    /**
     * If we could assert that event sport types do not start with a number and
     * generally are in accordance with the PHP naming standard then
     * we could make it even easier to load processors. Now, it should
     * endure utf-8 names and other nasty things thanks to this manual mapping.
     */
    $this->processorsMapping['football'] = new FootballProcessor();
  }

  /**
   * @param \SSDMTechTest\EventInterface $event
   *
   * @throws \SSDMTechTest\InvalidEventException
   */
  public function processEvent(EventInterface $event) {
    $processor = $this->getProcessor($event);
    $processedEvent = $processor->process($event);
    $this->storage->store($processedEvent);
  }

  /**
   * @param \SSDMTechTest\EventInterface $event
   *
   * @return mixed
   * @throws \SSDMTechTest\InvalidEventException
   */
  protected function getProcessor(EventInterface $event) {
    $type = $event->getSport();

    if (!isset($this->processorsMapping[$type])) {
      throw new InvalidEventException($event);
    }

    return $this->processorsMapping[$type];
  }
}