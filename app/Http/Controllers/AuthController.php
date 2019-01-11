<?php

    namespace App\Http\Controllers;

    use Auth;
    use JWTAuth;
    use App\User;
    use App\Http\Requests\RegisterFormRequest;
    use Illuminate\Http\Request;

    class AuthController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth:api', ['except' => ['login']]);
        }

        public function register(RegisterFormRequest $request)
        {
            $user = new User;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->save();

            return response([
                'status' => 'success',
                'data' => $user
            ], 200);
        }

        public function login(Request $request)
        {
            $credentials = request(['email', 'password']);

            if ( ! $token = auth()->attempt($credentials)) {
                return response([
                    'status' => 'error',
                    'error' => 'invalid.credentials',
                    'msg' => 'Invalid Credentials.'
                ], 400);
            }

            return $this->respondWithToken($token);
        }

        public function user(Request $request)
        {
            return response()->json(auth()->user());
        }

        public function guard()
        {
            return Auth::guard();
        }

        protected function respondWithToken($token)
        {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        }

        public function refresh()
        {
            return $this->respondWithToken($this->auth()->refresh());
        }

        public function logout()
        {
            auth()->logout();

            return response()->json(['message' => 'Successfully logged out']);    
        }

}
