<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php81;

/**
 * Demonstrates backed enums and the never return type (PHP 8.1).
 */
enum UserStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Banned = 'banned';
    case PendingVerification = 'pending_verification';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
            self::Banned => 'Banned',
            self::PendingVerification => 'Pending Verification',
        };
    }

    public function isActive(): bool
    {
        return $this === self::Active;
    }

    public function isBanned(): bool
    {
        return $this === self::Banned;
    }

    public function canLogin(): bool
    {
        return $this === self::Active || $this === self::PendingVerification;
    }

    /**
     * Throws unconditionally — demonstrates the `never` return type.
     */
    public static function throwUnsupported(string $context): never
    {
        throw new \LogicException(
            sprintf('Unsupported user status operation in context: %s', $context),
        );
    }
}
