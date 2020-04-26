<?php

namespace App\Model;

class Stream
{
    const MIN_LENGTH = 5;
    const MAX_LENGTH = 30;

    private int $length;
    private array $string;

    /**
     * Methods
     */

    public function __construct()
    {
        $this->length = rand(self::MIN_LENGTH, self::MAX_LENGTH);
        $this->string = [];
        $this->buildStream();
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getString(): array
    {
        return $this->string;
    }

    public function setString(array $string): self
    {
        $this->string = $string;

        return $this;
    }

    public function buildStream(): self
    {
        for ($i = 0; $i <= $this->length; $i++) {
            $this->addCharacter(mb_chr(rand(33, 126), 'UTF-8'));
        }

        return $this;
    }

    public function addCharacter(string $character): self
    {
        $this->string[] = $character;

        return $this;
    }

    public function __toString(): string
    {
        return implode('', $this->string);
    }
}
