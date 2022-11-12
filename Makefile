.PHONY: *

USER_NAME := $(shell id -u -n)
USER_ID := $(shell id -u)
GROUP_ID := $(shell id -g)
WWW_DATA_GROUP_ID := 33
RUNNING_CONTAINER_IDS := $(shell docker ps -q)

set-permissions:
	sudo chown -R $(USER_ID):$(WWW_DATA_GROUP_ID) .
	sudo chmod -R 755 .
	sudo chmod -R 775 ./bootstrap/cache ./storage

clean:
	@echo -n "Warning! Data will be cleaned (include database). Are you sure? [y/N] " && read ans && [ $${ans:-N} = y ]
	make stop
	make set-permissions
	rm -R -f \
		.docker/mysql/data \
		.docker/nginx/logs \
		.docker/php/profiler \
		vendor \
		node_modules \
		public/storage
	docker-compose rm -f

install:
	make stop
	docker-compose build \
      --build-arg USER_NAME=$(USER_NAME) \
      --build-arg USER_ID=$(USER_ID) \
      --build-arg GROUP_ID=$(GROUP_ID) \
      --build-arg WWW_DATA_GROUP_ID=$(WWW_DATA_GROUP_ID)
	# run 1st time to create database volume (if it doesn't exist)
	make run
	# stop
	make stop
	# and set permissions (including database volume permissions)
	make set-permissions
	make run
	docker exec -it e-store-container-php composer install --dev
	docker exec -it e-store-container-php npm install
	# create .env if it doesn't exist
	ls .env 2> /dev/null || cp .env.example .env
	docker exec -it e-store-container-php php artisan key:generate
	docker exec -it e-store-container-php php artisan storage:link
	# profiler doesn't create directory automatically (so we need to create it manually)
	mkdir -p .docker/php/profiler

run:
	docker-compose up -d

stop:
ifeq ($(RUNNING_CONTAINER_IDS),)
	@printf "" #printf empty string to prevent error
else
	@docker stop $(RUNNING_CONTAINER_IDS)
endif

in:
	docker exec -it e-store-container-php bash
