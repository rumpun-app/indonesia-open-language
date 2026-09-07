<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Script;
use App\Models\GrammarRule;

class LinguisticsController extends Controller
{
    public function scripts(Language $language) { return response()->json($language->scripts()->get()); }
    public function grammar(Language $language) { return response()->json(GrammarRule::where('language_id',$language->id)->where('status','published')->with('dialect')->paginate(20)); }
    public function script(Script $script) { return response()->json($script); }
}
