<?php
   session_start();
   if(!isset($_SESSION['userdata']))
   {
        header("location: ../OLVS/vindex.html");
   }
   $userdata=$_SESSION['userdata'];
   $groupsdata=$_SESSION['groupsdata'];
   if($_SESSION['userdata']['status']==0)
   {
    $status='<b style="color:red"> Not voted</b>';
   }
   else
   {
    $status='<b style ="color:green">Voted..</b>';
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/stylesheet.css">
    <title>Online Voting System</title>
    <style>
        #backbtn
        {
            padding: 10px;
            font-size: 15px;
            border-radius:5px;
            background-color:#5398db;
            color: white;  
            margin:10px;
            float:left;
        }
        #logoutbtn
        {
            padding: 10px;
            font-size: 15px;
            border-radius:5px;
            background-color:#5398db;
            color: white;  
            float:right; 
            margin:10px;
        }
        #Profile
        {
            background-color: white;
            width:30%;
            padding :30px;
            float:left;
        }
        #Group
        {
            background-color: white;
            width:60%;
            padding :30px;
            float:right;
        }
        #votebtn
        {
          padding: 10px;
            font-size: 15px;
            border-radius:5px;
            background-color:#5398db;
            color: white;    
        }
        #mainPanel
        {
            padding:10px;
        }
        #voted
        {
            padding: 10px;
            font-size: 15px;
            border-radius:5px;
            background-color:green;
            color: white;     
        }
    </style>
</head>
<body>
    <div id="mainSection">
        <center>
       <div id="headerSection">
          <a href="../"><button id="backbtn">Back</button></a>
          <a href="logout.php"><button id="logoutbtn">Logout</button></a>
          <h1>Online Voting System</h1>
        </div>
       </center>
        <hr>
        <div id="mainPanel">
        <div id="Profile">
           <center> <img src="../OLVS/uploads/<?php  echo $userdata['photo']  ?>" height="100" width="100"></center><br><br>
            <b>Name: </b><?php echo$userdata["name"] ?><br><br>
            <b>Mobile: </b><?php echo$userdata["mobile"] ?><br><br>
            <b>Address: </b><?php echo$userdata["address"] ?><br><br>
            <b>Status: </b><?php echo $status ?><br><br>
        </div>
        <div id="Group">
            <?php
                if($_SESSION["groupsdata"]){
                    for($i=0;$i<count($groupsdata);$i++)
                    {
                        ?>
                        <div>
                            <img src="../OLVS/uploads/<?php echo $groupsdata[$i]['photo']?>" height="100" width=100 style="float:right">
                            <b>Group Name:</b><?php echo $groupsdata[$i]['name']?><br><br>
                            <b>Votes:</b><?php echo $groupsdata[$i]['votes']?> <br><br>
                            <form action="api/vote.php" method="post">
                                <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                                <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                                <?php
                                if($_SESSION['userdata']['status']==0)
                                {
                                    ?>
                                    <input type="submit" name="votebtn" id="votebtn" value="vote">
                                    <?php
                                }
                                else{
                                    ?>
                                    <input disable type="button" name="votebtn"  value="voted" id="voted">
                                    <?php

                                }
                                ?>
                               

                            </form>
                        </div>
                        <hr>
                    <?php
                    }
                }
            else{

            }
            ?>
        </div>
    </div> 
        </div>   
</body>
</html>