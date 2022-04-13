#!/bin/bash
#création d'utilisateur linux
user=$1
password=$2
useradd $user -md /home/$user
echo $user:$password | chpasswd
mkdir /home/$user/public_html
touch /home/$user/public_html/index.html
chown $user /home/$user -R

#création d'un fichier de configuration

cp /etc/apache2/sites-available/xxxx.conf /etc/apache2/sites-available/$user.conf

#pour remplacer la chaine xxxx par lalias choisi par lutilisateur
sed -i -e "s/xxxx/$user/g" /etc/apache2/sites-available/$user.conf

#activer la nouvelle configuration
a2ensite $user.conf
#recharger le service apache2
service apache2 reload
#pour ajouter l'enregistrement DNS
echo "$user IN CNAME SrWeb">>/etc/bind/db.heberge9.lan
#relancer le service bind9
service bind9 reload
