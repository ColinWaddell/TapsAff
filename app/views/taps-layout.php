<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<base href="<?php echo myUrl('',true)?>" />
<title><?php echo $GLOBALS['sitename']?></title>

<meta property="og:url" content="http://colinwaddell.com/tapsaff/"/> 
<meta property="og:title" content="Glasgow, taps-aff or taps-oan?"/> 
<meta property="og:image" content="http://colinwaddell.com/tapsaff/logo.png"/>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="public/js/taps.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:800" rel="stylesheet" type="text/css">
<link rel="stylesheet" id="taps-style"  href="public/css/taps.css" type="text/css" media="all" />
<link rel="stylesheet" id="skeleton-framework"  href="public/css/skeleton.css" type="text/css" media="all" />

<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(["_setAccount", "UA-13023652-2"]);
_gaq.push(["_trackPageview"]);

(function() {
  var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
  ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
  var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
})();

</script>

</head>
<body>

  <div class="container">
    <div class="columns offset-by-two twelve">
        <?php
          if (isset($body) && is_array($body)):
            foreach ($body as $entry): ?>
              <section>
                <?php echo "$entry\n"; ?>
              </section>
            <?php endforeach; 
          endif;
        ?>
    </div>
  </div> <!-- container -->

</body>
</html>


