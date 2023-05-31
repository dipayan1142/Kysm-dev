<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::orderBy('id', 'desc')->get();
        return view('dashboard', compact('banners'));
    }
    public function banneradd(Request $request){
        return view('banner.add');
    }
    public function bannercreate(Request $request)
    {
        $banner = new Banner();
        $banner->name = request('name');
        $banner->desc =  request('desc');
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
                $destinationPath = public_path('/uploads/banners');
                $attachmentimg->move($destinationPath, $imgName);
                $banner->thumbal = $imgName;
            }
        }
        $banner->save();
        Session::flash('flash_message','Banner Add Sucessfully!');
       	return redirect()->back();
    }
    public function bannerdelete(Request $request){
        $data = $request->all();
        // check if any pre lead data exists with this venue id
        $banner = Banner::find($data['data_id']);
        $banner->delete();
        return json_encode(array("status" => 1));
    }
    public function bannershow(Request $request, $id){
        $banner = Banner::find($id);
        return view('banner.edit', compact('banner'));
    }
    public function banneredit(Request $request){
        $banner = Banner::find($request->post('id'));
        $banner->name = request('name');
        $banner->desc =  request('desc');
        // Check if image is present
        if ($request->hasFile('attachment')) {
            $attachmentimg = $request->file('attachment');
            if(!empty($banner->thumbal)){
                unlink('./uploads/banners/'.$banner->thumbal);
            }
            $ext = $attachmentimg->getClientOriginalExtension();
            $fileName = $attachmentimg->getClientOriginalName();

            // Check extension and upload image or doc
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'webp' || $ext == 'pdf' || $ext == 'docx' || $ext == 'doc') {
                $fileName = str_replace(' ', '-', $fileName);
                $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
                $imgName = time() . $fileName.'.'.$ext;
                $destinationPath = public_path('/uploads/banners');
                $attachmentimg->move($destinationPath, $imgName);
                $banner->thumbal = $imgName;
            }
        }
        $banner->save();
        Session::flash('flash_message','Banner Update Sucessfully!');
        return redirect('/banner/view/'.$request->post('id'));
    }
}
