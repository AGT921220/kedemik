<?php

namespace App\Http\Controllers;

use App\Appraise;
use App\Bussines\Shared\Infrastructure\IsActiveUserChecker;

class AppraiseController extends Controller
{
    private $isActiveuserchecker;
    public function __construct(IsActiveUserChecker $isActiveuserchecker)
    {
        $this->isActiveuserchecker= $isActiveuserchecker;
    }
    public function index()
    {
        $appraises = new Appraise();
        $appraises = $appraises->all();

        return view('news.appraise', compact('appraises'));
    }
    public function show(int $appraiseId)
    {
        $appraise = new Appraise();
        $appraise = $appraise->where('id', $appraiseId)->first();
        if (!$this->isActiveuserchecker->__invoke()) {
            $appraise->count = $appraise->count+1;
            $appraise->save();
        }
        return view('news.show.appraise', compact('appraise'));
    }
}
