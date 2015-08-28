#!/bin/sh


vStart="mount -t cifs -o guest,file_mode=0777,dir_mode=0777,iocharset=utf8 //192.168.0.10/RPI /mnt/cifs"
vStop="umount /mnt/cifs"

################################
# Main
################################


case "$1" in
  "start") 
     echo -n "Montage : " ;
     `${vStart}` 2>&1 ;
     if [ $? -eq 0 ]; then
          echo "OK";
     else
          echo "KO";
     fi;;

  "stop")
     echo -n "Demontage : " ;
     `${vStop}`  2>&1;
     if [ $? -eq 0 ]; then
          echo "OK";
     else
          echo "KO";
     fi;;

  "restart")
     `${vStop}`  2>&1;
     `${vStart}` 2>&1;;
esac


#if [ "$1" = "start" ]; then
#  `${vStart}` 2>&1
#elif [ "$1" = "stop"]; then
#  `${vStop}` 2>&1
#fi
