<div class="postarea">
    <form class="info" method="POST"  >
        
        <input type="hidden" name="postid" value="<?php echo $row['id']; ?>">
        <span>@<?php if($row['poster'] == $_SESSION['username']){echo 'you';}else{ echo $row['poster'];}?> posted</span>
        <div>
            <?php 
                if($row['poster'] == $_SESSION['username']){
                    echo "<button style=\"margin-right:1em;\" class=\"delete\" type=\"submit\" name=\"delete\"><i style=\"cursor:pointer\" class=\"fa-solid fa-trash-can\"></i></button>";
                    echo "<button class=\"delete\" type=\"submit\" name=\"edit\"><i style=\"cursor:pointer\" class=\"fa-solid fa-pen-to-square\"></i></button>";
            }
            ?>
        </div>
    </form>

    <div class="textarea" name="pose" ><?php echo $row['body'];?></div>

    <p><?php echo $row['posted_at'];?> </p>
</div>
