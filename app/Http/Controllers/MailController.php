<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Util\MailUtil;

class MailController extends Controller {

   // public function send(){
   //    // 0: fail
   //    // 1: success
   //    $data['email'] = "victoredoardo@gmail.com";
   //    $data['username'] = "username";
   //    $data['title'] = "título";
   //    $data['content'] = "this is the content";
   //    $data['subject'] = "Seu pedido foi confirmado";
   //    $res = MailUtil::basic_email($data);

   // }

   public static function send_request_accepted($email, $date, $period, $id_req_master){
      $data['email'] = $email;
      $data['username'] = $email;
      $data['subject'] = "Seu pedido foi confirmado";
      $data['date'] = $date;
      $data['period'] = $period;
      $data['id_req_master'] = $id_req_master;
      
      $res = MailUtil::email_request_accepted($data);
   }

   public static function send_request_postpone($email, $date, $period, $justification, $id_req_master){
      $data['email'] = $email;
      $data['username'] = $email;
      $data['subject'] = "Seu pedido foi adiado";
      $data['date'] = $date;
      $data['period'] = $period;
      $data['id_req_master'] = $id_req_master;
      $data['justification'] = $justification;
      
      $res = MailUtil::email_request_postpone($data);
   }

   public function btn_confirm_request(Request $data){
      dd($data->all(), 'Mensage no MailController, tem que fazer a função de alterar a flag no bd agora e chamar nessa função dentro do MailController');

      return view('mailconfirm'); 
   }
}
