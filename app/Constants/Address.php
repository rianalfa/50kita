<?php

namespace App\Constants;

class Address {
    const JORONG_SATU = 'Satu';
    const JORONG_DUA = 'Dua';
    const JORONG_TIGA = 'Tiga';

    const NAGARI_SATU = 'Satu';
    const NAGARI_DUA = 'Dua';
    const NAGARI_TIGA = 'Tiga';

    const KECAMATAN_SATU = 'Satu';
    const KECAMATAN_DUA = 'Dua';
    const KECAMATAN_TIGA = 'Tiga';

    public static function subvillages() {
        return [
            self::JORONG_SATU => 'Satu',
            self::JORONG_DUA => 'Dua',
            self::JORONG_TIGA => 'Tiga',
        ];
    }

    public static function villages() {
        return [
            self::NAGARI_SATU => 'Satu',
            self::NAGARI_DUA => 'Dua',
            self::NAGARI_TIGA => 'Tiga',
        ];
    }

    public static function districts() {
        return [
            self::KECAMATAN_SATU => 'Satu',
            self::KECAMATAN_DUA => 'Dua',
            self::KECAMATAN_TIGA => 'Tiga',
        ];
    }
}
