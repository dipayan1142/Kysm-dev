<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Gallery;
use App\Helpers\Mailer;

class ApiController extends Controller
{
    public function getBanners()
    {
        $banners = Banner::orderBy('id', 'desc')->get();
        return $banners;
    }
    public function getGallerays()
    {
        $gallerys = Gallery::orderBy('id', 'desc')->get();
        return $gallerys;
    }
    public function createContact(Request $request){
        if(!empty($request->all())){
             // Send mail
             echo "<pre>";
             print_r($request->all());
             exit;
            $emailSubject = "Contact details for MotivUS";
            $emailText = "<html>
                <body>
                <h4>Name:- " . $request->firstName . " ".$request->lastName."</h4>
                <h4>Email:- " . $request->email . "</h4>
                <h4>Phone:- " . $request->phoneNumber . "</h4>
                <h4>Message:- " . $request->message . "</h4>
                <p>Thank You. Regards.</p>
                <p>".$request->firstName." ".$request->lastName."</p>
                </body>
                </html>";
            $data= Mailer::sendMail($request->email, $emailSubject, $emailText);
            return $data;
            return ['success'=>'data save success','status'=>'200'];
        }else{
            return ['error'=>'Something went to wrong!','status'=>'405'];
        }
       
    }
}
