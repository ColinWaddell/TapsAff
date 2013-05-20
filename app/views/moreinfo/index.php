<?php if (isset( $status->taps )): ?>

    <h3 class="site-purpose">An automated service; keeping the Glasgow public informed.</h3>

    <div class="container nine">

        <div class="columns four alpha">
            <span class="info-title">
                Current Temperature
            </span>
            <span class="info-value">
                <?php echo $status->temp_c; ?>&deg;C (<?php echo $status->temp_f; ?>&deg;F)
            </span>
        </div>


        <div class="columns four">
            <span class="info-title">
                Last Updated
            </span>
            <span class="info-value">
                <?php echo $status->datetime ?> <br /> Valid for <?php echo $status->lifespan ?>
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

    <div class="container nine">
        <div class="columns four alpha">
            <span class="info-title">
                Site Author
            </span>
            <span class="info-value">
                <a href='http://colinwaddell.com/'>ColinWaddell.com</a>
            </span>
        </div>

        <div class="columns four">
            <span class="info-title">
                Sourcecode
            </span>
            <span class="info-value">
                <a href='https://github.com/ColinWaddell/tapsaff'>GitHub</a>
            </span>
        </div>

        <div class="columns four omega">
            <span class="info-title">
                Weather Feed
            </span>
            <span class="info-value">
                <a href='<?php echo $GLOBALS['json_url'] ?>' 
                   target='_blank'>
                 YahooAPI Feed
                </a>
            </span>        
        </div>
        
    </div>

<?php endif; ?>
