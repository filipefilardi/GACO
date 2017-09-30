<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Util\MailUtil;

class MailController extends Controller {

   public function send(){
      // 0: fail
      // 1: success
      $data['email'] = "filipefilardi@gmail.com";
      $data['username'] = "username";
      $data['title'] = "título";
      $data['content'] = "this is the content";
      $data['subject'] = "Seu pedido foi confirmado";
      $res = MailUtil::basic_email($data);

   }

   public static function send_request_accepted($email, $date, $period){
      $data['email'] = $email;
      $data['username'] = $email; // não sei pra que usa ainda
      $data['title'] = "Pedido confirmado"; // não sei pra que usa ainda
      $data['content'] = "this is the content"; // não sei pra que usa ainda
      $data['subject'] = "Seu pedido foi confirmado";
      $data['date'] = $date;
      $data['period'] = $period;
      
      $res = MailUtil::email_request_accepted($data);
   }

      public static function send_request_postpone($email, $date, $period, $justification){
      $data['email'] = $email;
      $data['username'] = $email; // não sei pra que usa ainda
      $data['title'] = "Pedido confirmado"; // não sei pra que usa ainda
      $data['content'] = "this is the content"; // não sei pra que usa ainda
      $data['subject'] = "Seu pedido foi adiado";
      $data['date'] = $date;
      $data['period'] = $period;
      $data['justification'] = $justification;
      
      $res = MailUtil::email_request_postpone($data);
   }
}
