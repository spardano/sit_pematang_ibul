<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CryptController;
use App\Models\LoginLogs;
use App\Models\Penduduk;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthMobileController extends Controller
{
    public $crypt;
    function __construct()
    {
        $this->crypt = new CryptController;
    }

    /**
     * Get the token array structure.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validasi Data Email dan Password
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.string' => 'Email tidak valid',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password tidak valid',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                "status" => false,
                "message" => "Email tidak ditemukan"
            ]);
        }

        $checkPassword = Hash::check($request->password, $user->password);

        if (!$checkPassword) {
            return response()->json([
                "status" => false,
                "message" => "Password atau email salah, perhatikan kembali data yang anda inputkan"
            ]);
        } else {

            $token = $this->crypt->crypt(Carbon::now());

            // Simpan Login Logs berserta token
            LoginLogs::create([
                'user_id' => $user->id,
                'token' => $token,
                'devices' => $_SERVER['HTTP_USER_AGENT'],
                'status' => 1
            ]);

            //authentication
            $request['id_user'] = $user->id;

            return $this->respondWithToken($token, $user, 'Berhasil Login!');
        }
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user, $message)
    {

        $data['access_token'] = $token;
        $data['user'] = $user;
        $data['expired_at'] = Carbon::now()->addDay();



        $temp['pas-foto'] = $user->penduduk->getFirstMediaUrl('pas-foto');
        $temp['kk'] = $user->penduduk->getFirstMediaUrl('kk');
        $temp['ktp'] = $user->penduduk->getFirstMediaUrl('ktp');


        $stringiFy = json_encode($data);
        $tokenCrypt = $this->crypt->crypt($stringiFy);

        return response()->json([
            'user' => $user,
            'dokumen' => $temp,
            'status' => true,
            'access_token' => $tokenCrypt,
            'expired_at' => $data['expired_at'],
            'message' => $message
        ], 200);
    }


    /**
     * logout
     *
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request)
    {
        try {
            $setStatusToFalse = LoginLogs::where('user_id', $request->user->id)->where('token', $request->access_token)->first();

            $setStatusToFalse->update([
                "status" => 0
            ]);

            if ($setStatusToFalse) {
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil Log Out'
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'Gagal Log Out'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e
            ], 500);
        }
    }


    /**
     * register User
     *
     * @param  mixed $request
     * @return void
     */
    public function register(Request $request)
    {

        //cek if email already exist
        $cekEmail = User::where('email', $request->email)->first();
        if ($cekEmail) {
            return response()->json([
                "status" => false,
                "message" => 'Email yang diinputkan sudah terdaftar !'
            ]);
        }

        $cekNik = User::where('nik', $request->nik)->first();
        if ($cekNik) {
            return response()->json([
                "status" => false,
                "message" => 'NIk yang diinputkan sudah terdaftar !'
            ]);
        }

        $cekPenduduk = Penduduk::where('nik', $request->nik)->first();
        if (!$cekPenduduk) {
            return response()->json([
                "status" => false,
                "message" => 'Maaf, NIK anda tidak terdaftar sebagai penduduk Desa Pematang Ibul'
            ]);
        }


        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'role' => 'pengguna',
        ]);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil Registrasi, silahkan login!'
            ]);
        } else {

            return response()->json([
                'status' => false,
                'message' => 'Gagal registrasi akun'
            ]);
        }
    }



    /**
     * checkToken memeriksa token
     *
     * @param  mixed $request
     * @return void
     */
    public function checkToken(Request $request)
    {
        $token = $this->crypt->crypt($request->token, 'd');
        $decode_json_data = json_decode($token);

        if ($decode_json_data) {

            $isExpired = Carbon::now() >= $decode_json_data->expired_at;

            if ($isExpired) {
                return response()->json([
                    'status' => false,
                    'isExpired' => true,
                    'message' => 'Token Sudah Expired, Silahkan login kembali'
                ], 200);
            }

            return response()->json([
                'status' => true,
                'isExpired' => false,
            ], 200);
        }
    }

    public function uploadPic(Request $request, $type)
    {
        $user = User::find($request['user']['id']);

        if (!$request->has('file')) {
            return response()->json([
                'status' => false,
                'message' => 'Dokument tidak ditemukan'
            ], 422);
        }

        $user->penduduk->addMediaFromRequest('file')->toMediaCollection($type);

        if ($type == 'pas-foto') {
            $user->penduduk->pas_foto = 1;
        }

        if ($type == 'ktp') {
            $user->penduduk->file_ktp = 1;
        }

        if ($type == 'kk') {
            $user->penduduk->file_kk = 1;
        }

        $user->penduduk->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Upload Berkas',
            'type' => $type,
            'file' => $user->penduduk->getFirstMediaUrl($type),
        ]);
    }

    public function updateProfile(Request $request)
    {

        $user = User::where('id', $request['user']['id'])->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $newUser = User::find($request['user']['id']);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'berhasil menyimpan perubahan',
                'data' => $newUser,
            ]);
        }


        return response()->json([
            'status' => false,
            'message' => 'Gagal menyimpan perubahan'
        ]);
    }

    public function editPassword(Request $request)
    {

        // return $checkPasslama = base64_encode(md5($request->passlama));
        $pass = User::where('id', $request->id)->first();
        $checkPassword = Hash::check($request->passlama, $pass->password);
        if ($checkPassword) {
            User::where('id', $request->id)->update([
                'password' => Hash::make($request->passbaru)
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Password berhasil di perbarui'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Password lama yang anda masukan tidak benar'
        ]);
    }
}
