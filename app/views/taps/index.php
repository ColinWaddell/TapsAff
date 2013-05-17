<div id="taps-text-area">
  <p>Glasgow, the weather is:</p>

  <p class="taps-message">
    <p class="taps-message">taps
    <?php if (isset( $status->taps )): ?>
      <span id="dynamic-taps-message" class="taps-<?php echo $status->taps; ?>">
        <?php echo " ".$status->taps; ?>
      </span>
    <?php else: ?>
      <span id="dynamic-taps-message" class="taps-error">
        error
      </span>
    <?php endif; ?>
    </p>
    <?php if (($status->temp_f > $GLOBALS['taps_temp'] - 5) && ($status->temp_f < $GLOBALS['taps_temp'])): ?>
      <p>...but it's getting close!</p>
      <br />
    <?php endif; ?>
  </p>
</div> <!-- taps-text-area -->

<?php if (isset( $status->taps )): ?>
<div id="more-info">
  <a href="#" id="more-info-link">more info</a>

  <div class="more-info-expand">
    <p>An automated service; keeping the Glasgow public informed.</p>
    <br />
    <a href='<?php echo $GLOBALS['json_url'] ?>' target='_blank'>Weather results from Yahoo json feed for Glasgow</a>
    <br />
    <br />
    <p>Current Temperature: <?php echo $status->temp_c; ?>&deg;C (<?php echo $status->temp_f; ?>&deg;F)</p>
    <br />
    <br />
    <p>Weather data valid from <?php echo $status->datetime ?> for <?php echo $status->lifespan ?></p>
    <br />
    <br />
    <p>by <a href='http://colinwaddell.com/'>colinwaddell.com</a></p>
    <br />
    <br />
    <p>Sourcecode available on <a href='https://github.com/ColinWaddell/tapsaff'>GitHub</a></p>
  </div>
</div>

<?php endif; ?>
