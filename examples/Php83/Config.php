<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php83;

use InvalidArgumentException;

/**
 * Demonstrates typed class constants (PHP 8.3).
 */
final class Config
{
    public const string APP_NAME = 'ZolfuisApp';

    public const string DEFAULT_LOCALE = 'en_US';

    public const int MAX_RETRIES = 3;

    public const float REQUEST_TIMEOUT = 30.0;

    public const bool DEBUG_MODE = false;

    /** @var array<string, mixed> */
    private array $values;

    /**
     * @param array<string, mixed> $values
     */
    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    public function get(string $key): mixed
    {
        return $this->values[$key] ?? null;
    }

    public function getString(string $key, string $default = ''): string
    {
        $value = $this->get($key);

        if ($value === null) {
            return $default;
        }

        if (!is_string($value)) {
            throw new InvalidArgumentException(
                sprintf('Config key "%s" is not a string.', $key),
            );
        }

        return $value;
    }

    public function getInt(string $key, int $default = 0): int
    {
        $value = $this->get($key);

        if ($value === null) {
            return $default;
        }

        if (!is_int($value)) {
            throw new InvalidArgumentException(
                sprintf('Config key "%s" is not an integer.', $key),
            );
        }

        return $value;
    }

    public function getBool(string $key, bool $default = false): bool
    {
        $value = $this->get($key);

        if ($value === null) {
            return $default;
        }

        if (!is_bool($value)) {
            throw new InvalidArgumentException(
                sprintf('Config key "%s" is not a boolean.', $key),
            );
        }

        return $value;
    }

    public function set(string $key, mixed $value): self
    {
        $clone = clone $this;
        $clone->values[$key] = $value;

        return $clone;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->values);
    }

    /** @return array<string, mixed> */
    public function all(): array
    {
        return $this->values;
    }
}
