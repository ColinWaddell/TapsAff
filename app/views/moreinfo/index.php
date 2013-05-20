<?php if (isset( $status->taps )): ?>

    <h3>An automated service; keeping the Glasgow public informed.</h3>

    <div class="container nine">
        <div class="columns four alpha">
            <span class="info-title">
                Weather results source
            </span>
            <span class="info-value">
                <a href='<?php echo $GLOBALS['json_url'] ?>' 
                   target='_blank'>
                 from Yahoo json feed for Glasgow
                </a>
            </span>        
        </div>

        <div class="columns four">
            <span class="info-title">
                Current Temperature
            </span>
            <span class="info-value">
                <?php echo $status->temp_c; ?>&deg;C (<?php echo $status->temp_f; ?>&deg;F)
            </span>
        </div>

        <div class="columns four omega">
            <span class="info-title">
                Weather data valid from
            </span>
            <span class="info-value">
                <?php echo $status->datetime ?> for <?php echo $status->lifespan ?>
            </span>
        </div>
    </div>

    <hr />

    <div class="container nine">
        <div class="columns four alpha">
            <span class="info-title">
                Site design by
            </span>
            <span class="info-value">
                <a href='http://colinwaddell.com/'>colinwaddell.com</a>
            </span>
        </div>

        <div class="columns four">
            <span class="info-title">
                Sourcecode available from
            </span>
            <span class="info-value">
                <a href='https://github.com/ColinWaddell/tapsaff'>GitHub</a>
            </span>
        </div>

        <div class="columns four omega">
            <span class="info-title">
                Facebook
            </span>
            <span class="info-value">
            <?php
              if (isset($facebook) && is_array($facebook)):
                foreach ($facebook as $entry): ?>
                    <?php echo "$entry\n"; ?>
                <?php endforeach; 
              endif;
            ?>
            </span>
        </div>
    </div>

<?php endif; ?>
