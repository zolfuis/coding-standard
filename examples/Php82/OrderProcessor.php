<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php82;

use LogicException;

/**
 * Demonstrates null-coalescing, early exit, and no-empty() patterns (PHP 8.2).
 */
final class OrderProcessor
{
    /** @var array<string, OrderItem> */
    private array $items = [];

    private ?string $couponCode = null;

    public function addItem(OrderItem $item): void
    {
        $existing = $this->items[$item->sku] ?? null;

        if ($existing !== null) {
            $this->items[$item->sku] = new OrderItem(
                $item->sku,
                $existing->quantity + $item->quantity,
                $item->unitPriceCents,
            );

            return;
        }

        $this->items[$item->sku] = $item;
    }

    public function removeItem(string $sku): void
    {
        if (!isset($this->items[$sku])) {
            throw new LogicException(sprintf('Item "%s" is not in the order.', $sku));
        }

        unset($this->items[$sku]);
    }

    public function applyCoupon(string $code): void
    {
        $this->couponCode = $code;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function subtotalCents(): int
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->totalCents();
        }

        return $total;
    }

    public function itemCount(): int
    {
        return count($this->items);
    }

    public function hasItems(): bool
    {
        return count($this->items) > 0;
    }

    /** @return array<string, OrderItem> */
    public function getItems(): array
    {
        return $this->items;
    }
}
