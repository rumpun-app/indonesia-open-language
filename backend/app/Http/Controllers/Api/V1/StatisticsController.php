<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\LexicalEntry;
use App\Models\Contribution;
use App\Models\Review;
use App\Models\ContentReport;
use App\Models\User;

class StatisticsController extends Controller
{
    public function language(Language $language)
    {
        return response()->json(['language'=>['id'=>$language->id,'slug'=>$language->slug,'name'=>$language->name],'dialects'=>$language->dialects()->count(),'published_entries'=>LexicalEntry::where('language_id',$language->id)->where('status','published')->count(),'published_phrases'=>\App\Models\Phrase::where('language_id',$language->id)->where('status','published')->count(),'examples'=>\App\Models\ExampleSentence::where('language_id',$language->id)->where('status','published')->count(),'contributors'=>Contribution::where('status','published')->whereHas('author')->distinct('author_id')->count('author_id')]);
    }

    public function admin(Request $request)
    {
        abort_unless($request->user()->hasPermission('moderation.manage'),403);
        return response()->json(['pending_contributions'=>Contribution::whereIn('status',['submitted','under_review'])->count(),'pending_reviews'=>Review::where('decision','flag')->count(),'open_reports'=>ContentReport::where('status','open')->count(),'published_entries'=>LexicalEntry::where('status','published')->count(),'active_contributors'=>User::whereHas('roles',fn($q)=>$q->whereIn('slug',['contributor','reviewer']))->count()]);
    }
}
