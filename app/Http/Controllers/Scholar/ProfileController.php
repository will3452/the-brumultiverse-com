<?php

namespace App\Http\Controllers\Scholar;

use App\Models\User;
use App\Models\Account;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('scholar.profile.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => ['required', 'unique:users,email,'.$user->id],
            // 'user_name' => ['required', "unique:users,user_name,$user->id"],
            'password' => ['required'],
            // 'email' => ['required', "unique:users,email,$user->id", "email"],
            // 'address' => ['required'],
        ]);

        if ($data['email'] != $user->email) {
            $user->update(['email_verified_at' => null]);
        }

        $data['password'] = bcrypt($data['password']);

        $user->update($data);

        if ($user->hasVerifiedEmail()) {
            return back()->withSuccess('Updated!');
        }

        return redirect()->to('/verify-email-first');
    }

    public function updatePicture(Request $request)
    {
        $data['picture'] = FileHelper::filepondSave($request->file, ['size' => [30, 30]]);
        $data['copyright_disclaimer'] = true;
        auth()->user()->update($data);
        return back()->withSuccess('Updated!');
    }

    public function registerAccount(Request $request)
    {
        $data = $request->validate([
            'penname' => ['required', 'unique:accounts,penname'],
            'gender' => ['required'],
            'country' => ['required'],
            'picture' => ['required', 'image', 'max:2000'],
            'copyright_disclaimer' => '',
        ]);

        $data['approved_at'] = now();

        $data['picture'] = FileHelper::save($data['picture']);
        FileHelper::generateImage([30, 30], $data['picture']);

        auth()->user()->accounts()->create($data);
        return back()->withSuccess('created!');
    }

    public function removeAccount(Account $account)
    {
        FileHelper::delete($account);
        $account->delete();
        return back()->withSuccess('Deleted!');
    }

    public function updateAccountPicture(Request $request, Account $account)
    {
        $data = $request->validate([
            'file' => ['required', 'image', 'max:2000'],
        ]);

        $picture = FileHelper::save($data['file']);
        FileHelper::generateImage([30, 30], $picture);

        $account->update(['picture' => $picture]);
        return back()->withSuccess('Updated!');
    }
}
