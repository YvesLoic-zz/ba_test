<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Library\Library;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use Library;

    /**
     * With the request-> only method, we only take the email-password as a *parameter and perform the user authentication with the attempt *function of the auth method in the laravel. If the user is correct, we *return a token for the user to use for later processing.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $res = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                throw new Exception('invalid_credentials');
            }
            $res = [
                'token' => 'Bearer ' . $token,
                'user' => auth()->user(),
            ];
            $res = $this->respondWithJSON(200, $res, null, null);
        } catch (Exception $e) {
            $res = $this->respondWithJSON(401, null, 'Invalid credentials', $e->getMessage());
        }
        return $res;
    }

    /**
     *Log out the user and make the token unusable.
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        if (Auth::check()) {
            if ($this->isRecognized($user)) {
                auth()->logout();
                return $this->respondWithJSON(200, null, 'Successfully logged out', null);
            }
            return $this->respondWithJSON(403, null, 'User not found', 'Unrecognized by the system');
        }
        return $this->respondWithJSON(500, null, 'User not authenticated', 'Unrecognized by the system');
    }

    /**
     * Renewal process to make JWT reusable after expiry date.
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(Request $request)
    {
        $user = $request->user();
        if (Auth::check()) {
            if ($this->isRecognized($user)) {
                return $this->respondWithJSON(200, auth()->refresh(), null, null);
            }
            return $this->respondWithJSON(403, null, 'User not found', 'Unrecognized by the system');
        }
        return $this->respondWithJSON(500, null, 'User not authenticated', 'Unrecognized by the system');
    }

    /**
     * @param $status
     * @param $token
     * @param $message
     * @param $error
     * @return JsonResponse
     */
    protected function respondWithJSON($status, $token, $message, $error)
    {
        $data = [
            'status' => $status,
            'data' => $token,
        ];
        $message ? $data['data'] = $message : null;
        $error ? $data['err'] = $error : null;
        return response()->json($data);
    }
}
