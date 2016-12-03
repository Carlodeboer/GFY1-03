<?php
    $result = "ba023cff792441edc7da38ff2ffe284800420238baad435e6bd91b21c4aba755a4469e282b5ba39409f7496efecedbce5a0a47451b60d27d9a722864ad6063a0";
    $algo = "whirlpool";

    foreach (range(0, 9999) as $number){
        if (strlen($number) < 4){
            $number = str_pad($number, 4, "0", STR_PAD_LEFT);
        }
        $data = str_pad($number, 5, "a", STR_PAD_LEFT);
        $result2 = hash($algo, $data);
        if ($result == $result2){
            print $data."<br>".$result."<br>".$result2;
            exit();
        }
    }
?>
