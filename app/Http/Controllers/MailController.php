<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Util\MailUtil;
use App\Util\Dao\RequestMasterDao;

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
         $id_user = Auth::user()->id_user;
         $id_cat = Auth::user()->id_cat;
         // choice sempre vai ser Y dado que o usuario confirmou via email que quer
         $id_choice = 'Y';
         $conf_token = RequestMasterDao::get_token_by_request($data->id_req_master)->toArray()[0]->conf_token;
         //dd(Auth::user(), 'Mensagem no MailController, tem que fazer a função de alterar a flag no bd agora e chamar nessa função dentro do MailController');

         #TODO: Passar para a funcao e testar -- provavelmente funciona -- Alem disso precisa mostrar na view um NAO CONFIRMADO PELO USUARIO para a cooperativa quando fl_user_confirm for N
         $res = RequestMasterDao::user_reply_assignment($data->id_req_master,$conf_token,$id_user,$id_cat,$id_choice);
         if(in_array("user does not have permission to confirm assignment",$res)){
            dd("MailController: not ok\n retornar view mostrando que deu errado");
         }else{
            dd("MailController: ok\n retornar view mostrando que deu certo");
         }
      return view('mailconfirm'); 
   }
}
