#!/bin/bash

/usr/bin/chown -R www.www /home/wwwroot

#定时任务
cat >/etc/crontab <<EOF
SHELL=/bin/bash
PATH=/sbin:/bin:/usr/sbin:/usr/bin
MAILTO=root

# * * * * * www cd /home/wwwroot/api && php think run_job
EOF