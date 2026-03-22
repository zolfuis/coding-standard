<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php83;

/**
 * Base contract for a notifier service.
 */
interface NotifierInterface
{
    public function notify(string $message): void;

    public function supports(string $channel): bool;

    public function getChannel(): string;
}
