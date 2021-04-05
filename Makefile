install-local:
	composer install

build:
	docker build -t trip-cost-calculator .

test:
	docker run -it trip-cost-calculator

test-local:
	./vendor/bin/phpunit tests --testdox

docs:
	docker run --rm -v ${PWD}:/data phpdoc/phpdoc:3 run -d src -t phpdoc