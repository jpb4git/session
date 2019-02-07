# NGSHOP 


projet éducatif  réalisé au campus numerique in the Alps

https://digital-grenoble.com/campus-numerique-in-the-alps/


## Getting Started


git clone the project with the command :


git clone git@github.com:jpb4git/session.git




### Prerequisites

vous devez avoir un serveur web installé sur votre machine 
[Nginx ou Apache ] 

## Installing Nginx


install Nginx
term : sudo apt-get install nginx

## Configure  Nginx

éditez votre  /etc/Nginx/sites-available/default   file 
```
vous pouvez changer le root du server par la ligne 

root /var/www/[VOtreDossierRoot]
```
//après location ajouter ces lignes pour la gestion  de PHP par Nginx
```
location ~ \.PHP$ {
   include snippets/fastcgi-php.conf;
  fastcgi_pass unix:/run/PHP/php7.2-fpm.sock;
}
```

## Configure  php



## Running step 3 (terminal mode)


une application en mode terminal est accecible à la racine du site: 
 tapez  :
 ```
 ngshop 
```

vous disposez d'une aide el ligne en passant par la commande 
 
```
ngshop --help
```




## Deployment
placez ce repo dans votre www.
Appelez-le via le browser par localhost/VotreRepo/



## Built With




## Contributing




## Versioning


We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 


## Authors


* **JEAN-PASCAL BOUDET** - *Initial work* - [jpb4git](https://github.com/jpb4git/)




## License


This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


## Acknowledgments


* design inspiration (www.nginx.com)