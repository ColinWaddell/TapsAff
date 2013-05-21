<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<base href="<?php echo myUrl('',true)?>" />
<title><?php echo $GLOBALS['sitename']?></title>

<meta property="og:url" content="<?php echo myUrl('',true)?>"/> 
<meta property="og:title" content="Glasgow, taps-aff or taps-oan?"/> 
<meta property="og:image" content="<?php echo myUrl('',true)?>/public/img/logo.png"/>
<meta property="fb:admins" content="732492372" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600,800' rel='stylesheet' type='text/css' />
<link rel="stylesheet" id="taps-style"  href="<?php echo myUrl('public/css/taps.css',true)?>" type="text/css" media="all" />
<link rel="stylesheet" id="skeleton-framework"  href="<?php echo myUrl('public/css/skeleton.css',true)?>" type="text/css" media="all" />

<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(["_setAccount", "UA-41104029-1"]);
_gaq.push(["_trackPageview"]);

(function() {
  var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
  ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
  var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
})();

</script>

</head>
<body>

  <div id="main">
    <div class="container">
      <div class="columns offset-by-two twelve alpha">
          <?php
            if (isset($body) && is_array($body)):
              foreach ($body as $entry): ?>
                <section>
                  <?php echo "$entry\n"; ?>
                </section>
              <?php endforeach; 
            endif
          ?>
      </div> 
    </div> <!-- container -->
  </div> <!-- maincontent -->

  <div id="social-media">
    <div class="container">
      <div class="columns offset-by-two twelve alpha">
          <?php
            if (isset($socialmedia) && is_array($socialmedia)):
              foreach ($socialmedia as $entry): ?>
                <section>
                  <?php // echo "$entry\n"; ?>
                </section>
              <?php endforeach; 
            endif
          ?>
      </div> 
    </div> <!-- container -->
  </div> <!-- socialmedia -->
    
  <div id="moreinfo">
    <div class="container">
      <div class="columns offset-by-two twelve alpha">
        <?php
          if (isset($moreinfo) && is_array($moreinfo)):
            foreach ($moreinfo as $entry): ?>
              <section>
                <?php echo "$entry\n"; ?>
              </section>
            <?php endforeach; 
          endif;
        ?>
      </div>
    </div> <!-- container -->
  </div> <!-- moreinfo -->

</body>
</html>


