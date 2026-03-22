<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php83;

use InvalidArgumentException;

/**
 * Demonstrates json_validate() (PHP 8.3), early exit, and control-structure patterns.
 */
final class JsonValidator
{
    private int $depth;

    private int $flags;

    public function __construct(int $depth = 512, int $flags = 0)
    {
        if ($depth < 1) {
            throw new InvalidArgumentException('Depth must be at least 1.');
        }

        $this->depth = $depth;
        $this->flags = $flags;
    }

    /**
     * Returns true when the string is valid JSON.
     */
    public function isValid(string $json): bool
    {
        if ($json === '') {
            return false;
        }

        return json_validate($json, $this->depth, $this->flags);
    }

    /**
     * Returns decoded data or null when the input is invalid JSON.
     *
     * Demonstrates early exit (guard clause) pattern.
     *
     * @return array<mixed>|null
     */
    public function decode(string $json): ?array
    {
        if (!$this->isValid($json)) {
            return null;
        }

        $decoded = json_decode($json, true, $this->depth, JSON_THROW_ON_ERROR);

        if (!is_array($decoded)) {
            return null;
        }

        return $decoded;
    }

    /**
     * Returns the first validation error message, or null when valid.
     */
    public function errorMessage(string $json): ?string
    {
        if ($this->isValid($json)) {
            return null;
        }

        if ($json === '') {
            return 'Input is empty.';
        }

        return 'Input is not valid JSON.';
    }

    /**
     * Asserts that the JSON string is valid; throws otherwise.
     *
     * @throws InvalidArgumentException
     */
    public function assertValid(string $json): void
    {
        if ($this->isValid($json)) {
            return;
        }

        $error = $this->errorMessage($json) ?? 'Invalid JSON.';

        throw new InvalidArgumentException($error);
    }

    public function getDepth(): int
    {
        return $this->depth;
    }
}
