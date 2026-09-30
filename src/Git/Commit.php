<?php

namespace Provenance\Git;

final class Commit
{
    public function __construct(
        private string $hash,
        private string $message,
        private array $files = []
    ) {}

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getFiles(): array
    {
        return $this->files;
    }
}
