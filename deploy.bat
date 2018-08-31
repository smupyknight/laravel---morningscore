IF "%2"=="-pa" (
    GOTO PRODUCTION_ASSETS
) ELSE (
    GOTO DEPLOY
)

:PRODUCTION_ASSETS
CALL npm run production
GOTO DEPLOY

:DEPLOY
git add -A
git commit -m %1
git push origin dev