<?php

namespace App\Http\Controllers;

use App\Bussines\Shared\Infrastructure\IsActiveUserChecker;
use App\Fovissste;

class FovisssteController extends Controller
{
    private $isActiveuserchecker;
    public function __construct(IsActiveUserChecker $isActiveuserchecker)
    {
        $this->isActiveuserchecker= $isActiveuserchecker;
    }
    public function index()
    {
        $fovissstes = new Fovissste();
        $fovissstes = $fovissstes->all();

        return view('news.fovissste', compact('fovissstes'));
    }
    public function show(int $fovisssteId)
    {
        $fovissste = new Fovissste();
        $fovissste = $fovissste->where('id', $fovisssteId)->first();
        if (!$this->isActiveuserchecker->__invoke()) {
            $fovissste->count = $fovissste->count+1;
            $fovissste->save();
        }
        return view('news.show.fovissste', compact('fovissste'));
    }
}
