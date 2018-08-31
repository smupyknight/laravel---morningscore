FROM my-php-app:latest

EXPOSE 80/tcp
EXPOSE 443/tcp

# Create app directory
WORKDIR /home/app

COPY . .
COPY .env.example ./.env

RUN chown -R app: .

USER app

RUN composer install
RUN npm install cross-env
RUN npm install --only=production
RUN npm run production
RUN php artisan key:generate

USER root