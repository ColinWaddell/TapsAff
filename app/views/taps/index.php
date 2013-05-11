<div id="taps-text-area">
  <p>Glasgow, the weather is:</p>

  <p class="taps-message">
    <p class="taps-message">taps
      <span id="dynamic-taps-message" class="taps-<?php echo $status->taps; ?>">
        <?php echo " ".$status->taps; ?>
      </span>
    </p>
  </p>
</div> <!-- taps-text-area -->
 
<div id="more-info">
  <a href="#" id="more-info-link">more info</a>

  <div class="more-info-expand">
    <p>An automated service; keeping the Glasgow public informed.</p>
    <br />
    <a href='<?php echo $GLOBALS['json_url'] ?>' target='_blank'>Weather results from Yahoo json feed for Glasgow</a>
    <br />
    <br />
    <p>Current Temperature: <?php echo $status->temp_c; ?>&deg;C (<?php $status->temp_f; ?>&deg;F)</p>
    <br />
    <br />
    <p>by <a href='http://colinwaddell.com/'>colinwaddell.com</a></p>
    <br />
    <br />
    <p>Sourcecode available on <a href='https://github.com/ColinWaddell/tapsaff'>GitHub</a></p>
  </div>
</div>
