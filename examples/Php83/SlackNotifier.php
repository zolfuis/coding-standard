<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php83;

/**
 * A Slack-based notifier, also demonstrating #[\Override] (PHP 8.3).
 */
final class SlackNotifier extends AbstractNotifier
{
    /** @var array<int, string> */
    private array $sent = [];

    public function __construct(
        private readonly string $webhookUrl,
    ) {
        parent::__construct('slack');
    }

    #[\Override]
    public function notify(string $message): void
    {
        $this->sent[] = sprintf('%s -> %s', $this->webhookUrl, $message);
    }

    #[\Override]
    public function supports(string $channel): bool
    {
        return $channel === $this->channel;
    }

    public function getWebhookUrl(): string
    {
        return $this->webhookUrl;
    }

    /** @return array<int, string> */
    public function getSent(): array
    {
        return $this->sent;
    }
}
