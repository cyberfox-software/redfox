git subsplit init git@github.com:cyberfox-software/redfox.git

git subsplit publish --heads="master" --no-tags packages/container:git@github.com:cyberfox-software/redfox-container.git

rm -Recurse -Force .\.subsplit
