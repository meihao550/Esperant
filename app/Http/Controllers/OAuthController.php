<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class OAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

 // app/Http/Controllers/OAuthController.php

    public function handleProviderCallback()
    {
        try {
            // ★ .stateless() を追加します
            $githubUser = Socialite::driver('github')->stateless()->user();
            
            $user = User::updateOrCreate([
                'email' => $githubUser->getEmail(),
            ], [
                'name' => $githubUser->getName() ?? $githubUser->getNickname() ?? 'GitHubユーザー',
                'password' => bcrypt(str()->random(16)), 
            ]);

            Auth::login($user);
            return redirect('/')->with('success', 'GitHubログインに成功しました！');

        } catch (Exception $e) {
            return redirect('/login')->with('error', '認証に失敗しました: ' . $e->getMessage());
        }
    }
}
