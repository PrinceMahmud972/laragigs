<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use Illuminate\Http\Request;

class GigController extends Controller
{
    public function index() {
        return view('home');
    }

    public function create() {
        return view('gigs.create');
    }

    public function store(Request $request) {

        $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'description' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageName = time().'.'. $request->logo->extension();

        $request->logo->move(public_path('images'), $imageName);

        $gig = new Gig();

        $gig->company_name = $request->company;
        $gig->job_title = $request->title;
        $gig->job_location = $request->location;
        $gig->contact_email = $request->email;
        $gig->url = $request->website;
        $gig->logo = $imageName;
        $gig->job_description = $request->description;
        $gig->save();

        return redirect()->route('home')->with('success', 'successfully created a gig');


    }
}
