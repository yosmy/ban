# Test

docker network create backend

cd test

export UID
export GID
docker-compose \
-f docker/all.yml \
-p yosmy_stripe \
up -d \
--remove-orphans --force-recreate

docker exec -it yosmy_stripe_php sh

php test/bin/app.php /create-token