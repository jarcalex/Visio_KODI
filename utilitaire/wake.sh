#!/bin/sh

vAdreMac=0
vSleep="0m"


######
# Fonction de verification des parametres
fCheckParam() {
  unset vAdreMac

  while [ "$#" -gt "0" ]
  do
    case "$1" in
	--mac) shift;export vAdreMac=$1;;
	--sleep) shift;export vSleep=$1;;
    esac
    shift
  done

  if [ -z ${vAdreMac} ]; then
      echo -e "Option --mac obligatoire !\n"
      exit 
  fi

}



################################
# Main
################################

# Control des parametres de la ligne de commande
fCheckParam $*

if [ "${vSleep}" = "0m" ]; then
  wakeonlan ${vAdreMac} 2>&1
else
  sleep ${vSleep}
  wakeonlan ${vAdreMac} 2>&1
fi
