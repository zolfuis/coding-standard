<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php83;

/**
 * Demonstrates the #[\Override] attribute on a concrete notifier (PHP 8.3).
 *
 * #[\Override] makes the compiler verify the method actually overrides a parent,
 * catching typos and stale overrides at compile time.
 */
final class EmailNotifier extends AbstractNotifier
{
    /** @var array<int, string> */
    private array $log = [];

    public function __construct(
        private readonly string $fromAddress,
    ) {
        parent::__construct('email');
    }

    #[\Override]
    public function notify(string $message): void
    {
        $this->log[] = sprintf('[%s] %s', $this->fromAddress, $message);
    }

    #[\Override]
    public function supports(string $channel): bool
    {
        return $channel === $this->channel;
    }

    public function getFromAddress(): string
    {
        return $this->fromAddress;
    }

    /** @return array<int, string> */
    public function getLog(): array
    {
        return $this->log;
    }
}
