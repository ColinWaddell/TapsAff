<?php if (isset( $status->taps )): ?>

    <p>An automated service; keeping the Glasgow public informed.</p>

    <div class="container nine">
        <div class="columns three alpha">
            <a href='<?php echo $GLOBALS['json_url'] ?>' 
               target='_blank'>
                Weather results from Yahoo json feed for Glasgow
            </a>
        </div>

        <div class="columns three">
            <p>Current Temperature: <?php echo $status->temp_c; ?>&deg;C (<?php echo $status->temp_f; ?>&deg;F)</p>
        </div>

        <div class="columns three omega">
            <p>Weather data valid from <?php echo $status->datetime ?> for <?php echo $status->lifespan ?></p>
        </div>
    </div>

    <div class="container nine">
        <div class="columns three alpha">
            <p>by <a href='http://colinwaddell.com/'>colinwaddell.com</a></p>
        </div>

        <div class="columns three">
            <p>Sourcecode available on <a href='https://github.com/ColinWaddell/tapsaff'>GitHub</a></p>
        </div>

        <div class="columns three omega">
            Facebook
        </div>
    </div>

<?php endif; ?>
