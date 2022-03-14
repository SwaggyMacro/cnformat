<?php

/*
 * This file is part of swaggymacro/cnformat.
 *
 * Copyright (c) 2022 SwaggyMacro.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SwaggyMacro\CNFormat;

use Flarum\Extend;
use s9e\TextFormatter\Configurator;



return [ 
  (new Extend\Frontend('forum'))
  ->css(__DIR__.'/less/forum.less'),
    (new Extend\Formatter)
    ->configure(function (Configurator $config) {
        $config->BBCodes->addCustom(
           '[iframe={URL}]',
           '<div class="iframe" style="--aspect-ratio: 16/9;">
           <iframe 
             src="{URL}"
             width="1600"
             height="900"
             frameborder="0"
           >
           </iframe>
         </div>'
        );
        $config->MediaEmbed->add(
				'bilibili',
				[
					'host'	  => ['bilibili.com',],
					'extract' => [
						"!bilibili\.com/video(/av(?'aid'[-0-9]+))|(/BV(?'bvid'[-0-9A-Z_a-z]+))(\?p=(?'pn'[-0-9]+))?!",
					],
					'iframe' => [
						'src'  => '//player.bilibili.com/player.html?aid={@aid}&bvid={@bvid}&page={@pn}'
					]
				]
		);
		$config->MediaEmbed->add(
                'qq',
                [
                    'host'    => 'qq.com',
                    'extract' => [
                        "!qq\\.com/x/cover/\\w+/(?'id'\\w+)\\.html!",
                        "!qq\\.com/x/cover/\\w+\\.html\\?vid=(?'id'\\w+)!",
                        "!qq\\.com/cover/[^/]+/\\w+/(?'id'\\w+)\\.html!",
                        "!qq\\.com/cover/[^/]+/\\w+\\.html\\?vid=(?'id'\\w+)!",
                        "!qq\\.com/x/page/(?'id'\\w+)\\.html!",
                        "!qq\\.com/page/[^/]+/[^/]+/[^/]+/(?'id'\\w+)\\.html!"
                    ],
                    'iframe'  => [
                        'width'  => 760,
                        'height' => 450,
                        'src'    => '//v.qq.com/txp/iframe/player.html?vid={@id}&tiny=0&auto=0'
                    ]
                ]
        );
        $config->MediaEmbed->add(
                'weibo',
                [
                    'host'    => ['weibo.com','video.weibo.com',],
                    'extract' => [
                        "!video\\.weibo\\.com/show\\?fid=(?'fid'\d+:\d+)!",
                    ],
                    'iframe'  => [
                        'width'  => 760,
                        'src'    => '//h5.video.weibo.com/show/{@fid}'
                    ]
                ]
        );
        $config->MediaEmbed->add(
                'weibopost',
                [
                    'host'    => ['weibo.com','m.weibo.cn',],
                    'extract' => [
                        "!m\\.weibo\\.cn/[\s\S]*/(?'postid'\d+)!",
                        "!weibo\\.com/[\s\S]*/(?'postid'[\s\S])*!",
                    ],
                    'iframe'  => [
                        'width'  => 760,
                        'height' => 760,
                        'scrolling' => 'yes',
                        'src'    => '//m.weibo.cn/status/{@postid}'
                    ]
                ]
        );
        $config->MediaEmbed->add(
				'acfun',
				[
					'host'	  => 'acfun.cn',
					'extract' => "!acfun\.cn/v/ac(?'acid'[-0-9]+)!",
					'iframe' => [
						'src'  => '//www.acfun.cn/player/ac{@acid}'
					]
				]
		);
		$config->MediaEmbed->add(
                'huya',
                [
                    'host'    => ['www.huya.com', 'huya.com',],
                    'extract' => [
                       "!huya\\.com/(?'hid'[\s\S]*)!",
                    ],
                    'iframe'  => [
                        'width'  => 760,
                        'height' => 450,
                        'src'    => '//liveshare.huya.com/iframe/{@hid}'
                    ]
                ]
        );
        $config->MediaEmbed->add(
                'music163',
                [
                    'host'    => 'music.163.com',
                    'extract' => '!music\\.163\\.com/(#/)?(?\'mode\'song|album|playlist)((\\?id=)|(\\/))(?\'id\'\\d+)!',
                    'choose'  => [
                        'when' => [
                            [
                                'test' => '@mode = \'album\'',
                                'iframe'  => [
                                    'src'    => '//music.163.com/outchain/player?type=1&id={@id}&auto=0&height=450'
                                ]
                            ],
                            [
                                'test' => '@mode = \'song\'',
                                'iframe'  => [
                                    'height' => 155,
                                    'src'    => '//music.163.com/outchain/player?type=2&id={@id}&auto=0&height=66'
                                ]
                            ]
                        ],
                        'otherwise' => [
                            'iframe'  => [
                                'src'    => '//music.163.com/outchain/player?type=0&id={@id}&auto=0&height=450'
                            ]
                        ]
                    ]
                ]
        );
    })
];