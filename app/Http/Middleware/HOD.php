<?php

namespace App\Http\Middleware;

use App\course;
use App\result;
use Closure;
use Illuminate\Support\Facades\Auth;

class HOD
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
	    if (Auth::user()->role != "HOD"){

		    return redirect('/lecturers');
	    }

	    $courses = course::where('did',Auth::user()->did)->get();

	    $cids = $this->makeAnArray($courses,'cid');

	    $pending = result::hydrateRaw("select * from results where cid in $cids and isHodApproved = '0'")->unique('batchNumber');

	    $request->session()->put('pending',$pending);

	    return $next($request);
    }

	public function makeAnArray($data,$id){
		$appIds = "";

		foreach ($data as $item){
			$appIds .= $item->$id .',';
		}
		$appIds .= "0";
		$appIdsInBracket = "(".$appIds.")";
		return $appIdsInBracket;

	}
}
