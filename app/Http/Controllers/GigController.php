<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GigController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['adminHome', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index() {
        $gigs = Gig::latest()->get();
        return view('home', ['gigs' => $gigs]);
    }

    public function adminHome() {
        $gigs = Gig::latest()->get();
        return view('manage', ['gigs' => $gigs]);
    }

    public function show($id) {
        $gig = Gig::findOrFail($id);
        return view('gigs.show', ['gig' => $gig]);
    }


    public function create() {
        return view('gigs.create');
    }

    public function store(Request $request) {

        $tags = [];

        foreach($request->tags as $key => $val) {
            $tag = Tag::find($val);
            if(!$tag) {
                $tag = Tag::create(['tag_name' => $val]);
                $tags[$key] = $tag->id;
            } else {
                $tags[$key] = $val;
            }
        }

        $array_tags = array_values($tags);

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
        $gig->tags()->attach($tags);

        return redirect()->route('home')->with('success', 'successfully created a gig');
    }

    public function edit($id) {
        $gig = Gig::find($id);
        $tags = $gig->tags->pluck('id')->toArray();
        return view('gigs.edit', ['gig' => $gig, 'tags' => $tags]);
    }

    public function update($id, Request $request) {

        // dd($request->all());
        // Validate The inputs
        $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'description' => 'required',
        ]);

        // get the gig that needs to be updated
        $gig = Gig::find($id);

        // update the values
        $gig->company_name = $request->company;
        $gig->job_title = $request->title;
        $gig->job_location = $request->location;
        $gig->contact_email = $request->email;
        $gig->url = $request->website;
        $gig->job_description = $request->description;


        // check if the image is updated
        if($request->logo) {
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // delete the previous image from the storage
            $oldImage = $gig->logo;
            if(File::exists(public_path('images/'. $oldImage))) {
                File::delete(public_path('images/'. $oldImage));
            }

            // store the newly added image
            $newImage = time().'.'. $request->logo->extension();
            $request->logo->move(public_path('images'), $newImage);
            $gig->logo = $newImage;
        }

        // delete previously added the tags
        $gig->tags()->detach();

        // add new tags
        $tags = [];

        // check if the tag is available in the tag table.
        // If not add the tag in the database then add them into the array.
        foreach($request->tags as $key => $val) {
            $tag = Tag::find($val);
            if(!$tag) {
                $tag = Tag::create(['tag_name' => $val]);
                $tags[$key] = $tag->id;
            } else {
                $tags[$key] = $val;
            }
        }

        // attach the tags with the gig
        $gig->tags()->attach($tags);

        $gig->save();

        return redirect()->route('adminHome')->with('success', 'Gig has been updated successfully.');
    }

    public function destroy($id) {
        $gig = Gig::find($id);
        $imageName = $gig->logo;

        if(File::exists(public_path('images/'. $imageName))) {
            File::delete(public_path('images/'. $imageName));
        }

        $gig->tags()->detach();
        $gig->delete();
        return back()->with('success', 'Successfully deleted the gig.');
    }


    public function search(Request $request) {
        $request->validate([
            'search' => 'required|regex:/([A-Za-z ])\w+/'
        ]);

        $gigs = Gig::where('job_title', 'like', '%'. $request->search .'%')
                    ->orWhere('company_name', 'like', '%'. $request->search .'%')
                    ->get();
        return view('home', ['gigs' => $gigs]);
    }

    public function FindByTag($id) {
        $gigs = Tag::find($id)->gigs->sortByDesc('id');
        return view('home', ['gigs' => $gigs]);
    }

}
