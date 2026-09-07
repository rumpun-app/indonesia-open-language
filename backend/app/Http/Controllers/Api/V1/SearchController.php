<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\LexicalEntry;
use App\Models\CommunityPost;
use App\Models\Source;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(['q'=>['required','string','max:200']]); $term=$request->string('q');
        return response()->json(['query'=>$term,'languages'=>Language::where('status','published')->where(fn($q)=>$q->where('name','like',"%{$term}%")->orWhere('native_name','like',"%{$term}%"))->limit(10)->get(['id','slug','name','native_name']),'dictionary'=>LexicalEntry::with(['wordForms','senses'])->where('status','published')->where(fn($q)=>$q->whereHas('wordForms',fn($w)=>$w->where('form','like',"%{$term}%"))->orWhereHas('senses',fn($s)=>$s->where('definition','like',"%{$term}%")))->limit(10)->get(),'community'=>CommunityPost::where('status','published')->where(fn($q)=>$q->where('title','like',"%{$term}%")->orWhere('body','like',"%{$term}%"))->limit(10)->get(['id','title','body']),'sources'=>Source::where('title','like',"%{$term}%")->limit(10)->get(['id','title','type'])]);
    }
}
