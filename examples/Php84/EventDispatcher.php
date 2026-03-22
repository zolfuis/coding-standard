<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php84;

use InvalidArgumentException;
use LogicException;

/**
 * Demonstrates array_find(), array_all(), and #[\Deprecated] (PHP 8.4).
 */
final class EventDispatcher
{
    /** @var array<string, array<int, callable>> */
    private array $listeners = [];

    public function on(string $event, callable $listener): void
    {
        if ($event === '') {
            throw new InvalidArgumentException('Event name must not be empty.');
        }

        $this->listeners[$event][] = $listener;
    }

    public function dispatch(string $event, mixed $payload = null): void
    {
        $handlers = $this->listeners[$event] ?? [];

        foreach ($handlers as $handler) {
            $handler($payload);
        }
    }

    public function hasListeners(string $event): bool
    {
        $handlers = $this->listeners[$event] ?? [];

        return count($handlers) > 0;
    }

    /**
     * Returns the first listener for an event that satisfies the predicate, or null.
     */
    public function findListener(string $event, callable $predicate): ?callable
    {
        $handlers = $this->listeners[$event] ?? [];

        return array_find($handlers, $predicate);
    }

    /**
     * Returns true when all listeners for an event satisfy the predicate.
     */
    public function allListenersSatisfy(string $event, callable $predicate): bool
    {
        $handlers = $this->listeners[$event] ?? [];

        if (count($handlers) === 0) {
            return true;
        }

        return array_all($handlers, $predicate);
    }

    /**
     * @return array<string>
     */
    public function registeredEvents(): array
    {
        return array_keys($this->listeners);
    }

    public function removeListeners(string $event): void
    {
        unset($this->listeners[$event]);
    }

    /**
     * @deprecated Use on() instead.
     */
    #[\Deprecated(message: 'Use on() instead', since: '2.0')]
    public function addListener(string $event, callable $listener): void
    {
        if ($event === '') {
            throw new LogicException('Event name must not be empty.');
        }

        $this->on($event, $listener);
    }
}
