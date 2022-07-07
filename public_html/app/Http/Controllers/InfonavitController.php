<?php

namespace App\Http\Controllers;

use App\Bussines\Shared\Infrastructure\IsActiveUserChecker;
use App\Infonavit;
use Illuminate\Http\Request;

class InfonavitController extends Controller
{
    private $isActiveuserchecker;
    public function __construct(IsActiveUserChecker $isActiveuserchecker)
    {
        $this->isActiveuserchecker= $isActiveuserchecker;
    }
    public function index()
    {
        $infonavits = new Infonavit();
        $infonavits = $infonavits->all();

        return view('news.infonavit', compact('infonavits'));
    }

    public function show(int $infonavitId)
    {
        $infonavit = new Infonavit();
        $infonavit = $infonavit->where('id', $infonavitId)->first();
        if (!$this->isActiveuserchecker->__invoke()) {
            $infonavit->count = $infonavit->count+1;
            $infonavit->save();
        }
        return view('news.show.infonavit', compact('infonavit'));
    }
}
