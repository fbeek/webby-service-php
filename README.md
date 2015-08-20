# webby-service-php
The PHP Version of the WEBBY Web Radio Service.
With this little Script you can serve your webby your own list of radio stations.

## Requirements
1. Linux Server with Apache 2
2. PHP 5.3 or higher
3. A WEBBY Web Radio with a modified setup.db
    You can find a tutorial at the Mikrocontroller.net Wiki :
      http://www.mikrocontroller.net/articles/Webby#Umstellung_auf_alternativen_Server_via_SD-Karte

## Installation

I did this with an Ubuntu/Debian Maschine, the steps could vary on other Linux Distros.

1. copy the files to ""/var/www/webby_standalone"
2. setup a VHOST for this folder (Look at the Ubuntu Wiki for any help)
3. Add the following snippet to your VHOST Configuration File into the config:

  ```
  <Directory /var/www/html>
    Options +MultiViews
    AddType application/x-httpd-php .php
  </Directory>
  ```

4. Add your radio Stations to the radio_list.csv

Now your Webby should be abble to get your own Radio File.

## Thanks to

The Mikrocontroller Forum User T.E.N for decoding the request URLs and the initial work.
