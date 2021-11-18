# deliberry market repository

## Requiments:
- Linux.
- Docker must be installed in your local host.

## Environment setup steps:
- Clone this repository in your local host.

- Open a terminal, go to the repository folder and enter to the "docker" folder.

- Execute the initConfigFiles.bash script:
```
bash initConfigFiles.bash
```
This script will copy the template config files into your local machine.

- OPTIONAL: If you want to setup Xdebug, edit the xdebug.ini config file (inside docker/docker-container-config-files/xdebug/xdebug.ini) and replace the comments with your local IP address and listen port:
```
xdebug.remote_host=#<%SET_YOUR_LOCAL_IP_HERE%>
xdebug.remote_port=#<%SET_YOUR_LOCAL_XDEBUG_LISTEN_PORT_HERE%>
```
The default xdebug port is the 9000, change it if you are already using this port.

- Execute: 
```
docker-compose up -d
```
If everything goes fine, you will have two new docker containers running, to check it, execute this command 
```
docker ps -a | grep market
```
and check that all containers are "UP"
```
dedf6c599670        market              "/bin/sh -c 'supervi…"   29 minutes ago      Up 27 seconds              80/tcp, 443/tcp                            market
5e9dc9c55aba        mysql:5.7           "docker-entrypoint.s…"   29 minutes ago      Up 26 seconds              3306/tcp, 33060/tcp                        market-mysql-server
```

## Application setup steps:

##### Symfony .env files:
Inside the application folder (market/) you will find a .env.template file.
Create a new .env file and copy the .env.template file content into this new file.

After this step you will need to replace all the .env file macros (<%MACRO_NAME%>) with the correct configuration values. 
In this case you only need to replace the database connection configuration line with the following line:
```
DATABASE_URL=mysql://root:password@172.16.4.3:3306/market?serverVersion=5.7
```

After this step you will need to replace all the .env.test file macros (<%MACRO_NAME%>) with the correct configuration values.
In this case you only need to replace the database connection configuration line with the following line:
```
DATABASE_URL=mysql://root:password@172.16.4.3:3306/market_test?serverVersion=5.7
```


##### Dependency Installation (if you prefer to manage the application dependencies through your local host skip this step):
- Enter into the market container executing:
```
docker exec -ti market bash
``` 
- Change to composer user:
```
su composer
``` 
- Go to the application folder (in this case /var/www/market/) and execute:
```
composer install
```

##### Database setup:
You can connect to the database using your favorite DB management tool. Use the default credentials if you have not changed them in the previous steps:
```
Host: 172.16.4.3
Port: 3306
User: root
Password: password
``` 

You can create databases and pass the fixtures if you want to fill the database with some data

    php bin/console doctrine:database:create
    
    php bin/console doctrine:database:create --env=test

    php bin/console d:m:m

    php bin/console d:m:m --env=test

    php bin/console d:f:l

    php bin/console d:f:l --env=test

##### Run the tests and generate a coverage dashboard:

    ./bin/phpunit --coverage-html tests/build/coverage-report