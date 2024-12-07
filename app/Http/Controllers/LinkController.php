<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LinkController extends Controller
{
    // Method to show the link shortener page
    public function showLinkShortenerPage()
    {
        return Inertia::render('Home', [
            'bitlyAccessToken' => env('BITLY_ACCESS_TOKEN')  // Passing the Bitly token to the Vue component
        ]);
    }

    // Method to shorten the URL
    public function shorten(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $originalUrl = $request->input('url');
        $shortenedUrl = substr(md5($originalUrl . time()), 0, 6);

        // Save the link to the database (optional)
        Link::create([
            'original_url' => $originalUrl,
            'shortened_url' => $shortenedUrl,
        ]);

        return response()->json(['shortened_url' => url("/$shortenedUrl")]);
    }

    // Method to handle redirect from shortened URL
    public function redirect($shortenedUrl)
    {
        $link = Link::where('shortened_url', $shortenedUrl)->firstOrFail();
        return redirect()->to($link->original_url);
    }
}
