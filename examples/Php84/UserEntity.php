<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php84;

use InvalidArgumentException;

/**
 * Demonstrates array_find() and array_all() from PHP 8.4.
 *
 * PHP 8.4 introduced array_find(), array_find_key(), array_any(), and array_all()
 * as built-in functions, replacing common array_filter()/array_search() patterns.
 */
final class UserEntity
{
    private string $name;

    private string $email;

    private int $loginCount = 0;

    /** @var array<int, string> */
    private array $roles = [];

    public function __construct(string $name, string $email)
    {
        $this->setName($name);
        $this->setEmail($email);
    }

    public function setName(string $name): void
    {
        if (trim($name) === '') {
            throw new InvalidArgumentException('Name must not be blank.');
        }

        $this->name = trim($name);
    }

    public function setEmail(string $email): void
    {
        if (!str_contains($email, '@')) {
            throw new InvalidArgumentException('Invalid e-mail address.');
        }

        $this->email = strtolower(trim($email));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function addRole(string $role): void
    {
        $this->roles[] = $role;
    }

    public function hasRole(string $role): bool
    {
        return array_find($this->roles, static fn(string $r): bool => $r === $role) !== null;
    }

    /**
     * Returns true if all roles start with the given prefix.
     */
    public function allRolesHavePrefix(string $prefix): bool
    {
        if (count($this->roles) === 0) {
            return true;
        }

        return array_all($this->roles, static fn(string $r): bool => str_starts_with($r, $prefix));
    }

    /**
     * Returns true if at least one role starts with the given prefix.
     */
    public function anyRoleHasPrefix(string $prefix): bool
    {
        return array_any($this->roles, static fn(string $r): bool => str_starts_with($r, $prefix));
    }

    /**
     * Returns the first role matching the predicate, or null.
     */
    public function findRole(callable $predicate): ?string
    {
        return array_find($this->roles, $predicate);
    }

    public function recordLogin(): void
    {
        $this->loginCount++;
    }

    public function getLoginCount(): int
    {
        return $this->loginCount;
    }

    public function hasLoggedIn(): bool
    {
        return $this->loginCount > 0;
    }

    /** @return array<int, string> */
    public function getRoles(): array
    {
        return $this->roles;
    }
}
