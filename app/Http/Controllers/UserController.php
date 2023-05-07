<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function masteruser()
    {
        $data = DB::table('master_masyarakats')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
            ->orderBy('RW', 'ASC')
            ->get();

        return view('master_user', compact('data'));
    }

    public function update(PasswordRequest $passwordrequest, $id)
    {
        $data = User::where('id_masyarakat', $id)->first();
        $validated = $passwordrequest->validated();
        $data->update($validated);

        return redirect('masteruser')->with('successedit', '');
    }
}
