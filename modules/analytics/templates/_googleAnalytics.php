<?php
if($enabled):
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
<?php
  foreach ($actions as $action)
  {
    printf("_gaq.push(%s);" . PHP_EOL, json_encode($action->getRawValue()));
  }
?>

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php endif ?>
