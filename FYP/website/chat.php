<!DOCTYPE html>
<html lang="en" >
    
<?php
include 'functionset.php';
    
$conn =connection();
    

$u_id =getsession("u_id");

if(isset($_GET["submit"])) {
    $f_id=$_GET["f_id"];
    
    $to_id=$_GET["to_id".$f_id];
    $from_id=$_GET["from_id".$f_id];
    $content=$_GET["content".$f_id];
    
    $sql ='INSERT INTO `chat`(`CH_from`, `CH_to`, `CH_content`,  `status`) VALUES ('.$from_id.','.$to_id.',"'.$content.'",0)';

    $result = mysqli_query($conn,$sql);
}       
    
$sql ="select `CH_from`,`CH_to`,`CH_content`,max(`CH_createtime`) AS CH_createtime,`status` from chat WHERE CH_from=".$u_id." group by `CH_to`";

$result = mysqli_query($conn,$sql);




?>
    
<head>
  <meta charset="UTF-8">
  <title>CodePen - Direct Messaging</title>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./style.css">
<style>
.chat{

}   
</style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper">
    <div class="container">
        <div class="left">
            <div class="top">
                <input type="text" placeholder="Search" />
                <a href="javascript:;" class="search"></a>
            </div>
            <ul class="people">
                <?php
                  if (mysqli_num_rows($result) > 0) {
                          // output data of each row
                         $a =1;
                          while($row = mysqli_fetch_assoc($result)) {
                           $CH_to =$row["CH_to"];
                           $CH_content =$row["CH_content"];
                           $CH_createtime =$row["CH_createtime"];  
                           $CH_createtime = strtotime($CH_createtime);
                           $CH_createtime =date('H:i:s',$CH_createtime);
                                                 
                               $user_sql ="SELECT * FROM user WHERE U_id=".$CH_to;
                               
                               $user_result = mysqli_query($conn,$user_sql);
                               $user_row = mysqli_fetch_assoc($user_result);
                               $user_name =$user_row["U_name"];
                               
                            echo '
                    <li class="person" data-chat="person'.$a.'">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/drake.jpg" alt="" />
                    <span class="name">'.$user_name.'</span>
                    <span class="time">'. $CH_createtime.'</span>
                    <span class="preview">'.$CH_content.'</span>
                        </li>
                            ';
                            $a +=1;  
                          }
                        } else {
                          echo '

                          ';
                        }
                            ?>
               
                
            </ul>
        </div>
        <div class="right" >
            <div class="top"><span>To: <span class="name">Doasdfsdfg Woofson</span></span></div>
            <?php 
            $sql ="select `CH_from`,`CH_to`,`CH_content`,max(`CH_createtime`) AS CH_createtime,`status` from chat WHERE CH_from=".$u_id." group by `CH_to`";
            $result = mysqli_query($conn,$sql);
            
            if (mysqli_num_rows($result) > 0) {
              // output data of each row
                
            
                
             $a =1; 
             
              while($row = mysqli_fetch_assoc($result)) {
               $CH_to =$row["CH_to"];
               $CH_content =$row["CH_content"];
               $CH_createtime =$row["CH_createtime"];  
               $CH_createtime = strtotime($CH_createtime);
               $CH_createtime =date('H:i:s',$CH_createtime);
                echo '<div class="chat" id="chat123" data-chat="person'.$a.'">';
                  
                   $user_sql ='SELECT * FROM chat WHERE (CH_from='.$u_id.' AND CH_to='.$CH_to.') OR (CH_from='.$CH_to.' AND CH_to='.$u_id.')';
                   $user_result = mysqli_query($conn,$user_sql);
                     while($user_row = mysqli_fetch_assoc($user_result)) {
                        
                         if ($user_row["CH_from"] ==$u_id){
                             echo '
                              <div class="bubble me">
                            '.$user_row["CH_content"].'
                        </div>
                             ';
                         }else{
                           echo '
                              <div class="bubble you">
                            '.$user_row["CH_content"].'
                            
                        </div>
                            
            
                             ';
                           echo '

                <div class="write" >      
               <form action="chat.php" method="get" name="foo'.$a.'" >
                <input type="text" name="f_id" value='.$a.' style="display:none;">
                <input type="text" name="content'.$a.'" id=test123>
                <input type="text" value='.$u_id.' name="from_id'.$a.'" style="display:none;">
                <input type="text" value='.$CH_to.' name="to_id'.$a.'" style="display:none;">
                <input type="submit" name="submit"  multiple="" id="button123" >
            </form>
            </div>';    
                               ;
                         }
                     
                                     ;
                         
                     }
              
                echo '</div>'; 
                  
                    
             echo ''
           ;
             $a +=1;  
                      }
                    } else {
                      echo '

                      ';
                    }
                        
            ?>
           

            
          


        </div>
    </div>
</div>
<!-- partial -->
  <script  src="./script.js">

    </script>
    <script>
            var element = document.getElementById("chat123")
      element.scrollTop = element.scrollHeight;
        console.log("test")
    </script>

</body>
</html>
