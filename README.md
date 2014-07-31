# wie (Wikipedia Ingress Extractor) #
This script extracts the first paragraph of any given Wikipedia article in any
language. It's meant for terminal use, so one can read the ingress right from
the console/terminal without starting a browser.

## Usage ##
Either make the script executable with 'chmod +x wie.php' and run it as such:

    ./wie.php openbsd
    ./wie.php --lang=sv minicall

Or run it with 'php wie.php'. To display the help, type:

    ./wie.php --help

## Requirements ##
The script requires PHP5 and the PHP5 cURL module (php5-curl on Debian systems).

## Thanks ##
Many thanks goes to flinga who came up with the idea for this script, please see
the THANKS file for more information.

## Copyright ##
Copyright (C) Jack-Benny Persson (jack-benny@cyberinfo.se) and relased under GNU
GPL version 2.
