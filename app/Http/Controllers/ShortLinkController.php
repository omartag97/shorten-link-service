<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ShortLinkValidation;
use Carbon\Carbon;
use App\RepositoryInterface\ShortenLinkRepositoryInterface;

class ShortLinkController extends Controller
{

    private $ShortenLinksRepository;

    // __construct method automatically called when create a object from class 
    public function __construct(ShortenLinkRepositoryInterface $ShortenLinksRepository)
    {
        $this->ShortenLinksRepository  = $ShortenLinksRepository;
    }

    public function create(ShortLinkValidation $request)
    {
        $ShortenLinks = $this->ShortenLinksRepository->createShortenLinks($request);

        return $ShortenLinks;
    }

    public function shortenLink($shortenLink)
    {
        $ShortenLink = $this->ShortenLinksRepository->shortenLink($shortenLink);

        return $ShortenLink;
    }

    public function list(Request $request)
    {
        $list = $this->ShortenLinksRepository->list($request);

        return $list ;
    }

    public function update(Request $request)
    {

        $update = $this->ShortenLinksRepository->update($request);

        return $update ;
    }

    public function delete(Request $request)
    {
        $delete = $this->ShortenLinksRepository->delete($request);

        return $delete ;
    }

    public function deavtivate(Request $request)
    {
        $deavtivate = $this->ShortenLinksRepository->deavtivate($request);

        return $deavtivate ;
    }
}
