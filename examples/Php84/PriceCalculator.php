<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php84;

use InvalidArgumentException;

/**
 * Demonstrates array_find_key(), array_any() and #[\Deprecated] (PHP 8.4).
 */
final class PriceCalculator
{
    /** @var array<string, int> Discount codes mapped to basis-point discounts */
    private array $discountCodes = [];

    private int $appliedDiscountBps = 0;

    public function __construct(
        private readonly int $vatRateBps,
    ) {
        if ($vatRateBps < 0 || $vatRateBps > 10_000) {
            throw new InvalidArgumentException('VAT rate must be between 0 and 10000 bps.');
        }
    }

    public function registerDiscount(string $code, int $bps): void
    {
        if ($bps < 0 || $bps > 10_000) {
            throw new InvalidArgumentException('Discount must be between 0 and 10000 bps.');
        }

        $this->discountCodes[$code] = $bps;
    }

    public function applyDiscount(string $code): void
    {
        $bps = $this->discountCodes[$code] ?? null;

        if ($bps === null) {
            throw new InvalidArgumentException(sprintf('Unknown discount code: %s', $code));
        }

        $this->appliedDiscountBps = $bps;
    }

    /**
     * Returns true when any registered discount is at or above the given threshold.
     */
    public function hasLargeDiscount(int $thresholdBps): bool
    {
        return array_any(
            $this->discountCodes,
            static fn(int $bps): bool => $bps >= $thresholdBps,
        );
    }

    /**
     * Returns the first discount code whose value meets the threshold, or null.
     */
    public function findDiscountCode(int $thresholdBps): ?string
    {
        return array_find_key(
            $this->discountCodes,
            static fn(int $bps): bool => $bps >= $thresholdBps,
        );
    }

    /**
     * Returns true when all registered discounts are at or below the given cap.
     */
    public function allDiscountsBelowCap(int $capBps): bool
    {
        return array_all(
            $this->discountCodes,
            static fn(int $bps): bool => $bps <= $capBps,
        );
    }

    public function calculate(int $netCents): int
    {
        $afterDiscount = $netCents - (int) ($netCents * $this->appliedDiscountBps / 10_000);
        $vat = (int) ($afterDiscount * $this->vatRateBps / 10_000);

        return $afterDiscount + $vat;
    }

    public function getVatRateBps(): int
    {
        return $this->vatRateBps;
    }

    /** @return array<string, int> */
    public function getDiscountCodes(): array
    {
        return $this->discountCodes;
    }

    /**
     * @deprecated Use registerDiscount() instead.
     */
    #[\Deprecated(message: 'Use registerDiscount() instead', since: '2.0')]
    public function addCode(string $code, int $bps): void
    {
        $this->registerDiscount($code, $bps);
    }
}
