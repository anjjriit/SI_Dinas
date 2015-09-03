<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/';
    protected $loginPath = '/login';
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Override laravel default login method
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Cek apakah user aktif
        if(Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
            $user = Auth::user();

            $first_login = is_null($user->last_login);

            //update last login
            $user->last_login = Carbon::now()->setTimezone('Asia/Jakarta');
            $user->save();

            if ($first_login) {
                return redirect('user/password')->with('warning', 'Anda baru pertama kali melakukan login, harap ubah password terlebih dahulu untuk melanjutkan.');
            } else {
                return redirect('user');
            }
        }

        // Cek apakah user tidak aktif
        elseif (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 0])) {
            Auth::logout();

            return redirect('login')->with('warning', 'Status akun Anda non-aktif, silahkan hubungi administrator untuk keterangan lebih lanjut.');
        }
        // Jika email atau password salah
        else {
            return redirect('login')->with('warning', 'Email dan password tidak sesuai, silahkan coba lagi.');
        }
    }
}
