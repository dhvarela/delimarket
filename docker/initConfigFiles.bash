#!/bin/bash

# Copy config files
cp .env.template .env
cp docker-container-config-files/sites/market.com.template docker-container-config-files/sites/market.com
cp docker-container-config-files/xdebug/xdebug.ini.template docker-container-config-files/xdebug/xdebug.ini

# Add domain to local hosts file
echo "172.16.4.2 market.com" | sudo tee -a /etc/hosts