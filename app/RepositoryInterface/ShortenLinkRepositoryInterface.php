<?php

namespace App\RepositoryInterface;

use Illuminate\Http\Request;

interface ShortenLinkRepositoryInterface{

    public function createShortenLinks(Request $request);

    public function shortenLink($shortenLink);

    public function list(Request $request);

    public function update(Request $request);

    public function delete(Request $request);

    public function deavtivate(Request $request);




}
