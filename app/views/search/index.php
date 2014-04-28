
<h4>Where are ye...?</h4>
<form role="search" id="locationsearch" method="get" action="<?php echo myUrl('',true); ?>" autocomplete="off">
  <input name="location" 
         id="location" 
        <?php 
          if (isset($status->place_error) && $status->place_error != ''){
            echo 'placeholder="'.$status->place_error.'" ';
            echo 'class="notfound"';
          }else{
            echo 'placeholder="Check anywhere in the UK!"';
          };
        ?>
  >
</form>
