#!/bin/sh

PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
JARPATH=/var/www/dev-1.oep-penza/smev

 if [ -z `netstat -nl|grep -os 7222` ];
 then
    java -cp ${JARPATH}/oep-signer-0.0.1-SNAPSHOT.jar com.oep.sign.CryptoServer 7222 PGU-PENZA aeynbr2013 1 &
 fi

exit 0
