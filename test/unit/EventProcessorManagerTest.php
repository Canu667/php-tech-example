<?php

class EventProcessorManagerTest extends \PHPUnit_Framework_TestCase {
  protected $eventStorageMock = null;

  protected function setUp()
  {
    $this->eventStorageMock = $this->getMock('SSDMTechTest\EventStorageInterface');
  }

  public function testEventProcessorProcessSuccess() {
    $eventMock = $this->getMock('SSDMTechTest\EventInterface');
    $eventMock->method('getSport')->willReturn('football');
    $eventMock->method('getEventType')->willReturn('goal');

    $this->eventStorageMock->expects($this->once())
      ->method('store')
      ->with(
        $this->equalTo($eventMock)
      );

    $eventProcessor = new \SSDMTechTest\EventProcessorManager($this->eventStorageMock);

    $eventProcessor->processEvent($eventMock);
  }

  public function testEventProcessorProcessExceptionOnType() {
    $this->setExpectedException(SSDMTechTest\InvalidEventException::class);

    $eventMock = $this->getMock('SSDMTechTest\EventInterface');
    $eventMock->method('getSport')->willReturn('football');
    $eventMock->method('getEventType')->willReturn('Oh snap!');

    $this->eventStorageMock->expects($this->never())
      ->method('store')
      ->with(
        $this->equalTo($eventMock)
      );

    $eventProcessor = new \SSDMTechTest\EventProcessorManager($this->eventStorageMock);

    $eventProcessor->processEvent($eventMock);
  }

  public function testEventProcessorProcessExceptionOnSport() {
    $this->setExpectedException(SSDMTechTest\InvalidEventException::class);

    $eventMock = $this->getMock('SSDMTechTest\EventInterface');
    $eventMock->method('getSport')->willReturn('Italian Sumo Wrestling');
    $eventMock->method('getEventType')->willReturn('touchdown!');

    $this->eventStorageMock->expects($this->never())
      ->method('store')
      ->with(
        $this->equalTo($eventMock)
      );

    $eventProcessor = new \SSDMTechTest\EventProcessorManager($this->eventStorageMock);

    $eventProcessor->processEvent($eventMock);
  }
}
