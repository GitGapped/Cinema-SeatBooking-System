<!-- column.php -->

<div class="form-check form-check-inline">
    <input type="checkbox" class="form-check-input" id="<?php echo $i.'_'.$j?>" name="<?php echo $i.'_'.$j?>" value="1" <?php if($book1->aseats[$i][$j]==0) echo "disabled='true'";?>>
    <label class="form-check-label" for="<?php echo $i.'_'.$j?>">
        <?php echo 'seat '.$i.'_'.$j;?>
    </label>
</div>



    
