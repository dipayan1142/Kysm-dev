<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallerys = Gallery::orderBy('id', 'desc')->get();
        return view('gallery/list', compact('gallerys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gallery = new Gallery();
        $gallery->name = request('name');
        // Check if image is present
        if ($request->hasFile('attachment')) {
            $attachmentimg = $request->file('attachment');

            $ext = $attachmentimg->getClientOriginalExtension();
            $fileName = $attachmentimg->getClientOriginalName();

            // Check extension and upload image or doc
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'webp' || $ext == 'pdf' || $ext == 'docx' || $ext == 'doc') {
                $fileName = str_replace(' ', '-', $fileName);
                $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
                $imgName = time() . $fileName.'.'.$ext;
                $destinationPath = public_path('/uploads/gallerys');
                $attachmentimg->move($destinationPath, $imgName);
                $gallery->thumbal = $imgName;
            }
        }
        $gallery->save();
        Session::flash('flash_message','Gallery Add Sucessfully!');
       	return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::find($id);
        return view('gallery.edit', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $gallery = Gallery::find($request->post('id'));
        $gallery->name = request('name');
        // Check if image is present
        if ($request->hasFile('attachment')) {
            $attachmentimg = $request->file('attachment');
            if(!empty($gallery->thumbal)){
                unlink('./uploads/gallerys/'.$gallery->thumbal);
            }
            $ext = $attachmentimg->getClientOriginalExtension();
            $fileName = $attachmentimg->getClientOriginalName();

            // Check extension and upload image or doc
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'webp' || $ext == 'pdf' || $ext == 'docx' || $ext == 'doc') {
                $fileName = str_replace(' ', '-', $fileName);
                $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
                $imgName = time() . $fileName.'.'.$ext;
                $destinationPath = public_path('/uploads/gallerys');
                $attachmentimg->move($destinationPath, $imgName);
                $gallery->thumbal = $imgName;
            }
        }
        $gallery->save();
        Session::flash('flash_message','Gallery Update Sucessfully!');
        return redirect('/gallery/view/'.$request->post('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        // check if any pre lead data exists with this venue id
        $Gallery = Gallery::find($data['data_id']);
        $Gallery->delete();
        return json_encode(array("status" => 1));
    }
}
