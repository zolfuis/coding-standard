<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php81;

use Countable;
use Stringable;

/**
 * Demonstrates intersection types and alphabetical imports (PHP 8.1).
 */
final class ProductRepository
{
    /** @var array<int, array<string, mixed>> */
    private array $store = [];

    private int $nextId = 1;

    /**
     * Persist a product whose identifier implements both Countable and Stringable.
     *
     * @param array<string, mixed> $data
     */
    public function save(Countable&Stringable $identifier, array $data): int
    {
        $id = $this->nextId;
        $this->store[$id] = [
            'identifier' => (string) $identifier,
            'data' => $data,
        ];
        $this->nextId++;

        return $id;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function find(int $id): ?array
    {
        return $this->store[$id] ?? null;
    }

    public function delete(int $id): bool
    {
        if (!isset($this->store[$id])) {
            return false;
        }

        unset($this->store[$id]);

        return true;
    }

    /** @return array<int, array<string, mixed>> */
    public function findAll(): array
    {
        return $this->store;
    }

    public function count(): int
    {
        return count($this->store);
    }

    /**
     * Demonstrates null coalescing and early-exit guard clause.
     *
     * @param array<string, mixed> $defaults
     *
     * @return array<string, mixed>
     */
    public function findWithDefaults(int $id, array $defaults): array
    {
        $record = $this->find($id);

        if ($record === null) {
            return $defaults;
        }

        return array_merge($defaults, $record['data']);
    }
}
