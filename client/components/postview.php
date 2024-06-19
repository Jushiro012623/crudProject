<div class="postarea">
    <form class="info" method="POST"  >
        
        <input type="hidden" name="postid" value="<?php echo $row['id']; ?>">
        <span>@<?php echo $row['poster'];?></span>
        <?php 
            if($row['poster'] == $_SESSION['username']){
            echo "<button class=\"delete\" type=\"submit\" name=\"delete\"><i style=\"cursor:pointer\"class=\"fa-solid fa-trash-can\"></i></button>";
        }
        ?>
        
    </form>

    <div class="textarea" name="pose" ><?php echo $row['body'];?></div>

    <p><?php echo $row['posted_at'];?> </p>
</div>
