#!/usr/bin/php
<?php
/*
    Copyright (C) 2014 Jack-Benny Persson <jack-benny@cyberinfo.se>

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/    

$defaultLang = "en"; // default language
$progName = $argv[0];



// check if no argument was specified
if (!isset($argv[1]))
{
    usage();
    exit(1);
}

// display help
if (preg_match("/--help/", $argv[1]))
{
    usage();
    exit(0);
}

// see if we entered a language or just an article
if (preg_match("/--lang=[a-z]{2}/", $argv[1]))
{
    preg_match("/--lang=([a-z]{2})/", $argv[1], $lang);
    $lang = $lang[1];
    $article = $argv[2];
}
else
{
    $lang = $defaultLang;
    $article = $argv[1];
}

// check if article is UTF-8 encoded, in which case regular ucwords won't work
if (mb_check_encoding($article, 'UTF-8'))
{
    $article = utf8_ucwords($article);
}
else
{
    $article = ucwords($article); // uppercase article
}

$article = preg_replace("/\s/", "_" ,$article); // make spaces to underscore
$url = "http://$lang.wikipedia.org/wiki/$article"; 

// get the wiki page
$ch = curl_init("$url");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);

preg_match("/\<p\>(.*)\<\/p\>/", $data, $match); // fetch text inside first <p>

// check is we had a match
if (!isset($match[1]))
{
    print "No Wikipedia article found at that URL\n";
    exit(1);
}

$string = strip_tags($match[1]); 
print (wordwrap($string, 65, "\n") . "\n"); 

// misc functions
function usage()
{
    print "Wikipedia ingress extractor (wie), version 0.2\n";
    print "Usage: $GLOBALS[progName] [--lang=sv] article\n";
    print "Default language if none specified is $GLOBALS[defaultLang].\n";
    print "Remember to quote the article if there's more than one word,\n";
    print "for example Roger Bacon as 'Roger Bacon'.\n";
}

function utf8_ucwords($str)
{
    $str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    return $str;    
}

?>
