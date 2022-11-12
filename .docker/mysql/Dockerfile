FROM mysql:8.0.28

ARG USER_ID
ARG USER_NAME
ARG GROUP_ID

# add default user (same as current host user)
# to sync permissions between this container files and host files
RUN groupadd -g ${GROUP_ID} ${USER_NAME} \
    && useradd -u ${USER_ID} -g ${GROUP_ID} ${USER_NAME}
USER ${USER_ID}
