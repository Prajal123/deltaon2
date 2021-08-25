<?php
include 'config.php';
$sql="Select * from shorten_url";
$result=mysqli_query($conn,$sql);
while($rows=mysqli_fetch_assoc($result)){
    $shortid=$rows['id'];
    $no=1;
    $longurl=$rows['url'];
    $shorturl=$rows['short_code'];
    $hits=$rows['hits'];
    echo '<h4> The short url of '.$longurl.' is <span style="color:red">localhost/deltaon/?redirect='.$shorturl.'</span> and the no of clicks is <span style="color:red">'.$hits.'</span><br>';
    $sql1="Select * from `api data` where short_url='$shorturl' order by  `api data`.`time` DESC";
    $result1=mysqli_query($conn,$sql1);
    if(mysqli_num_rows($result1)>0){
    $row=mysqli_fetch_assoc($result1);
    if(time()-strtotime($row['time'])>172800){
        $id=$row['short_url'];
        $sql2="Delete from `shorten_table` where `shorten_table`.`short_code`='$id'";
        $result2=mysqli_query($conn,$sql2);
        return ;
    }
    echo '<h3>'.$no.'. This url has been clicked at '.$row['location']. ' at the time '.$row['time'].'</h3>';
    $no++;
}
    while($row=mysqli_fetch_assoc($result1)){
      echo '<h3>'.$no.'. This url has been clicked at '.$row['location']. ' at the time '.$row['time'].'</h3>';
      $no++;
    }
    echo '<hr>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api track</title>
</head>
<body>
    
</body>
</html>
