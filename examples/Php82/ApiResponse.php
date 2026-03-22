<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php82;

use Countable;
use Stringable;

/**
 * Demonstrates DNF (Disjunctive Normal Form) types (PHP 8.2).
 *
 * A DNF type like (Countable&Stringable)|array means:
 * the value must implement both interfaces, or be a plain array.
 */
final class ApiResponse
{
    /** @var array<string, string> */
    private array $headers = [];

    /**
     * @param (Countable&Stringable)|array<mixed> $metadata
     */
    public function __construct(
        private readonly int $statusCode,
        private readonly string $body,
        private readonly (Countable&Stringable)|array $metadata,
    ) {
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return (Countable&Stringable)|array<mixed>
     */
    public function getMetadata(): (Countable&Stringable)|array
    {
        return $this->metadata;
    }

    public function isSuccessful(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }

    public function withHeader(string $name, string $value): self
    {
        $clone = clone $this;
        $clone->headers[$name] = $value;

        return $clone;
    }

    /** @return array<string, string> */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function metadataCount(): int
    {
        if ($this->metadata instanceof Countable) {
            return count($this->metadata);
        }

        return count($this->metadata);
    }

    public function metadataString(): string
    {
        if ($this->metadata instanceof Stringable) {
            return (string) $this->metadata;
        }

        return implode(', ', $this->metadata);
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'status' => $this->statusCode,
            'body' => $this->body,
            'headers' => $this->headers,
            'metadata_string' => $this->metadataString(),
        ];
    }
}
