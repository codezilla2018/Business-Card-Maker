<?php
/**
 * Created by PhpStorm.
 * User: chamodshehanka
 * Date: 5/22/2018
 * Time: 4:34 PM
 */

class CardController{

    public $connection;
    public function __construct(){
        $this -> connection = mysqli_connect("localhost", "root", "wampwamp", "codezilla");
        if(!$this -> connection){
            echo 'Database Connection Error ' . mysqli_connect_error($this -> connection);
        }
    }

    public function show_info($name,$email,$web){

        $text = "$name $email $web";
        $arrText=explode("\n",wordwrap($text,20,"\n"));

        $im = @imagecreate(300, 150); //creates an image
        $background_color = imagecolorallocate($im, 255,255,255); //sets image background color
        $y = 15; //vertical position of text
        foreach($arrText as $arr){
            $textclr=imagecolorallocate($im,0,0,0); //sets text color
            imagestring($im,5,15,$y,trim($arr),$textclr); //create the text string for image,added trim() to remove unwanted chars
            $y=$y+40;

        }
        header("Content-type: image/png");
        imagepng($im);
        imagedestroy($im);
        $imginsert = "INSERT INTO details (name,email,web) VALUES ('$name','$email','$web')";
        $imgquery=mysqli_query($this -> connection, $imginsert);
        return $imgquery;
    }

}