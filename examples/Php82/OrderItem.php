<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php82;

use InvalidArgumentException;

/**
 * Immutable readonly value object representing a single order line (PHP 8.2).
 */
readonly class OrderItem
{
    public function __construct(
        public string $sku,
        public int $quantity,
        public int $unitPriceCents,
    ) {
        if ($quantity <= 0) {
            throw new InvalidArgumentException('Quantity must be positive.');
        }
    }

    public function totalCents(): int
    {
        return $this->quantity * $this->unitPriceCents;
    }
}
