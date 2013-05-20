<?php if (isset( $status->taps )): ?>

    <h3>An automated service; keeping the Glasgow public informed.</h3>

    <div class="container nine">
        <div class="columns four alpha">
            <a href='<?php echo $GLOBALS['json_url'] ?>' 
               target='_blank'>
                Weather results from Yahoo json feed for Glasgow
            </a>
        </div>

        <div class="columns four">
            <p>Current Temperature: <?php echo $status->temp_c; ?>&deg;C (<?php echo $status->temp_f; ?>&deg;F)</p>
        </div>

        <div class="columns four omega">
            <p>Weather data valid from <?php echo $status->datetime ?> for <?php echo $status->lifespan ?></p>
        </div>
    </div>

    <div class="container nine">
        <div class="columns four alpha">
            <p>by <a href='http://colinwaddell.com/'>colinwaddell.com</a></p>
        </div>

        <div class="columns four">
            <p>Sourcecode available on <a href='https://github.com/ColinWaddell/tapsaff'>GitHub</a></p>
        </div>

        <div class="columns four omega">
            <?php
              if (isset($facebook) && is_array($facebook)):
                foreach ($facebook as $entry): ?>
                    <?php echo "$entry\n"; ?>
                <?php endforeach; 
              endif;
            ?>
        </div>
    </div>

<?php endif; ?>
