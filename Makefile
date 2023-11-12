lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin
install:
	composer install
start1:
	php bin/converter.php Задание/categories.json --Url --nameFile text_a.txt
start2:
	php bin/converter.php Задание/categories.json -n 1 --nameFile text_b.txt
pageLaunch:
	php -S localhost:8080
