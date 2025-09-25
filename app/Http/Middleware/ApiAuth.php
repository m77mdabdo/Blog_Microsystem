<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $access_token = $request->header('access_token');

        if (!$access_token) {
            $authorizationHeader = $request->header('Authorization');
            if ($authorizationHeader && str_starts_with($authorizationHeader, 'Bearer ')) {
                $access_token = substr($authorizationHeader, 7);
            }
        }

        // if (!$access_token) {
        //     return response()->json([
        //         "msg" => "Access token not found."
        //     ], 401);
        // }

        $user = User::where("access_token", $access_token)->first();

        if (!$user) {
            return response()->json([
                "msg" => "Invalid access token."
            ], 401);
        }

        // دمج المستخدم مع الطلب
        $request->merge(['auth_user' => $user]);

        return $next($request);
    }
}
