# Setup
1. Install composer
2. Copy .env.example into .env
3. Change APP_URL in .env to your localhost path to the project
4. Update DB_* to match your local database
5. In the project root run:
- composer install
- php artisan system:build

## OSX Setup
- You might need to make composer executable
```shell
cd /usr/local/bin
sudo chmod +x composer
```

# Working with assets (Javascript & Sass)
- Install npm dependencies (npm install)
- Run watch (npm run watch)

# MorningTrain Foundation
## IDE Environments
### PhpStorm
- For a better JavaScript development experience make sure you enable ESLint from "Preferences" -> "Languages and Frameworks" -> "Code Quality Tools" -> "ESLint"
- For a better code completion in JavaScript make sure you set the "resources/js" folder
as "Sources Root" by right clicking it and selecting "Mark directory as" -> "Sources Root"