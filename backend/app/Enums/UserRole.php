<?php

namespace App\Enums;

enum UserRole: int
{
    case ADMIN = 1;
    case USER = 0;

    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }
    public function isUser(): bool
    {
        return $this === self::USER;
    }

    public function getRole(): string
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::USER => 'user',
        };
    }

    public function getLabelText(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::USER => 'User',
        };
    }

    public function getLabelColor(): string
    {
        return match ($this) {
            self::ADMIN => 'bg-blue-600',
            self::USER => 'bg-gray-400',
        };
    }
    public function getLabelHTML(): string
    {
        return sprintf('<span class="rounded-full text-white px-1.5 %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
    }
}
