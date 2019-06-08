<?php

$client = SesClient::factory(array(
    'version'=> 'latest',
    'region' => REGION,
+  'credentials' => array(
+    'key' => 'AKIAT243XIECJORN32HO',
+    'secret'  => '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'
+  )
));
