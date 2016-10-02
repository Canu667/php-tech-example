Sky Sports PHP Technical Test
=============================

Sky Sports have been given access to a new event stream for various sports, providing updates on key events during matches, tournaments, etc. One of your colleagues has already defined a number of interfaces (`EventInterface`, `EventStorageInterface`) to develop against.

You have been asked to create a system that will process and store a single `Event` object. Initially, we are only interested in `football` events. Other members of your team will immediately create processors for other sports, so you need to think about how your code will be able to be reused if at all.

Develop on the basis that an `Event` will be injected into your system, although how it is injected is up to you. Your system should be able to correctly decide whether an event should be processed, or discarded.

The sport we wish to process is `football`.  The event types you'll need to process are as follows:

- `kickoff`
- `goal`
- `yellowcard`
- `redcard`
- `penalty`
- `halftime`
- `fulltime`
- `extratime`
- `freekick`
- `corner`

Your unit tests should verify that your implementation is correct.

You have only been asked to develop the event processor implementation, and **NOT implement existing interfaces**. You do not need to know any implementation detail of Events or EventStorage - work with the contract provided.


#### Key points

- Given a single Event (`EventInterface`), determine whether or not to process it, and use EventStorage (`EventStorageInterface`) accordingly.
- Remember this is specific to a sport and a few event types. However, your colleagues are likely to reuse your code for other sports/event types.
- You are only developing the class(es) to handle the solution, *NOT* the glue code (e.g. controller) that ties it all together. You will give your solution to another colleague, who will tie all the objects together.
- Unit tests should verify whether your solution works or not.

#### Interfaces

Assume the interfaces you'll be interacting with are in the global namespace.

EventInterface:

```php
<?php
interface EventInterface
{

	/**
	 * Should return the sport type e.g. 'football'
	 * @return string
	 */
    public function getSport();

    /**
	 * Should return the event type e.g. 'kickoff'
	 * @return string
	 */
    public function getEventType();

}
```

EventStorageInterface:

```php
<?php
interface EventStorageInterface
{
	/**
	 * Stores an event
	 * @param  EventInterface $event
	 * @return boolean
	 */
    public function store(EventInterface $event);

}
```

### Setup

#### Prerequisites

* PHP 5.3+

#### Setup with composer

- `cd` into the project's root directory
- run `php composer.phar install` to install the dependencies needed.
- run `vendor/bin/phpunit -c test/phpunit.xml` to run the test suite.


#### Setup without composer

Your setup will vary, but you will require phpunit in order to run the tests, and possibly your own autoloader (if not using the default autoloader that comes with composer). You may need to amend the bootstrap file attributed in the phpunit config if so.
