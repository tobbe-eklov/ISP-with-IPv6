# ISP-with-IPv6
Script and more to create https://ispmedipv6.se/

It's little messy but it works. Working on a LAMP based on Ubuntu 16.04.

Dependecies -

dig, curl, expect, mysql and probably more.....

Using default /usr/local/var as base directory

Usage - put this in crontab and run it once a day

test sverige isp ipv6

This case needs directory /usr/local/var/sverige/isp

Import result into database ( change username, password and databasename )

importISP.php - also in crontab

Put webb directory in your public_html, change loadData.php with correct username, password and databasename

and create a database with schema from ispwithipv6.mysql



