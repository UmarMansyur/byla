<?php

namespace App\Exports;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserWallet::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get();
    }
    public function headings(): array
    {
        return [
            'Keterangan',
            'Kredit',
            'Debit',
            'Saldo',
        ];
    }

    public function map($userWallet): array
    {
        $data = [
            'keterangan' => $userWallet->kredit > 0 ? 'Transfer ke rekening ' . $userWallet->rekening : 'Transfer dari rekening ' . $userWallet->rekening_pengirim,
            'kredit' => $userWallet->kredit > 0 ? 'Rp. ' . number_format($userWallet->kredit, 0, ',', '.') : 0,
            'debit' => $userWallet->debit > 0 ? 'Rp. ' . number_format($userWallet->debit, 0, ',', '.') : 0,
            'saldo' => 'Rp. ' . number_format($userWallet->saldo, 0, ',', '.'),
        ];
        return $data;
    }
}
