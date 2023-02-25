<?php
namespace App\Traits;

trait  permissionTrait{
	public function hasPermission(){


		//for user
		if(!isset(auth()->user()->role->permission['name']['user']['can-view']) && \Route::is('users.index')){
			return abort(401);
		}
		if(!isset(auth()->user()->role->permission['name']['user']['can-view']) && \Route::is('users.create')){
			return abort(401);
		}
		//for role
		if(!isset(auth()->user()->role->permission['name']['role']['can-view']) && \Route::is('roles.index')){
			return abort(401);
		}
		if(!isset(auth()->user()->role->permission['name']['role']['can-view']) && \Route::is('roles.create')){
			return abort(401);
		}
		//permission
		if(!isset(auth()->user()->role->permission['name']['permission']['can-view']) && \Route::is('permissions.index')){
			return abort(401);
		}
		if(!isset(auth()->user()->role->permission['name']['permission']['can-view']) && \Route::is('permissions.create')){
			return abort(401);
		}
	}
}
