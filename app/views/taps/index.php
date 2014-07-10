
<div id="taps-text-area">
  <h2 class="site-message"><span style='color: #D6163D; font-size: 34px;'><?php echo $status->location; ?></span>, the weather is:</h2>

    <p class="taps-message">taps
    <?php if (isset( $status->taps )): ?>
      <span id="dynamic-taps-message" class="taps-<?php echo $status->taps; ?>">
        <?php echo " ".$status->taps; ?>
      </span>


    <?php if (isset($status->message) && $status->message !=''): ?>
      <h3 class="sub-message"><?php echo $status->message; ?></h3>
    <?php endif; ?>

    <?php else: ?>
      <span id="dynamic-taps-message" class="taps-error">
        error
      </span>
    <?php endif; ?>
    </p>

    <div id="share">
      <p>Share:
        <a target="_blank" class="social-media google" href="https://plusone.google.com/_/+1/confirm?hl=en&url=<?php echo urlencode(myUrl(urlencode($status->location),true)); ?>">Google</a>
        <a target="_blank" class="social-media facebook" href="http://www.facebook.com/share.php?u=<?php echo urlencode(myUrl(urlencode($status->location),true)); ?>">Facebook</a>
        <a target="_blank" class="social-media twitter" href="http://twitter.com/home/?status=<?php echo urlencode(myUrl(urlencode($status->location),true)); ?>">Twitter</a>
      </p>
    </div>

    <div class="offset-by-one ten columns alpha omega">
      <p class="taps-definition">
        <span class="b">Taps-Aff (Scots Vernacular) </span>Literally "tops off."
        The removing of one's shirt in the event of warm weather, a phenomenon rarely seen in Glasgow.
        Now an expression describing good times being had.<a href="http://www.urbandictionary.com/define.php?term=taps+aff" target="_blank" class="superscript">1</a>
        <br /><br />
        <span class="b">Antonym:</span> Taps-Oan, "tops on".
        <br /><br />
        <span class="b">Current Temperature:</span> <?php echo $status->temp_c; ?>&deg;C (<?php echo $status->temp_f; ?>&deg;F)
      </p>
    </div>

  </div> <!-- taps-text-area -->


