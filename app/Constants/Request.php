<?php

namespace App\Constants;

class Request {
    //Categories
    const APLIKASI_JARINGAN = 'Layanan Aplikasi Jaringan';
    const APLIKASI_SENSUS_SURVEY = 'Layanan Aplikasi Sensus/Survei';
    const KAIZALA = 'Layanan Kaizala';
    const KONSULTASI = 'Layanan Konsultasi';
    const PERANGKAT_KERAS = 'Layanan Perangkat Keras';

    //Subcategories
    const EMAIL = 'Permintaan terkait Email';
    const BAGIAN_UMUM = 'Aplikasi Bagian Umum';
    const FUNGSI_SOSIAL = 'Aplikasi Fungsi Sosial';
    const FUNGSI_PRODUKSI = 'Aplikasi Fungsi Produksi';
    const FUNGSI_DISTRIBUSI = 'Aplikasi Fungsi Distribusi';
    const FUNGSI_NERWILIS = 'APlikasi Fungsi Nerwilis';
    const FUNGSI_IPDS = 'Aplikasi Fungsi IPDS';
    const LAYANAN_KAIZALA = 'Layanan Kaizala';
    const LAYANAN_KONSULTASI = 'Layanan Konsultasi';
    const PERBAIKAN_PERANGKAT_KERAS = 'Perbaikan Perangkat Keras';

    public static function allCategories() {
        return [
            self::APLIKASI_JARINGAN => 'Layanan Aplikasi Jaringan',
            self::APLIKASI_SENSUS_SURVEY => 'Layanan Aplikasi Sensus/Survei',
            self::KAIZALA => 'Layanan Kaizala',
            self::KONSULTASI => 'Layanan Konsultasi',
            self::PERANGKAT_KERAS => 'Layanan Perangkat Keras',
        ];
    }

    public static function allSubcategories() {
        return [
            self::EMAIL => 'Permintaan terkait Email',
            self::BAGIAN_UMUM => 'Aplikasi Bagian Umum',
            self::FUNGSI_SOSIAL => 'Aplikasi Fungsi Sosial',
            self::FUNGSI_PRODUKSI => 'Aplikasi Fungsi Produksi',
            self::FUNGSI_DISTRIBUSI => 'Aplikasi Fungsi Distribusi',
            self::FUNGSI_NERWILIS => 'APlikasi Fungsi Nerwilis',
            self::FUNGSI_IPDS => 'Aplikasi Fungsi IPDS',
            self::LAYANAN_KAIZALA => 'Layanan Kaizala',
            self::LAYANAN_KONSULTASI => 'Layanan Konsultasi',
            self::PERBAIKAN_PERANGKAT_KERAS => 'Perbaikan Perangkat Keras',
        ];
    }

    public static function subcategories($category) {
        switch ($category) {
            case "Layanan Aplikasi Jaringan":
                return [
                    self::EMAIL => 'Permintaan terkait Email',
                ]; break;

            case "Layanan Aplikasi Sensus/Survei":
                return [
                    self::BAGIAN_UMUM => 'Aplikasi Bagian Umum',
                    self::FUNGSI_SOSIAL => 'Aplikasi Fungsi Sosial',
                    self::FUNGSI_PRODUKSI => 'Aplikasi Fungsi Produksi',
                    self::FUNGSI_DISTRIBUSI => 'Aplikasi Fungsi Distribusi',
                    self::FUNGSI_NERWILIS => 'APlikasi Fungsi Nerwilis',
                    self::FUNGSI_IPDS => 'Aplikasi Fungsi IPDS',
                ]; break;

            case "Layanan Kaizala":
                return [
                    self::LAYANAN_KAIZALA => 'Layanan Kaizala',
                ]; break;

            case "Layanan Konsultasi":
                return [
                    self::LAYANAN_KONSULTASI => 'Layanan Konsultasi',
                ]; break;

            case "Layanan Perangkat Keras":
                return [
                    self::PERBAIKAN_PERANGKAT_KERAS => 'Perbaikan Perangkat Keras',
                ]; break;
        }
    }
}
