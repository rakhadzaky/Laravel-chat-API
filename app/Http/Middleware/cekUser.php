<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use App\Rooms;

use Closure;

class cekUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $current_args = $request->route()->parameters();
        $id_room = (int) $current_args['id'];
        $data = Rooms::find($id_room)->users;
        for ($i=0; $i < sizeof($data); $i++) { 
            if($data[$i]->id == Auth::user()->id){
                return $next($request);
            }
        }
        return response()->json([
            'Status' => false,
            'error' => 'You are not a member from this room'
        ]);
    }
}
