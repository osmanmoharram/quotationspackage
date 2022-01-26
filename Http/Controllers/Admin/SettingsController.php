<?php

namespace DOCore\DOQuot\Http\Controllers\Admin;

use Illuminate\Support\Facades\{DB, Session};
use DOCore\DOQuot\Http\Requests\UpdateSettingsRequest;

class SettingsController extends Controller
{
    public function index() {
        return view('doquot::admin.settings.index', [
            'totals' => DB::table('doquot_require_approval_totals')->get()
        ]);
    }
    public function update(UpdateSettingsRequest $request)
    {
        $this->applyRequireAdminApprovalAmount($request);

        return back()->with('flash_message', 'settings applied successfully');
    }

    protected function applyRequireAdminApprovalAmount($request)
    {
        /* make all require approval amounts not applied */
        DB::table('doquot_require_approval_totals')->where('applied', true)->update([
            'applied' => false
        ]);

        /* apply the selected require approval amount value */
        DB::table('doquot_require_approval_totals')->where('value', $request->require_approval_total)->update([
            'applied' => true
        ]);

        Session::put('applied_require_approval_total', $request->require_approval_total);
    }
}
