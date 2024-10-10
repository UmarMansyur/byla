<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankAdmin extends Controller
{
    //

    public function list_bank()
    {
        $bank = json_decode(file_get_contents(public_path('list-bank.json')), true);
        return response()->json($bank);
    }
}
