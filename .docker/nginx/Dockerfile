FROM nginx:1.21
RUN openssl req -newkey rsa:4096 \
                -x509 \
                -sha256 \
                -days 3650 \
                -nodes \
                -out oblepiha.crt \
                -keyout oblepiha.key \
                -subj "/C=US/ST=New Yourk/L=New Yourk/O=oblepiha company/OU=IT Department/CN=www.oblepiha.local" \
    && mv oblepiha.crt /etc/ssl/certs \
    && mv oblepiha.key /etc/ssl/private
