<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ppmp;
use App\PpmpItem;
use Auth;
use App\Http\Requests\PpmpItemRequest;

class PpmpItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
    	$ppmp = Ppmp::findorFail($id);
    	$ppmp_itemDT = $ppmp->ppmpItem()->get();
    	return view('ppmp.ppmp_item.addppmpitm', compact('ppmp_itemDT','ppmp')) ;  
    }
}
