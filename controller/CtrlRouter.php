<?php
class CtrlRouter{
    private static $page;
    public function __construct(){

    }

    public function getPage(){
    $isParam =  preg_match("/([?])/", self::$page, $matches);
      if(!$matches[0]){
        return require_once(self::$page);
      }else{
       header("Location:".self::$page."");
      }

    }
    public function setPage($page,$param=null){
      if($param){
          self::$page =$page.".php?".$param;
         return self::$page ;
      }else{
          self::$page =$page.".php";
              return self::$page ;
      }
      }

}
?>
