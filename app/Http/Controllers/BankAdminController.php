<?php

namespace App\Http\Controllers;

use App\Models\BankAdmin;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAdminController extends Controller
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
    public function get_data_json() {
        $data = BankAdmin::all();
        return DataTables::of($data)
        ->addColumn('action', function($data) {
            return '<a href="javascript:void(0)" class="btn btn-sm btn-warning edit-bank" onclick="edit(' . htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8') . ')"><i class="bx bx-pencil"></i></a>
                <button type="button" class="btn btn-sm btn-danger" onclick="destroy(' . $data->id . ')"><i class="bx bx-trash"></i></button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function index() {
        $banks = $this->banks;
        return view('admin.bank.index', compact('banks'));
    }

    public function destroy($id) {
        $bank = BankAdmin::find($id);
        $bank->delete();
        return redirect()->back()->with('success', 'Bank berhasil dihapus');
    }

    public function store(Request $request) {
        $nama_bank = $this->banks[$request->bankCode];
        $kode_bank = $request->bankCode;
        $rekening = $request->account_number;
        $nama_rekening = $request->account_name;
        if($request->id) {
            $bank = BankAdmin::find($request->id);
            $bank->bank_account_number = $kode_bank;
            $bank->bank_name = $nama_bank;
            $bank->rekening = $rekening;
            $bank->bank_account_name = $nama_rekening;
            $bank->save();
            notify()->success('Bank berhasil diubah');
        } else {
            $bank = BankAdmin::create([
                'admin_id' => Auth::user()->id,
                'bank_account_number' => $kode_bank,
                'bank_name' => $nama_bank,
                'rekening' => $rekening,
                'bank_account_name' => $nama_rekening,
            ]);
            $bank->save();
            notify()->success('Bank berhasil ditambahkan');
        }
        return redirect()->back()->with('success', 'Bank berhasil ditambahkan');
    }


}
