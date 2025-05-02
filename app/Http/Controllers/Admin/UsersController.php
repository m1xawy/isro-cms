<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SRO\Account\SkSilk;
use App\Models\SRO\Account\TbUser;
use App\Models\SRO\Portal\AphChangedSilk;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = TbUser::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('StrUserID', 'like', "%{$search}%");
            });
        }

        $data = $query->paginate(25);

        return view('admin.users.index', compact('data'));
    }

    public function view(TbUser $user)
    {
        return view('admin.users.view', compact('user'));
    }

    public function update(Request $request, TbUser $user)
    {
        $validated = $request->validate([
            'type' => 'required',
            'amount' => 'required|numeric',
        ]);

        SkSilk::setSkSilk($user->JID, $validated['type'], $validated['amount']);

        return back()->with('success', 'Silk have been Sent!');
    }
}
