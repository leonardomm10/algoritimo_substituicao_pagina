FROM httpd:2.4-alpine

WORKDIR /usr/local/apache2

RUN sed -i \
    -e 's/^#\(Include .*httpd-vhosts.conf\)/\1/' \
    -e 's/^#\(LoadModule .*mod_proxy.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_rewrite.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_proxy_fcgi.so\)/\1/' \
    conf/httpd.conf

ADD httpd-vhosts.conf conf/extra/httpd-vhosts.conf