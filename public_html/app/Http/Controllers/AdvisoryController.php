<?php

namespace App\Http\Controllers;

use App\Advisory;
use App\Bussines\Shared\Infrastructure\IsActiveUserChecker;

class AdvisoryController extends Controller
{
    private $isActiveuserchecker;
    public function __construct(IsActiveUserChecker $isActiveuserchecker)
    {
        $this->isActiveuserchecker= $isActiveuserchecker;
    }
    public function index()
    {
        $advisories = new Advisory();
        $advisories = $advisories->all();

        return view('news.advisory', compact('advisories'));
    }
    public function show(int $advisoryId)
    {
        $advisory = new Advisory();
        $advisory = $advisory->where('id', $advisoryId)->first();
        if (!$this->isActiveuserchecker->__invoke()) {
            $advisory->count = $advisory->count+1;
            $advisory->save();
        }
        return view('news.show.advisory', compact('advisory'));
    }
}
