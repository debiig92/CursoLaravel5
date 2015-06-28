<?php namespace Cinema\Http\Controllers;

use Cinema\Http\Requests;
use Cinema\Http\Requests\UserCreateRequest;
use Cinema\Http\Requests\UserUpdateRequest;
use Cinema\Http\Controllers\Controller;
use Cinema\User;
use Session;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class UsuarioController extends Controller {
	
	public function __construct(){
		$this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
	}

	public function find(Route $route){
		$this->user = User::find($route->getParameter('usuario'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::paginate(2);
		return view('usuario.index',compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('usuario.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserCreateRequest $request)
	{	
		User::create($request->all());

		Session::flash('message','Usuario Editado Correctamente');
		return Redirect::to('/usuario');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return view('usuario.edit',['user'=>$this->user]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UserUpdateRequest $request)
	{
		$this->user->fill($request->all());
		$this->user->save();

		Session::flash('message','Usuario Editado Correctamente');
		return Redirect::to('/usuario');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$this->user->delete();
		Session::flash('message','Usuario Eliminado Correctamente');
		return Redirect::to('/usuario');
	}

}
