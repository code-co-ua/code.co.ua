<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;

class ChangesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkAdmin']);
    }

    public function show($id)
    {
        $audit = Audit::findOrFail($id);

        return view('audits.show', ['audit' => $audit]);
    }
}
