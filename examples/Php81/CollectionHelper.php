<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php81;

use Countable;
use InvalidArgumentException;

/**
 * Demonstrates arrays, readonly properties, and PHP 8.1 features.
 *
 * Array rules exercised in this file:
 *   - Arrays.TrailingArrayComma           → trailing comma on every multi-line array
 *   - Arrays.AlphabeticallySortedByKeys   → keys in summary() / DEFAULT_TAGS sorted a–z
 *   - Arrays.DisallowImplicitArrayCreation → $this->items initialised in __construct before use
 *   - Arrays.SingleLineArrayWhitespace    → single-line arrays have correct inner spacing
 *   - Arrays.ArrayAccess                  → never getItems()[0]; always assign first
 *   - Arrays.DisallowPartiallyKeyed       → every array is fully-keyed or fully-unkeyed
 *   - Arrays.MultiLineArrayEndBracketPlacement → closing ] always on its own line
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
            'count' => $this->count(),
            'empty' => $this->count() === 0,
            'items' => $this->items,
            'name' => $this->name,
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

    /**
     * Returns the first item, or null when the collection is empty.
     *
     * Arrays.ArrayAccess: the return value of toArray() is assigned to $items
     * before index access — never written as $this->toArray()[0].
     */
    public function first(): ?string
    {
        $items = $this->toArray();

        return $items[0] ?? null;
    }

    /**
     * Returns the last item, or null when the collection is empty.
     *
     * Arrays.ArrayAccess: same pattern — assign, then index.
     */
    public function last(): ?string
    {
        $items = $this->toArray();

        if ($items === []) {
            return null;
        }

        return $items[count($items) - 1];
    }

    /**
     * Returns a fully-keyed metadata array for this collection.
     *
     * Arrays.DisallowPartiallyKeyed: every element has an explicit string key.
     * Arrays.AlphabeticallySortedByKeys: keys are in a–z order.
     * Arrays.TrailingArrayComma: trailing comma after the last element.
     * Arrays.MultiLineArrayEndBracketPlacement: closing ] on its own line.
     *
     * @return array<string, mixed>
     */
    public function metadata(): array
    {
        return [
            'count' => $this->count(),
            'empty' => $this->count() === 0,
            'first' => $this->first(),
            'last' => $this->last(),
            'name' => $this->name,
        ];
    }

    /**
     * Returns a fully-unkeyed list of tags associated with this collection.
     *
     * Arrays.DisallowPartiallyKeyed: no keys at all — consistent unkeyed list.
     * Arrays.SingleLineArrayWhitespace: one space after [ and before ].
     *
     * @return array<int, string>
     */
    public function tags(): array
    {
        return ['collection', 'helper', 'php81'];
    }
}
