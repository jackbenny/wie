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
$strArray = explode("\n", wordwrap($string, 60));

foreach($strArray as $line)
{
    print $line . "\n";
}

//print strip_tags($match[1]) . "\n";
?>
