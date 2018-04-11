# Contributing

Contributions are always welcome, no matter how large or small.

**Before contributing, please read our [code of conduct](CODE_OF_CONDUCT.md)**.

## Developing

**Requirements**

```
php >= 7.0.7
composer >= 1.5.0
```

**Setup**

```sh
git clone git@github.com:cyberfox-software/redfox.git
cd redfox
composer install
```

### Code Style

We adheres to [PSR-2](http://www.php-fig.org/psr/psr-2/) standards. 
Use the [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) tool to automatically apply code styles.

Run fixer:
```sh
php vendor/bin/php-cs-fixer fix --using-cache=no
```

## Change Requests

1. Commit your changes following the 
[conventional-changelog-standard](https://github.com/bcoe/conventional-changelog-standard/blob/master/convention.md).
1. Push your changes to a remote branch (e.g. `feat/my_awesome_change`)
1. Create a merge/pull request
