#!/usr/bin/php
<?php
if (!isset($argv[1]))
{
    print "Usage: $argv[0] URL\n";
    exit(1);
}

$url = $argv[1];
$data = shell_exec("curl -s $url");
preg_match("/\<p\>(.*)\<\/p\>/", $data, $match);
$string = strip_tags($match[1]);
print (wordwrap($string, 60, "\n") . "\n");

?>
