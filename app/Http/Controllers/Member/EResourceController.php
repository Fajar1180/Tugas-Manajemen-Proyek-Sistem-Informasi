<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Models\EResource;
use Illuminate\Http\Request;
class EResourceController extends Controller {
    public function index() {
        $resources = EResource::latest()->paginate(12);
        return view('member.eresources.index', compact('resources'));
    }
    public function show(EResource $eresource) {
        return view('member.eresources.show', compact('eresource'));
    }
}
