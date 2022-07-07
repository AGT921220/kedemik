<?php

namespace App\Http\Controllers;

use App\Bussines\Shared\Infrastructure\IsActiveUserChecker;
use App\Construction;

class ConstructionController extends Controller
{
    private $isActiveuserchecker;
    public function __construct(IsActiveUserChecker $isActiveuserchecker)
    {
        $this->isActiveuserchecker= $isActiveuserchecker;
    }
    public function index()
    {
        $constructions = new Construction();
        $constructions = $constructions->all();

        return view('news.construction', compact('constructions'));
    }
    public function show(int $construccionId)
    {
        $construccion = new Construction();
        $construccion = $construccion->where('id', $construccionId)->first();
        if (!$this->isActiveuserchecker->__invoke()) {
            $construccion->count = $construccion->count+1;
            $construccion->save();
        }
        return view('news.show.construccion', compact('construccion'));
    }
}
