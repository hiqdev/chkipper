hiqdev/chkipper
---------------

## [0.1.1] - 2017-01-03

- Fixed changelog normalization
    - [f522ad0] 2017-01-03 fixed changelog normalization [@hiqsol]
- Fixed release notes rendering
    - [f8ed164] 2017-01-03 fixed regexp for links in ReleaseNotesRenderer [@hiqsol]
    - [ab688bd] 2017-01-03 renamed and improved ReleaseNotesRenderer [@hiqsol]
    - [b37393b] 2017-01-03 csfixed [@hiqsol]

## [0.1.0] - 2017-01-03

- Changed/refactored chkipper history lib into `lib` directory
    - [cbd94e4] 2017-01-03 refactored chkipper history lib into `lib` directory [@hiqsol]
    - [8d38b32] 2017-01-03 csfixed [@hiqsol]
    - [a39fe61] 2017-01-03 fixed use [@hiqsol]
- Changed/refactored normalization into separate modifier classes
    - [da684aa] 2017-01-03 refactored normalization into separate modifier classes [@hiqsol]
    - [11a3761] 2017-01-02 + AbstractModifier and ModifierInterface [@hiqsol]
- Added config loading and injection into history manipulating objects
    - [fdef122] 2017-01-01 doc [@hiqsol]
    - [0ca2029] 2017-01-01 csfixed [@hiqsol]
    - [824ab5b] 2017-01-01 fixed tests [@hiqsol]
    - [e6d158b] 2017-01-01 + autoload-dev for tests [@hiqsol]
    - [ec53d7f] 2017-01-01 fixed link generation for last tag [@hiqsol]
    - [a4baaba] 2017-01-01 + getConfig in builder and renderer [@hiqsol]
    - [1d6807e] 2017-01-01 added config propagation into history, parsers and renderers with constructor dependency injection [@hiqsol]
    - [a45280d] 2017-01-01 added loading config in Config component [@hiqsol]
- Added bin to `composer.json`
    - [58381ae] 2016-12-29 Added bin section to composer.json [@SilverFire]
- Added authors links to CHANGELOG and release notes
    - [b4dec1f] 2016-12-30 + links to release-notes [@hiqsol]
    - [df68a47] 2016-12-30 fixed pattern for user in commit [@hiqsol]
    - [fb0ce2a] 2016-12-13 Added authors links to CHANGELOG [@hiqsol]
- Added tag links generation
    - [9810468] 2016-12-11 fixed generating tag links [@hiqsol]
    - [6517a9e] 2016-12-11 + addTagLinks normalizer [@hiqsol]

## [0.0.3] - 2016-12-10

- Added prettifying user links
    - [e03f6d8] 2016-12-10 used user links prettifier for history [@hiqsol]
    - [ea103f6] 2016-12-10 + prettifyUserLinks normalizer [@hiqsol]
    - [1637562] 2016-12-10 csfixed [@hiqsol]
    - [a4da4ba] 2016-12-04 removed old code [@hiqsol]

## [0.0.2] - 2016-11-28

- Added showing notices when files were changed
    - [a027022] 2016-11-28 used default yii console Application [@hiqsol]
    - [740d749] 2016-11-28 added showing notices when files were changed [@hiqsol]
    - [3041e8c] 2016-11-28 removed roadmap, moved to basic description [@hiqsol]
    - [c36094f] 2016-10-17 csfixed [@hiqsol]
    - [0781c81] 2016-10-15 added ROADMAP.md [@hiqsol]

## [0.0.1] - 2016-08-01

- Added `release-notes` command
    - [dacee04] 2016-07-31 csfixed [@hiqsol]
    - [a40061d] 2016-07-31 added `prependNotes` for history merging [@hiqsol]
    - [d3c2dee] 2016-07-31 + ConvertController [@hiqsol]
    - [173fd23] 2016-07-31 added `release-notes` command [@hiqsol]
    - [6c0f4b9] 2016-07-31 added NotesRenderer [@hiqsol]
- Added version bumping
    - [a22a8ca] 2016-07-30 improved package description [@hiqsol]
    - [50b23ff] 2016-07-30 + proper bumping to `dev` version [@hiqsol]
    - [12041e2] 2016-07-02 added project property to History [@hiqsol]
    - [d7fd56d] 2016-07-02 + remove commit links that are not in the history [@hiqsol]
    - [1c6c639] 2016-07-02 added bump to version [@hiqsol]
    - [d4c4221] 2016-07-02 added normalization functions [@hiqsol]
    - [b485d53] 2016-07-02 + removing functions [@hiqsol]
- Added better history normalizing
    - [c0ef4f7] 2016-07-30 improved setTagDates normalizer [@hiqsol]
    - [f3fbcf8] 2016-07-30 + Tag::unsetDate [@hiqsol]
    - [290e3d7] 2016-07-30 fixed setTagDates normalizer [@hiqsol]
    - [fd4dcf5] 2016-07-30 fixed setTagDates normalizer [@hiqsol]
    - [db0185b] 2016-07-29 + setTagDates normalization [@hiqsol]
    - [320c48a] 2016-07-29 + Tag::findDate method [@hiqsol]
    - [a223ca8] 2016-07-24 normalization moved to History class [@hiqsol]
    - [56ef180] 2016-07-23 fixed tests [@hiqsol]
    - [fa2a8b0] 2016-07-23 + adding initial tag at normalizing [@hiqsol]
    - [3aa4129] 2016-07-23 mino [@hiqsol]
    - [9a51d73] 2016-07-03 csfixed [@hiqsol]
- Added CHANGELOG rendering
    - [1b355d8] 2016-06-26 added Markdown changelog renderer [@hiqsol]
- Added basics
    - [39173f4] 2016-06-25 fixed GitLogParserTest [@hiqsol]
    - [c1ac45f] 2016-06-21 moved skipCommit to Builder [@hiqsol]
    - [e512ebb] 2016-06-21 fixed parsing commit subject [@hiqsol]
    - [0af4883] 2016-06-21 added remove commits at note [@hiqsol]
    - [e3c73a5] 2016-06-21 better tag parsing [@hiqsol]
    - [65f78d8] 2016-06-21 added `bump/parse` action [@hiqsol]
    - [b4af2db] 2016-06-21 testing format [@hiqsol]
    - [8867abe] 2016-06-20 added links generation [@hiqsol]
    - [8744322] 2016-06-20 generated the `history.md` for the first time [@hiqsol]
    - [9e5ffcb] 2016-06-19 added history merging [@hiqsol]
    - [4dab065] 2016-06-19 csfixed [@hiqsol]
    - [d478762] 2016-06-19 finished and tested git log parser [@hiqsol]
    - [59f3c32] 2016-06-19 csfixed [@hiqsol]
    - [246322f] 2016-06-19 refactored out AbstractParser/renderer, Markdown/GitLogParser [@hiqsol]
    - [958f2a2] 2016-06-19 parsing git log looks good [@hiqsol]
    - [8088237] 2016-06-18 refactoring [@hiqsol]
    - [3862ca1] 2016-06-18 refactored [@hiqsol]
    - [953e3e9] 2016-06-18 adding GitMerger [@hiqsol]
    - [21ce070] 2016-06-18 + config component [@hiqsol]
    - [ebe319b] 2016-06-17 removed old from History [@hiqsol]
    - [cabe759] 2016-06-17 added initial history [@hiqsol]
    - [64a1aef] 2016-06-17 fixed setHeaders() [@hiqsol]
    - [13f9c8d] 2016-06-17 csfixed [@hiqsol]
    - [dc889ee] 2016-06-17 renderer looks good [@hiqsol]
    - [0ea21ad] 2016-06-17 parser tested ok [@hiqsol]
    - [b67662c] 2016-06-17 starting Renderer [@hiqsol]
    - [e856219] 2016-06-17 splitted Builder and Parser [@hiqsol]
    - [990f07f] 2016-06-17 testing format [@hiqsol]
    - [035d8e3] 2016-06-17 testing commits file format [@hiqsol]
    - [ae01358] 2016-06-14 added basics and minimal test [@hiqsol]
    - [494229b] 2016-06-11 still initing [@hiqsol]
    - [2d5de51] 2016-06-11 fixed requirements [@hiqsol]
    - [6cee114] 2016-06-11 initing [@hiqsol]
    - [b22f8ac] 2016-06-11 inited [@hiqsol]
        - longer description for initial commit

## [Development started] - 2016-06-11

[@hiqsol]: https://github.com/hiqsol
[sol@hiqdev.com]: https://github.com/hiqsol
[@SilverFire]: https://github.com/SilverFire
[d.naumenko.a@gmail.com]: https://github.com/SilverFire
[b22f8ac]: https://github.com/hiqdev/chkipper/commit/b22f8ac
[8744322]: https://github.com/hiqdev/chkipper/commit/8744322
[9e5ffcb]: https://github.com/hiqdev/chkipper/commit/9e5ffcb
[4dab065]: https://github.com/hiqdev/chkipper/commit/4dab065
[d478762]: https://github.com/hiqdev/chkipper/commit/d478762
[59f3c32]: https://github.com/hiqdev/chkipper/commit/59f3c32
[246322f]: https://github.com/hiqdev/chkipper/commit/246322f
[958f2a2]: https://github.com/hiqdev/chkipper/commit/958f2a2
[8088237]: https://github.com/hiqdev/chkipper/commit/8088237
[3862ca1]: https://github.com/hiqdev/chkipper/commit/3862ca1
[953e3e9]: https://github.com/hiqdev/chkipper/commit/953e3e9
[21ce070]: https://github.com/hiqdev/chkipper/commit/21ce070
[ebe319b]: https://github.com/hiqdev/chkipper/commit/ebe319b
[cabe759]: https://github.com/hiqdev/chkipper/commit/cabe759
[64a1aef]: https://github.com/hiqdev/chkipper/commit/64a1aef
[13f9c8d]: https://github.com/hiqdev/chkipper/commit/13f9c8d
[dc889ee]: https://github.com/hiqdev/chkipper/commit/dc889ee
[0ea21ad]: https://github.com/hiqdev/chkipper/commit/0ea21ad
[b67662c]: https://github.com/hiqdev/chkipper/commit/b67662c
[e856219]: https://github.com/hiqdev/chkipper/commit/e856219
[990f07f]: https://github.com/hiqdev/chkipper/commit/990f07f
[035d8e3]: https://github.com/hiqdev/chkipper/commit/035d8e3
[ae01358]: https://github.com/hiqdev/chkipper/commit/ae01358
[494229b]: https://github.com/hiqdev/chkipper/commit/494229b
[2d5de51]: https://github.com/hiqdev/chkipper/commit/2d5de51
[6cee114]: https://github.com/hiqdev/chkipper/commit/6cee114
[8867abe]: https://github.com/hiqdev/chkipper/commit/8867abe
[0af4883]: https://github.com/hiqdev/chkipper/commit/0af4883
[e3c73a5]: https://github.com/hiqdev/chkipper/commit/e3c73a5
[65f78d8]: https://github.com/hiqdev/chkipper/commit/65f78d8
[b4af2db]: https://github.com/hiqdev/chkipper/commit/b4af2db
[c1ac45f]: https://github.com/hiqdev/chkipper/commit/c1ac45f
[e512ebb]: https://github.com/hiqdev/chkipper/commit/e512ebb
[39173f4]: https://github.com/hiqdev/chkipper/commit/39173f4
[1c6c639]: https://github.com/hiqdev/chkipper/commit/1c6c639
[d4c4221]: https://github.com/hiqdev/chkipper/commit/d4c4221
[b485d53]: https://github.com/hiqdev/chkipper/commit/b485d53
[1b355d8]: https://github.com/hiqdev/chkipper/commit/1b355d8
[d7fd56d]: https://github.com/hiqdev/chkipper/commit/d7fd56d
[12041e2]: https://github.com/hiqdev/chkipper/commit/12041e2
[9a51d73]: https://github.com/hiqdev/chkipper/commit/9a51d73
[56ef180]: https://github.com/hiqdev/chkipper/commit/56ef180
[fa2a8b0]: https://github.com/hiqdev/chkipper/commit/fa2a8b0
[3aa4129]: https://github.com/hiqdev/chkipper/commit/3aa4129
[a223ca8]: https://github.com/hiqdev/chkipper/commit/a223ca8
[db0185b]: https://github.com/hiqdev/chkipper/commit/db0185b
[320c48a]: https://github.com/hiqdev/chkipper/commit/320c48a
[fd4dcf5]: https://github.com/hiqdev/chkipper/commit/fd4dcf5
[50b23ff]: https://github.com/hiqdev/chkipper/commit/50b23ff
[c0ef4f7]: https://github.com/hiqdev/chkipper/commit/c0ef4f7
[f3fbcf8]: https://github.com/hiqdev/chkipper/commit/f3fbcf8
[290e3d7]: https://github.com/hiqdev/chkipper/commit/290e3d7
[a22a8ca]: https://github.com/hiqdev/chkipper/commit/a22a8ca
[d3c2dee]: https://github.com/hiqdev/chkipper/commit/d3c2dee
[173fd23]: https://github.com/hiqdev/chkipper/commit/173fd23
[6c0f4b9]: https://github.com/hiqdev/chkipper/commit/6c0f4b9
[a40061d]: https://github.com/hiqdev/chkipper/commit/a40061d
[dacee04]: https://github.com/hiqdev/chkipper/commit/dacee04
[740d749]: https://github.com/hiqdev/chkipper/commit/740d749
[c36094f]: https://github.com/hiqdev/chkipper/commit/c36094f
[0781c81]: https://github.com/hiqdev/chkipper/commit/0781c81
[a027022]: https://github.com/hiqdev/chkipper/commit/a027022
[3041e8c]: https://github.com/hiqdev/chkipper/commit/3041e8c
[1637562]: https://github.com/hiqdev/chkipper/commit/1637562
[a4da4ba]: https://github.com/hiqdev/chkipper/commit/a4da4ba
[e03f6d8]: https://github.com/hiqdev/chkipper/commit/e03f6d8
[ea103f6]: https://github.com/hiqdev/chkipper/commit/ea103f6
[6517a9e]: https://github.com/hiqdev/chkipper/commit/6517a9e
[Under development]: https://github.com/hiqdev/chkipper/compare/0.1.0...HEAD
[0.0.3]: https://github.com/hiqdev/chkipper/compare/0.0.2...0.0.3
[0.0.2]: https://github.com/hiqdev/chkipper/compare/0.0.1...0.0.2
[0.0.1]: https://github.com/hiqdev/chkipper/releases/tag/0.0.1
[9810468]: https://github.com/hiqdev/chkipper/commit/9810468
[df68a47]: https://github.com/hiqdev/chkipper/commit/df68a47
[58381ae]: https://github.com/hiqdev/chkipper/commit/58381ae
[fb0ce2a]: https://github.com/hiqdev/chkipper/commit/fb0ce2a
[b4dec1f]: https://github.com/hiqdev/chkipper/commit/b4dec1f
[1d6807e]: https://github.com/hiqdev/chkipper/commit/1d6807e
[a45280d]: https://github.com/hiqdev/chkipper/commit/a45280d
[11a3761]: https://github.com/hiqdev/chkipper/commit/11a3761
[fdef122]: https://github.com/hiqdev/chkipper/commit/fdef122
[0ca2029]: https://github.com/hiqdev/chkipper/commit/0ca2029
[824ab5b]: https://github.com/hiqdev/chkipper/commit/824ab5b
[e6d158b]: https://github.com/hiqdev/chkipper/commit/e6d158b
[ec53d7f]: https://github.com/hiqdev/chkipper/commit/ec53d7f
[a4baaba]: https://github.com/hiqdev/chkipper/commit/a4baaba
[da684aa]: https://github.com/hiqdev/chkipper/commit/da684aa
[8d38b32]: https://github.com/hiqdev/chkipper/commit/8d38b32
[a39fe61]: https://github.com/hiqdev/chkipper/commit/a39fe61
[cbd94e4]: https://github.com/hiqdev/chkipper/commit/cbd94e4
[0.1.0]: https://github.com/hiqdev/chkipper/compare/0.0.3...0.1.0
[ab688bd]: https://github.com/hiqdev/chkipper/commit/ab688bd
[b37393b]: https://github.com/hiqdev/chkipper/commit/b37393b
[f522ad0]: https://github.com/hiqdev/chkipper/commit/f522ad0
[f8ed164]: https://github.com/hiqdev/chkipper/commit/f8ed164
[0.1.1]: https://github.com/hiqdev/chkipper/compare/0.1.0...0.1.1
