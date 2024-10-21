<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\Saldo;
use App\Models\UserWallet;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Pusher\PushNotifications\PushNotifications;

class BankTransfer extends Controller
{
    private $banks;
    public function __construct()
    {
        $banks = [
            "022" => "PT. BANK CIMB NIAGA - (CIMB)",
            "730" => "PT. BANK CIMB NIAGA UNIT USAHA SYARIAH - (CIMB SYARIAH)",
            "427" => "PT. BNI SYARIAH",
            "536" => "PT. BANK BCA SYARIAH",
            "441" => "PT. BANK BUKOPIN",
            "014" => "PT. BANK CENTRAL ASIA, TBK - (BCA)",
            "011" => "PT. BANK DANAMON INDONESIA",
            "111" => "PT. BANK DKI",
            "046" => "PT. BANK DBS INDONESIA",
            "087" => "PT. BANK HSBC INDONESIA",
            "008" => "PT. BANK MANDIRI (PERSERO), TBK",
            "564" => "PT. BANK MANDIRI TASPEN POS",
            "016" => "PT. BANK MAYBANK INDONESIA, TBK",
            "553" => "PT. BANK MAYORA",
            "426" => "PT. BANK MEGA, TBK",
            "147" => "PT. BANK MUAMALAT INDONESIA, TBK",
            "009" => "PT. BANK NEGARA INDONESIA (PERSERO), TBK (BNI)",
            "028" => "PT. BANK OCBC NISP, TBK",
            "731" => "PT. BANK OCBC NISP, TBK UNIT USAHA SYARIAH",
            "013" => "PT. BANK PERMATA, TBK",
            "721" => "PT. BANK PERMATA, TBK UNIT USAHA SYARIAH",
            "002" => "PT. BANK RAKYAT INDONESIA (PERSERO), TBK (BRI)",
            "494" => "PT. BANK RAKYAT INDONESIA AGRONIAGA, TBK",
            "422" => "PT. BANK SYARIAH BRI - (BRI SYARIAH)",
            "521" => "PT. BANK SYARIAH BUKOPIN",
            "451" => "PT. BANK SYARIAH MANDIRI",
            "200" => "PT. BANK TABUNGAN NEGARA (PERSERO), TBK (BTN)",
            "723" => "PT. BANK TABUNGAN NEGARA (PERSERO), TBK UNIT USAHA SYARIAH",
            "213" => "PT. BANK TABUNGAN PENSIUNAN NASIONAL - (BTPN)",
            "547" => "PT. BANK TABUNGAN PENSIUNAN NASIONAL SYARIAH - (BTPN Syariah)",
            "212" => "PT. BANK WOORI SAUDARA INDONESIA 1906, TBK (BWS)",
            "425" => "PT. BANK JABAR BANTEN SYARIAH",
            "137" => "PT. BANK PEMBANGUNAN DAERAH BANTEN",
            "054" => "PT. BANK CAPITAL INDONESIA",
            "724" => "PT. BANK DKI UNIT USAHA SYARIAH",
            "164" => "PT. BANK ICBC INDONESIA",
            "095" => "PT. BANK JTRUST INDONESIA, TBK",
        ];
        $this->banks = $banks;
    }

    public function index()
    {
        $banks = $this->banks;
        return view('pengguna.bank.transfer', compact('banks'));
    }

    public function getAccountDetails(Request $request)
    {
        $bankCode = $request->bank_id;
        $accountNumber = $request->account_number;
        $client = Http::get("https://api-rekening.lfourr.com/getBankAccount?bankCode={$bankCode}&accountNumber={$accountNumber}");
        return response()->json($client->json());
    }

    public function transfer(Request $request)
    {
        try {
            $request->validate([
                'bank_id' => 'required',
                'account_number' => 'required',
                'amount' => 'required',
                'pin' => 'required',
                'account_name' => 'required',
            ]);
            
            $saldo = Saldo::where('user_id', Auth::user()->id)->first();
            if (!Hash::check($request->pin, $saldo->pin)) {
                return redirect()->route('Transfer Bank Page')->with('error', 'PIN salah');
            }

            if ($saldo->saldo < $request->amount) {
                return redirect()->route('Transfer Bank Page')->with('error', 'Saldo tidak cukup');
            }

            $amount = str_replace('.', '', $request->amount);
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $data['kredit'] = $amount;
            $data['type'] = 'kredit';
            $data['debit'] = 0;
            $data['kode_bank'] = $data['bank_id'];
            $data['rekening'] = $data['account_number'];
            $data['nama'] = $data['account_name'];
            $data['status'] = 'pending';
            $data['saldo'] = $saldo->saldo - $amount;
            $data['kode_transaksi'] = 'TRX' . date('YmdHis');
            $data['rekening_pengirim'] = Auth::user()->user_code;
            UserWallet::create($data);
            // kirim notifikasi ke admin
            $beamsClient = new PushNotifications([
                'instanceId' => env('PUSHER_BEAMS_INSTANCE_ID'),
                'secretKey' => env('PUSHER_BEAMS_SECRET_KEY'),
            ]);
            $publishResponse = $beamsClient->publishToInterests(
                ['transaksi-update'],
                [
                    'web' => [
                        'notification' => [
                            'title' => 'Transfer Baru',
                            'body' => 'Transfer baru dengan kode transaksi ' . $data['kode_transaksi'],
                        ],
                    ],
                ]
            );
            $notification = AdminNotification::create([
                'admin_id' => 1,
                'title' => 'Transfer Baru',
                'url' => route('Transfer Page'),
                'thumbnail' => 'https://cdn-icons-png.flaticon.com/512/61/61457.png',
                'content' => 'Transfer baru dengan kode transaksi ' . $data['kode_transaksi'],
                'is_read' => false,
            ]);
            return redirect()->route('Transfer Bank Page')->with('success', 'Transfer berhasil');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('Transfer Bank Page')->with('error', 'Gagal melakukan transfer');
        }
    }
}
