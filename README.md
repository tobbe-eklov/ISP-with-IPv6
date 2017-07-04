# ISP-with-IPv6
Script and more to create https://ispmedipv6.se/
It's little messy but it works. Working on a LAMP based on Ubuntu 16.04.
Dependecies -
dig, curl, expect, mysql

Test domains - put this in crontab and run every day
test sverige isp ipv6

Import into database ( change username, password and databasename )
importISP.php

Put webb directory in your public_html, change loadData.php with correct username, password and databasename

