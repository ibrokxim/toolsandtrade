<?php

namespace App\Http\Controllers\Admin;

use App\Models\Main;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{

    public function edit()
    {
        $main = Main::findOrFail(1);
        return view('admin.main.edit', compact('main'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'mail' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email_address' => 'required|email',
        ]);

        $main = Main::findOrFail(1);

        $main->mail = $request->input('mail');
        $main->phone = $request->input('phone');
        $main->address = $request->input('address');
        $main->email_address = $request->input('email_address');

        if ($request->hasFile('logo')) {
            if ($main->logo) {
                Storage::delete($main->logo);
            }

            $path = $request->file('logo')->store('logos', 'public');
            $main->logo = $path;
        }

        $main->save();

        return redirect()->route('admin.main.edit')->with('success', 'Запись успешно обновлена');
    }
}
