<?php
declare(strict_types=1);

namespace Mkk\Component\Notifier\Bridge\Ntfy;

use Symfony\Component\Notifier\Message\MessageOptionsInterface;
use Symfony\Component\Notifier\Notification\Notification;

final class NtfyOptions implements MessageOptionsInterface
{
    private array $options;
    const PRIORITY_MAX = 5;
    const PRIORITY_URGENT = 5;
    const PRIORITY_HIGH = 4;
    const PRIORITY_DEFAULT = 3;
    const PRIORITY_LOW = 2;
    const PRIORITY_MIN = 1;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public static function fromNotification(Notification $notification): self
    {
        $options = new self();
        $options->setTitle($notification->getSubject());
        $options->setMessage($notification->getContent());

        return $options;
    }

    public function toArray(): array
    {
        if (isset($this->options['tags'])) {
            $this->options['tags'] = implode(',', $this->options['tags']);
        }
        return $this->options;
    }

    public function getRecipientId(): ?string
    {
        return null;
    }

    public function setMessage(string $message): self
    {
        $this->options['message'] = $message;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->options['title'] = $title;
        return $this;
    }

    public function setPriority(int $priority): self
    {
        if (in_array($priority, [
            self::PRIORITY_MIN, self::PRIORITY_LOW, self::PRIORITY_DEFAULT, self::PRIORITY_HIGH, self::PRIORITY_URGENT, self::PRIORITY_MAX
        ])) {
            $this->options['priority'] = $priority;
        }
        return $this;
    }

    public function setTags(array $tags): self
    {
        $this->options['tags'] = $tags;
        return $this;
    }

    public function setDelay(\DateTimeInterface $dateTime): self
    {
        $this->options['delay'] = $dateTime->getTimestamp();
        return $this;
    }

    public function setActions(array $actions): self
    {
        $this->options['actions'] = $actions;
        return $this;
    }

    public function addActions(array $action): self
    {
        $this->options['actions'][] = $action;
        return $this;
    }

    public function setClick(string $url): self
    {
        $this->options['click'] = $url;
        return $this;
    }

    public function setAttachments(array $attachments): self
    {
        $this->options['attach'] = $attachments;
        return $this;
    }

    public function addAttachment(string $attachment): self
    {
        $this->options['attach'][] = $attachment;
        return $this;
    }

    public function setIcon(string $url): self
    {
        $this->options['icon'] = $url;
        return $this;
    }

    public function setCache(bool $enable)
    {
        if (!$enable) {
            $this->options['cache'] = 'no';
        } else {
            unset($this->options['cache']);
        }
    }
    public function setFirebase(bool $enable)
    {
        if (!$enable) {
            $this->options['firebase'] = 'no';
        } else {
            unset($this->options['firebase']);
        }
    }
}