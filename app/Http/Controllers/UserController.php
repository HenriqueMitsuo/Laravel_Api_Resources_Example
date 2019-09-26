<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserLogin as UserLoginResource;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $jwt_signer = new Sha256;
        $jwt_secret = "ThisIsASecret";

        $current_time = time();

        // $jwt_token = new JWT;

        $jwt_token = (new Builder())
            ->withClaim("user_name", $user->name)
            ->withClaim("user_email", $user->email)
            ->issuedAt($current_time)
            ->expiresAt($current_time + 3600)
            ->getToken($jwt_signer, new Key($jwt_secret));

        if($user->save()){
            return new UserLoginResource($user, strval($jwt_token));
        }
    }

    /**
     * Login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){

        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $user = User::where('email', '=', $email, 'and', 'password', '=', $password)->get();

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        

        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
