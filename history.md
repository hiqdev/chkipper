hiqdev/chkipper commits history
-------------------------------

## [0.0.2] - 2016-11-28

- Added showing notices when files were changed
    - [a027022] 2016-11-28 used default yii console Application [sol@hiqdev.com]
    - [740d749] 2016-11-28 added showing notices when files were changed [sol@hiqdev.com]
    - [3041e8c] 2016-11-28 removed roadmap, moved to basic description [sol@hiqdev.com]
    - [c36094f] 2016-10-17 csfixed [sol@hiqdev.com]
    - [0781c81] 2016-10-15 added ROADMAP.md [sol@hiqdev.com]

## [0.0.1] - 2016-08-01

- Added `release-notes` command
    - [dacee04] 2016-07-31 csfixed [sol@hiqdev.com]
    - [a40061d] 2016-07-31 added `prependNotes` for history merging [sol@hiqdev.com]
    - [d3c2dee] 2016-07-31 + ConvertController [sol@hiqdev.com]
    - [173fd23] 2016-07-31 added `release-notes` command [sol@hiqdev.com]
    - [6c0f4b9] 2016-07-31 added NotesRenderer [sol@hiqdev.com]
- Added version bumping
    - [a22a8ca] 2016-07-30 improved package description [sol@hiqdev.com]
    - [50b23ff] 2016-07-30 + proper bumping to `dev` version [sol@hiqdev.com]
    - [12041e2] 2016-07-02 added project property to History [sol@hiqdev.com]
    - [d7fd56d] 2016-07-02 + remove commit links that are not in the history [sol@hiqdev.com]
    - [1c6c639] 2016-07-02 added bump to version [sol@hiqdev.com]
    - [d4c4221] 2016-07-02 added normalization functions [sol@hiqdev.com]
    - [b485d53] 2016-07-02 + removing functions [sol@hiqdev.com]
- Added better history normalizing
    - [c0ef4f7] 2016-07-30 improved setTagDates normalizer [sol@hiqdev.com]
    - [f3fbcf8] 2016-07-30 + Tag::unsetDate [sol@hiqdev.com]
    - [290e3d7] 2016-07-30 fixed setTagDates normalizer [sol@hiqdev.com]
    - [fd4dcf5] 2016-07-30 fixed setTagDates normalizer [sol@hiqdev.com]
    - [db0185b] 2016-07-29 + setTagDates normalization [sol@hiqdev.com]
    - [320c48a] 2016-07-29 + Tag::findDate method [sol@hiqdev.com]
    - [a223ca8] 2016-07-24 normalization moved to History class [sol@hiqdev.com]
    - [56ef180] 2016-07-23 fixed tests [sol@hiqdev.com]
    - [fa2a8b0] 2016-07-23 + adding initial tag at normalizing [sol@hiqdev.com]
    - [3aa4129] 2016-07-23 mino [sol@hiqdev.com]
    - [9a51d73] 2016-07-03 csfixed [sol@hiqdev.com]
- Added CHANGELOG rendering
    - [1b355d8] 2016-06-26 added Markdown changelog renderer [sol@hiqdev.com]
- Added basics
    - [39173f4] 2016-06-25 fixed GitLogParserTest [sol@hiqdev.com]
    - [c1ac45f] 2016-06-21 moved skipCommit to Builder [sol@hiqdev.com]
    - [e512ebb] 2016-06-21 fixed parsing commit subject [sol@hiqdev.com]
    - [0af4883] 2016-06-21 added remove commits at note [sol@hiqdev.com]
    - [e3c73a5] 2016-06-21 better tag parsing [sol@hiqdev.com]
    - [65f78d8] 2016-06-21 added `bump/parse` action [sol@hiqdev.com]
    - [b4af2db] 2016-06-21 testing format [sol@hiqdev.com]
    - [8867abe] 2016-06-20 added links generation [sol@hiqdev.com]
    - [8744322] 2016-06-20 generated the `history.md` for the first time [sol@hiqdev.com]
    - [9e5ffcb] 2016-06-19 added history merging [sol@hiqdev.com]
    - [4dab065] 2016-06-19 csfixed [sol@hiqdev.com]
    - [d478762] 2016-06-19 finished and tested git log parser [sol@hiqdev.com]
    - [59f3c32] 2016-06-19 csfixed [sol@hiqdev.com]
    - [246322f] 2016-06-19 refactored out AbstractParser/renderer, Markdown/GitLogParser [sol@hiqdev.com]
    - [958f2a2] 2016-06-19 parsing git log looks good [sol@hiqdev.com]
    - [8088237] 2016-06-18 refactoring [sol@hiqdev.com]
    - [3862ca1] 2016-06-18 refactored [sol@hiqdev.com]
    - [953e3e9] 2016-06-18 adding GitMerger [sol@hiqdev.com]
    - [21ce070] 2016-06-18 + config component [sol@hiqdev.com]
    - [ebe319b] 2016-06-17 removed old from History [sol@hiqdev.com]
    - [cabe759] 2016-06-17 added initial history [sol@hiqdev.com]
    - [64a1aef] 2016-06-17 fixed setHeaders() [sol@hiqdev.com]
    - [13f9c8d] 2016-06-17 csfixed [sol@hiqdev.com]
    - [dc889ee] 2016-06-17 renderer looks good [sol@hiqdev.com]
    - [0ea21ad] 2016-06-17 parser tested ok [sol@hiqdev.com]
    - [b67662c] 2016-06-17 starting Renderer [sol@hiqdev.com]
    - [e856219] 2016-06-17 splitted Builder and Parser [sol@hiqdev.com]
    - [990f07f] 2016-06-17 testing format [sol@hiqdev.com]
    - [035d8e3] 2016-06-17 testing commits file format [sol@hiqdev.com]
    - [ae01358] 2016-06-14 added basics and minimal test [sol@hiqdev.com]
    - [494229b] 2016-06-11 still initing [sol@hiqdev.com]
    - [2d5de51] 2016-06-11 fixed requirements [sol@hiqdev.com]
    - [6cee114] 2016-06-11 initing [sol@hiqdev.com]
    - [b22f8ac] 2016-06-11 inited [@hiqsol]
        - longer description for initial commit

## [Development started] - 2016-06-11

[Under development]: https://github.com/hiqdev/chkipper/releases
[Development started]: https://github.com/hiqdev/chkipper/releases
[sol@hiqdev.com]: https://github.com/hiqsol
[@hiqsol]: https://github.com/hiqsol
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
