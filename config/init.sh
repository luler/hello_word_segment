#!/bin/bash

#定时任务
cat >/etc/crontab <<EOF
SHELL=/bin/bash
PATH=/sbin:/bin:/usr/sbin:/usr/bin
MAILTO=root

# * * * * * www cd /home/code/api && php think run_job
EOF