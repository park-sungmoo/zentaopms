#!/bin/bash
# usage: ./init.sh /usr/bin/php http://localhost

phpcli=$1
pmsRoot=$2
basePath=$(cd "$(dirname "$0")"; pwd)
if [ ! -n "$1" ]; then
  while :; do
    echo "Please input your php path:(example: /usr/bin/php)"
    read phpcli
    if [ ! -f $phpcli ]; then
      echo "php path is error";
    elif [ "$phpcli"x != ""x ]; then
      break;
    fi
  done
fi
if [ ! -n "$2" ]; then
  while :; do
    echo "Please input zentao url:(example: http://localhost:88/zentao or http://localhost)"
    read pmsRoot
    if [ -z "$pmsRoot" ]; then
      echo "zentao url is error";
    else
      break;
    fi
  done
fi

pmsRoot=`echo "$pmsRoot" | sed 's/[/]$//g'`
cat $basePath/../config/my.php |awk '$1!~/^\/\//&& $1~/\$config\->requestType/{requestType = $0} END{print requestType}'| grep -c 'PATH_INFO' > ./init.tmp
if [ "`cat ./init.tmp`" != 0 ];then
  requestType='PATH_INFO';
else
  requestType='GET';
fi
rm ./init.tmp

# ztcli
ztcli="$phpcli $basePath/ztcli \$*"
echo $ztcli > $basePath/ztcli.sh
echo "ztcli.sh ok"

# backup database
if [ $requestType == 'PATH_INFO' ]; then
  backup="$phpcli $basePath/ztcli '$pmsRoot/backup-backup.html'";
else
  backup="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=backup&f=backup'";
fi
echo $backup > $basePath/backup.sh
echo "backup.sh ok"

# computeburn
if [ $requestType == 'PATH_INFO' ]; then
  computeburn="$phpcli $basePath/ztcli '$pmsRoot/execution-computeburn'";
else
  computeburn="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=execution&f=computeburn'";
fi
echo $computeburn > $basePath/computeburn.sh
echo "computeburn.sh ok"

# compute task effort.
if [ $requestType == 'PATH_INFO' ]; then
  computetaskeffort="$phpcli $basePath/ztcli '$pmsRoot/execution-computetaskeffort'";
else
  computetaskeffort="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=execution&f=computetaskeffort'";
fi
echo $computetaskeffort > $basePath/computetaskeffort.sh
echo "computetaskeffort.sh ok"

# daily remind
if [ $requestType == 'PATH_INFO' ]; then
  checkdb="$phpcli $basePath/ztcli '$pmsRoot/report-remind'";
else
  checkdb="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=report&f=remind'";
fi
echo $checkdb > $basePath/dailyreminder.sh
echo "dailyreminder.sh ok"

# check database
if [ $requestType == 'PATH_INFO' ]; then
  checkdb="$phpcli $basePath/ztcli '$pmsRoot/admin-checkdb'";
else
  checkdb="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=admin&f=checkdb'";
fi
echo $checkdb > $basePath/checkdb.sh
echo "checkdb.sh ok"

# syncsvn.
if [ $requestType == 'PATH_INFO' ]; then
  syncsvn="$phpcli $basePath/ztcli '$pmsRoot/svn-run'";
else
  syncsvn="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=svn&f=run'";
fi
echo $syncsvn > $basePath/syncsvn.sh
echo "syncsvn.sh ok"

# syncgit.
if [ $requestType == 'PATH_INFO' ]; then
  syncgit="$phpcli $basePath/ztcli '$pmsRoot/git-run'";
else
  syncgit="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=git&f=run'";
fi
echo $syncgit > $basePath/syncgit.sh
echo "syncgit.sh ok"

# async send mail.
if [ $requestType == 'PATH_INFO' ]; then
  mailsend="$phpcli $basePath/ztcli '$pmsRoot/mail-asyncSend'";
else
  mailsend="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=mail&f=asyncSend'";
fi
echo $mailsend > $basePath/sendmail.sh
echo "sendmail.sh ok"

# async send webhook.
if [ $requestType == 'PATH_INFO' ]; then
  sendwebhook="$phpcli $basePath/ztcli '$pmsRoot/webhook-asyncSend'";
else
  sendwebhook="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=webhook&f=asyncSend'";
fi
echo $sendwebhook > $basePath/sendwebhook.sh
echo "sendwebhook.sh ok"

# create cycle todo.
if [ $requestType == 'PATH_INFO' ]; then
  createcycle="$phpcli $basePath/ztcli '$pmsRoot/todo-createCycle'";
else
  createcycle="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=todo&f=createCycle'";
fi
echo $createcycle > $basePath/createcycle.sh
echo "createcycle.sh ok"

# init queue.
if [ $requestType == 'PATH_INFO' ]; then
  initqueue="$phpcli $basePath/ztcli '$pmsRoot/ci-initQueue'";
else
  initqueue="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=ci&f=initQueue'";
fi
echo $initqueue > $basePath/initqueue.sh
echo "initqueue.sh ok"

# check build status.
if [ $requestType == 'PATH_INFO' ]; then
  checkbuildstatus="$phpcli $basePath/ztcli '$pmsRoot/ci-checkBuildStatus'";
else
  checkbuildstatus="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=ci&f=checkBuildStatus'";
fi
echo $checkbuildstatus > $basePath/checkbuildstatus.sh
echo "checkbuildstatus.sh ok"

# execute compile.
if [ $requestType == 'PATH_INFO' ]; then
  execcompile="$phpcli $basePath/ztcli '$pmsRoot/ci-exec'";
else
  execcompile="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=ci&f=exec'";
fi
echo $execcompile > $basePath/execcompile.sh
echo "execcompile.sh ok"

# delete log.
if [ $requestType == 'PATH_INFO' ]; then
  deletelog="$phpcli $basePath/ztcli '$pmsRoot/admin-deleteLog'";
else
  deletelog="$phpcli $basePath/ztcli '$pmsRoot/index.php?m=admin&f=deleteLog'";
fi
echo $deletelog > $basePath/deletelog.sh
echo "deletelog.sh ok"

# encrypt.
if [ -f "$basePath/php/encrypt.php" ]; then
  encrypt="$phpcli $basePath/php/encrypt.php \$*"
  echo $encrypt > $basePath/encrypt.sh
  echo "encrypt.sh ok"
fi

# cron
if [ ! -d "$basePath/cron" ]; then
  mkdir $basePath/cron
fi
echo "# system cron." > $basePath/cron/sys.cron
echo "#min   hour day month week  command." >> $basePath/cron/sys.cron
echo "0      1    *   *     *     $basePath/dailyreminder.sh   # dailyreminder."            >> $basePath/cron/sys.cron
echo "1      1    *   *     *     $basePath/backup.sh          # backup database and file." >> $basePath/cron/sys.cron
echo "1      23   *   *     *     $basePath/computeburn.sh     # compute burndown chart."   >> $basePath/cron/sys.cron
echo "1-59/5 *    *   *     *     $basePath/syncsvn.sh         # sync subversion."          >> $basePath/cron/sys.cron
echo "1-59/5 *    *   *     *     $basePath/syncgit.sh         # sync git."                 >> $basePath/cron/sys.cron
echo "1-59/5 *    *   *     *     $basePath/sendmail.sh        # async send mail."          >> $basePath/cron/sys.cron
echo "1-59/5 *    *   *     *     $basePath/sendwebhook.sh     # async send webhook."       >> $basePath/cron/sys.cron
echo "1      1    *   *     *     $basePath/createcycle.sh     # create cycle todo."        >> $basePath/cron/sys.cron
echo "30     1    *   *     *     $basePath/deletelog.sh       # delete log."               >> $basePath/cron/sys.cron
echo "1      0    *   *     *     $basePath/initqueue.sh       # init queue."               >> $basePath/cron/sys.cron
echo "1-59/5 *    *   *     *     $basePath/checkbuildstatus.sh   # check build status."    >> $basePath/cron/sys.cron
echo "1-59/5 *    *   *     *     $basePath/execcompile.sh        # execute compile."       >> $basePath/cron/sys.cron
cron="$phpcli $basePath/php/crond.php"
echo $cron > $basePath/cron.sh
echo "cron.sh ok"

chmod 755 $basePath/*.sh

exit 0
