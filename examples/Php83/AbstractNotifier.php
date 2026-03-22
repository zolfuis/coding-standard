<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php83;

/**
 * Abstract base notifier with shared channel logic.
 */
abstract class AbstractNotifier implements NotifierInterface
{
    public function __construct(
        protected readonly string $channel,
    ) {
    }

    #[\Override]
    public function getChannel(): string
    {
        return $this->channel;
    }
}
