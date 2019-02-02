<?php
  $linkName = '/home/u319770187/public_html/recsys/storage';
  $target = '/home/u319770187/public_html/recruitment/storage/app/public';

  symlink($target, $linkName);

  // ln -s /home/u319770187/public_html/recsys-main/storage/app/public /home/u319770187/public_html/recsys/storage
?>