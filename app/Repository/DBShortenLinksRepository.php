<?php

namespace App\Repository;

use App\Models\ShortLink;
use Carbon\Carbon;
use App\RepositoryInterface\ShortenLinkRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class DBShortenLinksRepository implements ShortenLinkRepositoryInterface
{

    public function createShortenLinks(Request $request)
    {

        // check url existes
        $link = ShortLink::where(['link' => $request->link, 'user_id' => $request->user_id])->first();

        if ($link == null) {

            $shorten_link =  str::random(6);

            // expire date after 1 day
            $expireDate = Carbon::now()->addDays(1);

            ShortLink::create([
                'user_id' => $request->user_id,
                'link' => $request->link,
                'shorten_link' => $shorten_link,
                'expire_date' => $expireDate,
            ]);
        } else {
            return response()->json(['link' => 'This link is already in !']);
        }

        return response()->json(['expire_date' => $expireDate, 'link' => $request->link, 'shorten_link' => url("api/" . $shorten_link)]);
    }

    public function shortenLink($shortenLink)
    {
        $find = ShortLink::where('shorten_link', $shortenLink)->first();

        // check if the shorten url is active
        if ($find->active) {

            // increment the column (visits) when the shorten url is clicked
            $find->increment('visits');

            // exit page redirect to actual link
            return view('redirect', ["shortenURL" => $find->link]);
        } else {

            return response()->json([
                'message' => 'This link has been deactivated!'
            ]);
        }
    }

    public function list(Request $request)
    {
        // get all shorten url for a certen user
        $userShortLinksList = shortLink::where('user_id', $request->user_id)->get();
        return response()->json(['shorten_links' => $userShortLinksList]);
    }

    public function update(Request $request)
    {

        // updating the shorten url with a new one
        ShortLink::where(['id' => $request->id, 'user_id' => $request->user_id])->update(['shorten_link' => str::random(6)]);
        $newShortenLink = ShortLink::where(['id' => $request->id, 'user_id' => $request->user_id])->first();
        return response()->json([
            'new_shorten_link' => url("api/" . $newShortenLink->shorten_link)
        ]);
    }

    public function delete(Request $request)
    {
        // deleteing the shorten url
        ShortLink::where(['id' => $request->id, 'user_id' => $request->user_id])->delete();
        return response()->json([
            'deleted_shorten_link' => 'Deleted Succesfully!'
        ]);
    }

    public function deavtivate(Request $request)
    {
        $shortenLink = ShortLink::where(['id' => $request->id, 'user_id' => $request->user_id]);
        $message = "";

        // check if the shorten url is active or deactive
        if ($shortenLink->first()->active) {
            // update active colmun to 0 >> (deactivate shorten url)
            $shortenLink->update(['active' => 0]);
            $message = "shorten url deactivated successfully!";
        } else {
            $message = "shorten url is already deactivated!";
        }

        return response()->json([
            'message' => $message
        ]);
    }
}
