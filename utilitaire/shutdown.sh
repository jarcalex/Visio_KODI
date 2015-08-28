#!/bin/sh

vSleep="0m"


######
# Fonction de verification des parametres
fCheckParam() {

  while [ "$#" -gt "0" ]
  do
    case "$1" in
	--sleep) shift;export vSleep=$1;;
    esac
    shift
  done
}



################################
# Main
################################

# Control des parametres de la ligne de commande
fCheckParam $*

if [ "${vSleep}" = "0m" ]; then
  shutdown -h now 2>&1
else
  sleep ${vSleep}
  shutdown -h now 2>&1
fi
