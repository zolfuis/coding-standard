<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php81;

use Countable;
use InvalidArgumentException;

/**
 * Demonstrates arrays, readonly properties, and PHP 8.1 features.
 */
final class CollectionHelper implements Countable
{
    /** @var array<int, string> */
    private array $items;

    public function __construct(
        private readonly string $name,
    ) {
        $this->items = [];
    }

    public function add(string $item): void
    {
        $this->items[] = $item;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /** @return array<int, string> */
    public function toArray(): array
    {
        return $this->items;
    }

    /** @return array<string, mixed> */
    public function toMap(string $key): array
    {
        if ($key === '') {
            throw new InvalidArgumentException('Key must not be empty.');
        }

        $result = [];
        foreach ($this->items as $index => $item) {
            $result[$item] = $index;
        }

        return $result;
    }

    /**
     * Returns a summary config array demonstrating trailing commas
     * and single-line array whitespace rules.
     *
     * @return array<string, mixed>
     */
    public function summary(): array
    {
        return [
            'name' => $this->name,
            'count' => $this->count(),
            'empty' => $this->count() === 0,
            'items' => $this->items,
        ];
    }

    /**
     * Merges another collection into this one.
     *
     * @param array<int, string> $extra
     */
    public function merge(array $extra): void
    {
        foreach ($extra as $item) {
            $this->items[] = $item;
        }
    }

    public function filter(callable $callback): self
    {
        $clone = new self($this->name);
        $clone->items = array_values(array_filter($this->items, $callback));

        return $clone;
    }

    public function map(callable $callback): self
    {
        $clone = new self($this->name);
        $clone->items = array_map($callback, $this->items);

        return $clone;
    }
}
