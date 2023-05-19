<?php

namespace App\Enums;

enum RaiseFundStatus: int
{
    case FAILURE = 0;
    case PENDING = 1;
    case SUCCESS = 2;

    public function isFailure(): bool
    {
        return $this === self::FAILURE;
    }
    public function isPending(): bool
    {
        return $this === self::PENDING;
    }
    public function isSuccess(): bool
    {
        return $this === self::SUCCESS;
    }

    public function getStatus($status): RaiseFundStatus
    {
        return match ($status) {
            'failure' => self::FAILURE,
            'pending' => self::PENDING,
            'success' => self::SUCCESS,
        };
    }

    public function getLabelText(): string
    {
        return match ($this) {
            self::FAILURE => 'Failure',
            self::PENDING => 'Pending',
            self::SUCCESS => 'Success',
        };
    }

    public function getLabelColor(): string
    {
        return match ($this) {
            self::FAILURE => 'bg-red-500',
            self::PENDING => 'bg-yellow-400',
            self::SUCCESS => 'bg-green-500',
        };
    }
    public function getLabelHTML(): string
    {
        return sprintf('<span class="rounded-full text-white px-1.5 %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
    }
}
