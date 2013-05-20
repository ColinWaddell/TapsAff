<div id="taps-text-area">
  <h2 class="site-message">Glasgow, the weather is:</h2>

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
    <?php if (($status->temp_f >= $GLOBALS['taps_temp'] - 5) && ($status->temp_f =< $GLOBALS['taps_temp'])): ?>
      <p>...but it's close!</p>
      <br />
    <?php endif; ?>
</div> <!-- taps-text-area -->


