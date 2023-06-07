FROM registry.cn-shenzhen.aliyuncs.com/luler/linux_php_nginx:php8

MAINTAINER 1207032539@qq.com

COPY ./code /home/wwwroot

COPY ./config/supervisor/supervisord.conf /etc/supervisord.conf

COPY ./config/supervisor/supervisord.d /etc/supervisord.d

COPY ./config/php/etc /usr/local/php/etc

WORKDIR /home/wwwroot/api

EXPOSE 7744