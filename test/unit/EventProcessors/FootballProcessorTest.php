<?php

class FootballProcessorTest extends PHPUnit_Framework_TestCase {
  public function testFootballProcessorProcessSuccess() {
    $eventMock = $this->getMock('SSDMTechTest\EventInterface');
    $eventMock->method('getSport')->willReturn('football');
    $eventMock->method('getEventType')->willReturn('redcard');

    $eventProcessor = new \SSDMTechTest\EventProcessors\FootballProcessor();
    $event = $eventProcessor->process($eventMock);

    $this->assertEquals($eventMock, $event);
  }

  public function testFootballProcessorProcessExceptionOnSport() {
    $this->setExpectedException(SSDMTechTest\InvalidEventException::class);

    $eventMock = $this->getMock('SSDMTechTest\EventInterface');
    $eventMock->method('getSport')->willReturn('Polish Mosquito Boxing');
    $eventMock->method('getEventType')->willReturn('vicious bite');

    $eventProcessor = new \SSDMTechTest\EventProcessors\FootballProcessor();
    $eventProcessor->process($eventMock);
  }
}
