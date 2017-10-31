#!/usr/bin/bash
case $1 in
	stop)
		sudo nginx -s stop
		sudo lsof -i:9000 | awk 'NR>1{print $2}'| xargs sudo kill
		;;
	restart)
		sudo nginx -s reopen
		sudo lsof -i:9000 | awk 'NR>1{print $2}'| xargs sudo kill
		start)
		sudo nginx
		sudo php-fpm
		;;
	sudo php-fpm
esac
