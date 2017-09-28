<?php

namespace App\Util;
use Mail;

class MailUtil
{
    public static function basic_email($data){

    	$res = 1;

    	try{
    		Mail::send('emails.send', ['title' => $data['title'], 'content' => $data['content']], function ($message) use ($data){
				$message->from('nao-responda@gaco.com', 'Fausto Silva')->subject($data['subject']);
				$message->to($data['email'], $data['email']);
			});
    	}catch(\Exception $e){
    		$res = 0;
    		dd($e);
    	}
		

		return $res;
   	}
}
