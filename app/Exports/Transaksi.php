<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Transaksi implements FromArray, WithHeadings, ShouldAutoSize
{
    protected $transactions;

    public function __construct(array $transactions)
    {
        $this->transactions = $transactions;
    }

    public function array(): array
    {
        return $this->transactions;
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Jumlah',
            'Harga',
            'Harga Jual',
            'Laba',
            'Total'
        ];
    }
}
