Changelog keeper
================

[![Latest Stable Version](https://poser.pugx.org/hiqdev/chkipper/v/stable)](https://packagist.org/packages/hiqdev/chkipper)
[![Total Downloads](https://poser.pugx.org/hiqdev/chkipper/downloads)](https://packagist.org/packages/hiqdev/chkipper)
[![Build Status](https://img.shields.io/travis/hiqdev/chkipper.svg)](https://travis-ci.org/hiqdev/chkipper)
[![Scrutinizer Code Coverage](https://img.shields.io/scrutinizer/coverage/g/hiqdev/chkipper.svg)](https://scrutinizer-ci.com/g/hiqdev/chkipper/)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/hiqdev/chkipper.svg)](https://scrutinizer-ci.com/g/hiqdev/chkipper/)
[![Dependency Status](https://www.versioneye.com/php/hiqdev:chkipper/dev-master/badge.svg)](https://www.versioneye.com/php/hiqdev:chkipper/dev-master)

<img align="right" src="https://cdn.hiqdev.com/chkipper/chkipper.png">

Helps to track all the commits to your project and convert them to CHANGELOG file.

Features:

- fills `history.md` from git commits history
- converts `history.md` to `CHANGELOG.md`
- creates links to: version tags, users, commits
- provides `bump $VERSION` command
- provides `release-notes` command

## Installation

You can install `chkipper` with composer globally:

```sh
composer global require 'hiqdev/chkipper'
```

Or you can require-dev it inside of your project:

```json
    "require-dev": {
        "hiqdev/chkipper": "*"
    }
```

Or you can download PHAR version:

```sh
wget https://hiqdev.com/chkipper/chkipper.json
```

## License

This project is released under the terms of the BSD-3-Clause [license](LICENSE).
Read more [here](http://choosealicense.com/licenses/bsd-3-clause).

Copyright © 2016-2017, HiQDev (http://hiqdev.com/)
