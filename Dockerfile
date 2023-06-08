FROM registry.cn-shenzhen.aliyuncs.com/luler/swoole_base

MAINTAINER 1207032539@qq.com

COPY ./code /home/code

COPY ./config/supervisor/supervisord.conf /etc/supervisord.conf

COPY ./config/supervisor/supervisord.d /etc/supervisord.d

COPY ./config/php/php.ini /etc/php.ini

COPY ./config/php/php.d /etc/php.d

WORKDIR /home/code/api

EXPOSE 7744