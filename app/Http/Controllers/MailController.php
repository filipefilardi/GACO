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
      $data['subject'] = "Confirmação Genérica";
      $res = MailUtil::basic_email($data);

   }
}
