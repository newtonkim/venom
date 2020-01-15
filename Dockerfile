FROM webdevops/php-nginx:7.1

WORKDIR /var/www/html/public

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN apt install nodejs

RUN apt-get --assume-yes install xfonts-base xfonts-75dpi zlib1g-dev
RUN dpkg -i wkhtmltox_0.12.5-1.stretch_amd64.deb
RUN apt-get --assume-yes install -f

ADD . .

RUN npm install
RUN composer install --verbose
RUN apt-get update
RUN apt-get install -y mysql-client
RUN docker-php-ext-install pdo_mysql
