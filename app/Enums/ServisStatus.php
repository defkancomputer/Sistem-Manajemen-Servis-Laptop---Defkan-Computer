<?php

namespace App\Enums;

enum ServisStatus: string
{
    case MASUK = 'Masuk';
    case DICEK = 'Dicek';
    case PROSES = 'Proses';
    case SELESAI = 'Selesai';
    case DIAMBIL = 'Diambil';

    public function label(): string
    {
        return match($this) {
            self::MASUK => 'Masuk',
            self::DICEK => 'Dicek',
            self::PROSES => 'Proses',
            self::SELESAI => 'Selesai',
            self::DIAMBIL => 'Diambil',
        };
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::MASUK => 'badge-masuk',
            self::DICEK => 'badge-dicek',
            self::PROSES => 'badge-proses',
            self::SELESAI => 'badge-selesai',
            self::DIAMBIL => 'badge-diambil',
        };
    }
}
