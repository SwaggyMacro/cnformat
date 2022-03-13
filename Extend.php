<?php

namespace swaggymacro\cnformat;

use Flarum\Extend;
use s9e\TextFormatter\Configurator;
die();
return [
    (new Extend\Formatter)
        ->configure(function (Configurator $config) {
             $config->MediaEmbed->add(
                'bilibili',
                [
                    'host'    => ['bilibili.com',],
                    'extract' => [
                        "!www\.bilibili\.com/video/(BV(?'bvid'[-0-9A-Z_a-z]+))(\?p=(?'pn'[-0-9]+))?!"
                    ],
                    'iframe' => [
                        'src'  => '//player.bilibili.com/player.html?bvid={@bvid}&page={@pn}'
                    ]
                ]
            );
        })
];