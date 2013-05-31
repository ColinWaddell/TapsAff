

<form role="search" id="locationsearch" method="get" action="<?php echo myUrl('',true); ?>" autocomplete="off">
  <input name="location" 
         id="location" 
        placeholder="<?php 
          if (isset($status->place_error) && $status->place_error != '')
            echo $status->place_error;
          else
            echo 'Choose your location...';
        ?>">
</form>
