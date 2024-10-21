<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification as ModelsAdminNotification;
use Illuminate\Support\Facades\Auth;

class AdminNotification extends Controller
{
    public function clear_all() {
        try {
            $notification = ModelsAdminNotification::where('admin_id', Auth::guard('admin')->user()->id);
            $notification->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function read_all() {
        $notification = ModelsAdminNotification::where('admin_id', Auth::guard('admin')->user()->id);
        $notification->update(['is_read' => true]);
        return redirect()->back();
    }

    public function read_one($id) {
        $notification = ModelsAdminNotification::find($id);
        $notification->update(['is_read' => true]);
        return redirect()->to('/admin/dashboard');
    }
}
