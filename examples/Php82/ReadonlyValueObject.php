<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php82;

use InvalidArgumentException;

/**
 * Demonstrates readonly classes (PHP 8.2).
 *
 * All properties in a readonly class are implicitly readonly.
 */
readonly class Money
{
    public function __construct(
        public int $amount,
        public string $currency,
    ) {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount must not be negative.');
        }

        if ($currency === '') {
            throw new InvalidArgumentException('Currency must not be empty.');
        }
    }

    public function add(Money $other): self
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException(
                sprintf('Cannot add %s to %s.', $other->currency, $this->currency),
            );
        }

        return new self($this->amount + $other->amount, $this->currency);
    }

    public function subtract(Money $other): self
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException(
                sprintf('Cannot subtract %s from %s.', $other->currency, $this->currency),
            );
        }

        return new self($this->amount - $other->amount, $this->currency);
    }

    public function isZero(): bool
    {
        return $this->amount === 0;
    }

    public function equals(Money $other): bool
    {
        return $this->amount === $other->amount && $this->currency === $other->currency;
    }

    public function format(): string
    {
        return sprintf('%s %.2f', $this->currency, $this->amount / 100);
    }
}
