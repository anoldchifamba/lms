<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Http\Request;
use DB;
use Mail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class  Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function contact(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'email'=> 'required|email',
            'subject'=>'required',
            'message'=>'required'
        ]);

     Mail::send('emails.contact-message',[
    'msg'=>$req->message
     ],function ($mail) use ($req){
         $mail->from($req->email,$req->name);
         $mail->to('anoldchifamba@gmail.com')->subject('At Academy Contact Message');

     });

     return redirect()->back()->with('flash_message','Thank you for your message.');

     /*   $name=$req->input('name');
        $email=$req->input('email');
        $subject=$req->input('subject');
        $message=$req->input('message');
        $now = new DateTime();
        $data=array('name'=>$name,'email'=>$email,'subject'=>$subject,'message'=>$message,'datey'=>$now);
       if(
            DB::table('contact-us')->insert($data)){
             echo 'success';
            return view('contact');
        }*/

    }
}
