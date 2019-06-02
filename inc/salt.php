<?php
    function urlify($url){
            $str="";
            for($i=0;$i<strlen($url);$i++){
                if($url[$i]==" ")
                {
                    $str.="%20";
                    continue;
                }
                $str.=$url[$i];
            }
            return $str;
    }

    function generator(){
        $securitykey="";

        $array1=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        $array2=array();                                                     //CAPITAL LETTERS

        for($i=0;$i<sizeof($array1);$i++){
            $array2[$i]=strtoupper($array1[$i]);  //CONVERSION OF array1 elements to uppercase and assignment to array2!
        }

        $finalarray=array_merge($array1,$array2);

        for($i=0;$i<8;$i++){
            $random=rand(0,sizeof($finalarray));

            $securitykey.=$finalarray[$random];
        }

        return $securitykey;        // Returns an 8 Character long Security Key.
    }

    function saltgen(){       // Function to generate salt for crypting.
        $salt="";

        $array1=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        $array2=array();                                                     //CAPITAL LETTERS

        for($i=0;$i<sizeof($array1);$i++){
            $array2[$i]=strtoupper($array1[$i]);  //CONVERSION OF array1 elements to uppercase and assignment to array2!
        }

        $finalarray=array_merge($array1,$array2);

        $array3=array('$','/','.','&','#','@');  // SPECIAL CHARACTERS ARRAY.

        $finalarray=array_merge($finalarray,$array3);

        for($i=0;$i<25;$i++){
            $rand=rand(0,sizeof($finalarray));

            $salt.=$finalarray[$rand];
        } 

        return $salt;       
    }

    function escapestr($unescaped) {
      $replacements = array(
         "\x00"=>'\x00',
         "\n"=>'\n',
         "\r"=>'\r',
         "\\"=>'\\\\',
         "'"=>"\'",
         '"'=>'\"',
         "\x1a"=>'\x1a',
         "<"=>'&lt;',
         ">"=>'&gt;'
      );
      return strtr($unescaped,$replacements);
    }
?>
