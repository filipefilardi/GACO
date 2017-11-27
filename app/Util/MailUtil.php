<?php

namespace App\Util;
use Mail;

class MailUtil
{
    public static function basic_email($data){

    	$res = 1;

    	try{
    		Mail::send('emails.send', ['title' => $data['title'], 'content' => $data['content']], function ($message) use ($data){
				$message->from('gaco@gmail.com', 'GACO')->subject($data['subject']);
				$message->to($data['email'], $data['email']);
			});
    	}catch(\Exception $e){
    		$res = 0;
    		dd($e);
    	}
		

		return $res;
   	}

    public static function email_request_accepted($data){

        $res = 1;

        try{
            Mail::send('emails.acpt_request', ['date' => $data['date'], 'period' => $data['period'], 'id_req_master' => $data['id_req_master']], function ($message) use ($data){
                $message->from('gaco@gmail.com', 'GACO')->subject($data['subject']);
                $message->to($data['email'], $data['email']);
            });
        }catch(\Exception $e){
            $res = 0;
            dd($e);
        }
        
        return $res;
    }

    public static function email_request_postpone($data){

        $res = 1;

        try{
            Mail::send('emails.postpone_request', ['date' => $data['date'], 'period' => $data['period'], 'justification' => $data['justification'], 'id_req_master' => $data['id_req_master']], function ($message) use ($data){
                $message->from('gaco@gmail.com', 'GACO')->subject($data['subject']);
                $message->to($data['email'], $data['email']);
            });
        }catch(\Exception $e){
            $res = 0;
            dd($e);
        }
        
        return $res;
    }


}
