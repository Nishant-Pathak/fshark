<?php
namespace fshark;
include_once("include/nitro_response.php");


$request_uri = $_SERVER["REQUEST_URI"];

$segments = preg_split("/[?]+/", $request_uri, -1, PREG_SPLIT_NO_EMPTY);

session_start();

$obj = new nitro();

call_user_func_array(array($obj,"processReq"), $segments);

class nitro{

   private $response = null;

   public function __construct(){
      $this->response = new nitro_response();
   }

   public function processReq(){
      $arg_list = func_get_args();
      $args = preg_split("/[=]+/", $arg_list[1], -1, PREG_SPLIT_NO_EMPTY);
      $this->processCapReq($args[1]);
      $this->send_response();
   }

   private function processCapReq($tmp_file_name){
      $capResopnse = array();
      $file_name = $_SESSION["caps"][$tmp_file_name];
      $output;
      $error;
      if(!file_exists("caps/".$file_name.".txt")){
         exec("tshark -r "."caps/".$file_name." > caps/".$file_name.".txt", $output , $error);
      }
      if($error != 0){
         $this->response->set_errorcode(-1);
         $this->response->set_message("Unable to open cap file !!!");
         return false;
      }

      $lines = file("caps/".$file_name.".txt");
      $colors = array("#ff7f2a", "#ffd332", "#1bae44", "#008fc7",
                      "#09c0e3", "#CC5480", "#ef3124", "#ffbe00",
                      "#db4c3c", "#c5881c", "#6a93c7", "#386398",
                      "#669999", "#993333", "#006600", "#990099",
                      "#ff9966", "#99ff99", "#9999ff", "#cc6600",
                      "#33cc33", "#cc99ff", "#ff6666", "#99cc66",
                      "#009999", "#cc3333", "#9933ff", "#ff0000",
                      "#0000ff", "#00ff00", "#ffcc99", "#999999",
                      "#ff3333", "#6666ff", "#ffff00", "#000000");

      $protoArr = array();

      if(count($lines) != 0){
         foreach ($lines as $line_num => $line) {
            $returnValue = preg_split('/( | -> |->)/', $line, 7, PREG_SPLIT_NO_EMPTY);
            $pktnum = $returnValue[0];
            $time = $returnValue[1];
            $src = $returnValue[2];
            $dst = $returnValue[3];
            $proto = $returnValue[4];
            $length = $returnValue[5];
            $info = $returnValue[6];
            if(!in_array($proto, $protoArr))
               array_push($protoArr,$proto);
            $color = $colors[array_search($proto, $protoArr)];
            $capResopnse[$line_num] = array("number" => $pktnum, "time"   => $time,
                                        "src"    => $src       , "dst"    => $dst,
                                        "proto"  => $proto     , "length" => $length,
                                        "info"   => $info      , "color"  => $color
                                   );
         }
         $this->response->add_response("cap",$capResopnse);
      }
      else {
         // nothing to display
      }
   }

   private function send_response(){
      header("Content-type: application/json; charset=utf-8");
      //   if($_SERVER["REQUEST_METHOD"] === "GET")
      //     ob_start("ob_gzhandler");
      print $this->response->to_string();
   }
}
?>
