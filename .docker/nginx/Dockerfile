FROM nginx:1.21
RUN openssl req -newkey rsa:4096 \
                -x509 \
                -sha256 \
                -days 3650 \
                -nodes \
                -out e-store.crt \
                -keyout e-store.key \
                -subj "/C=US/ST=New Yourk/L=New Yourk/O=e-store company/OU=IT Department/CN=www.e-store.local" \
    && mv e-store.crt /etc/ssl/certs \
    && mv e-store.key /etc/ssl/private
