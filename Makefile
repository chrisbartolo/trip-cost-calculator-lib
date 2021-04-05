install-local:
	composer install

build:
	docker build -t trip-cost-calculator .

test:
	docker run -it trip-cost-calculator

test-local:
	./vendor/bin/phpunit tests --testdox

codecov-local:
	./vendor/bin/phpunit tests --coverage-clover coverage.xml

docs:
	docker run --rm -v ${PWD}:/data phpdoc/phpdoc:3 run -d src -t phpdoc