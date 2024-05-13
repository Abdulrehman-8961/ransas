<?php
$zip = new ZipArchive;
$res = $zip->open('public.zip');
if ($res === TRUE) {
  $zip->extractTo('public/');
  $zip->close();
  echo 'woot!';
} else {
  echo 'doh!';
}
