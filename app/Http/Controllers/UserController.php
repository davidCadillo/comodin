<?php

namespace App\Http\Controllers;

use App\HttpResponseCode;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(UserRequest $request) {
		try {
			$validator = \Validator::make($request->all(), $request->rules());
			if ($validator->fails()) {
				return $validator->errors();
			} else {
				User::create($request->all());
				return HttpResponseCode::response(201, 'Usuario creado correctamente.');
			}
		} catch (\Exception $e) {
			return HttpResponseCode::response(500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user) {
		return $user;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user) {
		$user->delete();
		return HttpResponseCode::response(200, 'Usuario eliminado correctamente');

	}

	public function ubigeo(User $user) {
		return $user->ubigeo()->get();
	}

	public function agente() {
		$agent = new Agent();
		return response()->json($agent->isMobile());
	}
}
