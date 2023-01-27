<?php

namespace App\Constants;

class Templates {
    public static function mailStVariables() {
        return [
            'mailCode' => 'Nomor surat tugas',
            'userName' => 'Nama pelaksana surat tugas',
            'userNIP' => 'NIP pelaksana surat tugas',
            'userFunction' => 'Jabatan pelaksana surat tugas',
            'taskTitle' => 'Nama tugas',
            'taskStartFrom' => 'Tanggal mulai surat tugas',
            'taskDueDate' => 'Tanggal selesai surat tugas',
            'mailSignatureDate' => 'Tanggal penandatanganan surat tugas (default: hari pengunduhan surat)',
            'userSignatureFunction' => 'Jabatan pejabat penanda tangan surat tugas',
            'userSignatureName' => 'Nama pejabat penanda tangan surat tugas',
        ];
    }

    public static function mailSpdVariables() {
        return [
            'ppkName' => 'Nama pejabat PPK',
            'ppkNIP' => 'NIP pejabat PPK',
            'userClass' => 'Golongan pelaksana surat tugas',
            'userRank' => 'Pangkat pelaksana surat tugas',
            'spdRank' => 'Peringkat surat SPD',
            'transportation' => 'Transportasi yang digunakan untuk surat tugas',
            'mailPlace' => 'Tujuan keberangkatan surat tugas',
            'taskDayDuration' => 'Lama pelaksanaan surat tugas (hari)',
            'userSignatureNIP' => 'NIP pejabat penanda tangan surat tugas',
        ];
    }

    public static function receiptVariables() {
        return [
            'payAmount' => 'Jumlah terhitung uang yang dibayarkan',
            'taskTitle' => 'Nama tugas',
            'mailPlace' => 'Tujuan keberangkatan surat tugas',
            'taskDayDuration' => 'Lama pelaksanaan surat tugas (hari)',
            'mailCode' => 'Nomor surat tugas',
            'taskStartFrom' => 'Tanggal mulai surat tugas',
            'payAmountText' => 'Jumlah terbilang uang yang dibayarkan',
            'financeName' => 'Nama pejabat bendahara',
            'financeNIP' => 'NIP pejabat bendahara',
            'ppkName' => 'Nama pejabat PPK',
            'ppkNIP' => 'NIP pejabat PPK',
            'userName' => 'Nama pelaksana surat tugas',
            'userNIP' => 'NIP pelaksana surat tugas',
            'userClass' => 'Golongan pelaksana surat tugas',
            'payDate' => 'Tanggal pembayaran surat tugas',
            'descNum' => 'Nomor rincian pembayaran',
            'descText' => 'Keterangan rincian pembayaran',
            'descAmount' => 'Jumlah terhitung rincian pembayaran',
        ];
    }
}
