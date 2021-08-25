<?php
  include "config.php";

 $sql6="Select * from shorten_url ";
 $result6=mysqli_query($conn,$sql6);
 while($rows=mysqli_fetch_assoc($result6)){
     if(time()-strtotime($rows['time'])>1555200){
         $id=$rows['id'];
        $sql7="Delete from `shorten_url` where `shorten_url`.`id` ='$id'";
        $result7=mysqli_query($conn,$sql7);
     }
 }
  function getRedirectUrl($slug){
    include "config.php";
    $query="Select * from shorten_url where short_code='".addslashes($slug)."'";
    $result4=mysqli_query($conn,$query);
    if(mysqli_num_rows($result4)>0){
       $rows=mysqli_fetch_assoc($result4);
       $hits=$rows['hits']+1;
       $id=$rows['id'];
       $sql3="UPDATE `shorten_url` SET `hits` = '$hits' WHERE `shorten_url`.`id` = $id";
       $result3=mysqli_query($conn,$sql3);

       $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
       if ($query && $query['status'] == 'success') {
        $location=$query['country'];
        $sql5="INSERT INTO `api data` (`short_url`, `time`, `location`) VALUES ( '$slug', current_timestamp(), '$location')";
        $result5=mysqli_query($conn,$sql5);
       }
     
       return $rows['url'];
    }else{
     echo "Invalid link";
    }
}
  function getShortUrl($url){
      include "config.php";
   $sql="Select * from shorten_url where url='$url'";
   $result=mysqli_query($conn,$sql);
   if(mysqli_num_rows($result)>0){
     $row= mysqli_fetch_assoc($result);
     return $row['short_code'];
   }else{
       $shortCode=generateUniqueId();
       $sql1="INSERT INTO `shorten_url` ( `url`, `short_code`, `hits`, `time`) VALUES ('$url', '$shortCode', '0', current_timestamp())";
       $result1=mysqli_query($conn,$sql1);
       if($result1){
        return $shortCode;
       }
   }
  }
  function getCustomShortUrl($url,$shorturl){
    include "config.php";
 $sql="Select * from shorten_url where url='$url'";
 $result=mysqli_query($conn,$sql);
 if(mysqli_num_rows($result)>0){
   $row= mysqli_fetch_assoc($result);
   return $row['short_code'];
 }else{
     $sql1="INSERT INTO `shorten_url` ( `url`, `short_code`, `hits`, `time`) VALUES ('$url', '$shorturl', '0', current_timestamp())";
     $result1=mysqli_query($conn,$sql1);
     if($result1){
      return $shorturl;
     }
 }
}
  function generateUniqueId(){
      include "config.php";
      $code=substr(md5(uniqid(rand(), true)),0,6);
      $sql2="Select * from shorten_url where short_code='$code'";
      $result2=mysqli_query($conn,$sql2);
      if(mysqli_num_rows($result2)>0){
          generateUniqueId();
      }else{
          return $code;
      }
  }
  if($_SERVER['REQUEST_METHOD']=='POST'){
  $url=urldecode($_POST['long_url']);
  $shorturl=$_POST['short_url'];
  if(filter_var($url,FILTER_VALIDATE_URL)){
      if($shorturl==""){
      $slug=getShortUrl($url);
      echo "Your short url is:".$base_url."?redirect=".$slug;
      }else{
          $slug=getCustomShortUrl($url,$shorturl);
          echo "Your short url is:".$base_url."?redirect=".$slug;
      }   
  }
  }
if(isset($_GET['redirect']) && $_GET['redirect']!=""){
    $slug=urldecode($_GET['redirect']);
    $url1=getRedirectUrl($slug);
 
    header('location:'.$url1);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Url shortener</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <div class="container">
    <form action="" method="post">
     <h2 style="text-align:center">Enter your long url here</h2>
     <div class="input">
     <label for="Url">Enter Url</label>
     <input type="text" name="long_url" class="url" id="">
     </div>
     <h2 style="text-align:center">Enter your short url here</h2>
     <div class="input1">
     <label for="ShortUrl">Enter Short Url</label>
     <input type="text" name="short_url" class="short-url" id="">
     </div>
     <button type="submit" class="button">Submit</button>
    </form>
    </div>
</body>
</html>