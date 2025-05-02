<?php

return [
    'general' => [
        'cache' => [
            'sql' => true,
            'data' => [
                'news' => 1440, //1 day
                'download' => 10080, //1 week
                'pages' => 10080, //1 weeek
                'account' => 5, //5 minutes
                'silk' => 0, //5 minutes
                'online_counter' => 1, //1 minute
                'event_schedule' => 10080, //1 weeek
                'fortress_war' => 10080, //1 weeek
                'unique_history' => 5, //5 minutes
                'globals_history' => 5, //5 minutes
                'character' => 1440, //1 day
                'character_items' => 10080, //1 day
                'guild' => 1440, //1 day
                'ranking_player' => 60, //1 Hours
                'ranking_guild' => 60, //1 Hours
                'ranking_unique' => 60, //1 Hours
                'ranking_unique_monthly' => 60, //1 Hours
                'ranking_job' => 60, //1 Hours
                'ranking_honor' => 60, //1 Hours
                'ranking_fortress_player' => 60, //1 Hours
                'ranking_fortress_guild' => 60, //1 Hours
            ]
        ],
        'languages' => [
            'en' => [
                'name' => 'English',
                'fi' => 'gb'

            ],
            'ar' => [
                'name' => 'العربية',
                'fi' => 'sa',
            ],
            'tr' => [
                'name' => 'Türkçe',
                'fi' => 'tr',
            ],
            'de' => [
                'name' => 'Deutsch',
                'fi' => 'de',
            ],
            'zh_CN' => [
                'name' => '简体中文',
                'fi' => 'cn',
            ],
        ],
        'sliders' => [
            0 => [
                'title' => 'Example headline',
                'title_color' => '#fff',
                'desc' => 'Some representative placeholder content for the first slide of the carousel.',
                'desc_color' => '#fff',
                'image' => 'https://wallpapercave.com/wp/wp7441040.jpg',
                'btn-label' => 'Sign Up',
                'btn-url' => '#',
            ],
            1 => [
                'title' => 'Example headline',
                'title_color' => '#fff',
                'desc' => 'Some representative placeholder content for the first slide of the carousel.',
                'desc_color' => '#fff',
                'image' => 'https://wallpapercave.com/wp/wp7441040.jpg',
                'btn-label' => 'Play Now',
                'btn-url' => '#',
            ],
            2 => [
                'title' => 'Example headline',
                'title_color' => '#fff',
                'desc' => 'Some representative placeholder content for the first slide of the carousel.',
                'desc_color' => '#fff',
                'image' => 'https://wallpapercave.com/wp/wp7441040.jpg',
                'btn-label' => 'Download Now',
                'btn-url' => '#',
            ],
        ],
        'hero' => [
            'hero_background' => 'https://wallpapercave.com/wp/wp7441040.jpg',
            'hero_label_color' => '#fff',
        ],
        'news-category' => [
            'news' => '<span class="badge text-bg-warning">News</span>',
            'update' => '<span class="badge text-bg-primary">Update</span>',
            'event' => '<span class="badge text-bg-success">Event</span>',
        ],
        'footer' => [
            'general' => [
                1 => [
                    'name' => 'Home',
                    'url' => '#',
                    'image' => '',
                ],
                2 => [
                    'name' => 'Privacy Policy',
                    'url' => '#',
                    'image' => '',
                ],
                3 => [
                    'name' => 'Terms & Conditions',
                    'url' => '#',
                    'image' => '',
                ],
            ],
            'social' => [
                1 => [
                    'name' => 'Facebook',
                    'url' => 'https://www.facebook.com/',
                    'image' => '<i class="fab fa-facebook-f"></i>',
                ],
                2 => [
                    'name' => 'Discord',
                    'url' => 'https://discord.com/',
                    'image' => '<i class="fab fa-discord"></i>',
                ],
                3 => [
                    'name' => 'Youtube',
                    'url' => 'https://www.youtube.com/',
                    'image' => '<i class="fab fa-youtube"></i>',
                ],
            ],
            'backlink' => [
                1 => [
                    'name' => 'Elitepvpers',
                    'url' => 'https://www.elitepvpers.com/forum/sro-pserver-advertising/',
                    'image' => 'https://www.elitepvpers.com/images/logo.png',
                ],
                2 => [
                    'name' => 'SIlkroad4arab',
                    'url' => 'https://www.silkroad4arab.com/vb/forumdisplay.php?f=85',
                    'image' => 'https://www.silkroad4arab.com/vb/sawaweb/images/logo.png',
                ],
                3 => [
                    'name' => 'SroCave',
                    'url' => 'https://srocave.com/forum/sro-private-server-advertising.34/',
                    'image' => 'https://srocave.com/data/assets/logo/SCLogo.png',
                ],
            ],
        ],
    ],
    'widgets' => [
        'globals_history' => [
            'enable' => false,
            'limit' => 5,
        ],
        'unique_history' => [
            'enable' => false,
            'limit' => 5,
        ],
        'top_player' => [
            'enable' => false,
            'limit' => 5,
        ],
        'top_guild' => [
            'enable' => false,
            'limit' => 5,
        ],
        'discord' => [
            'enable' => true,
            'server_id' => '1004443821570019338',
            'theme' => 'dark', //dark, light
        ],
        'server_info' => [
            'enable' => true,
            'data' => [
                1 => [
                    //To changing icon https://fontawesome.com/icons
                    'icon' => '<i class="fas fa-fw fa-check"></i>',
                    'name' => 'Cap',
                    'value' => '140'
                ],
                2 => [
                    'icon' => '<i class="fa fa-fw fa-flask"></i>',
                    'name' => 'EXP & SP',
                    'value' => '1x'
                ],
                3 => [
                    'icon' => '<i class="fa fa-fw fa-users"></i>',
                    'name' => 'Party EXP',
                    'value' => '1x'
                ],
                4 => [
                    'icon' => '<i class="fa fa-fw fa-coins"></i>',
                    'name' => 'Gold',
                    'value' => '1x'
                ],
                5 => [
                    'icon' => '<i class="fa fa-fw fa-coins"></i>',
                    'name' => 'Drop',
                    'value' => '1x'
                ],
                6 => [
                    'icon' => '<i class="fa fa-fw fa-star"></i>',
                    'name' => 'Trade goods',
                    'value' => '1x'
                ],
                7 => [
                    'icon' => '<i class="fa fa-fw fa-exclamation"></i>',
                    'name' => 'HWID Limit',
                    'value' => '1'
                ],
                8 => [
                    'icon' => '<i class="fa fa-fw fa-exclamation"></i>',
                    'name' => 'IP Limit',
                    'value' => '1'
                ],
            ],
        ],
        'event_schedule' => [
            'enable' => false,
            'data' => [
                'roc' => 'Roc',
                'medusa' => 'Medusa',
                'special' => 'Special Trade',
                'fortress' => 'Fortress War',
                'selkis_neith' => 'Selket & Neith',
                'anubis_isis' => 'Anubis & Isis',
                'haroeris_seth' => 'Haroeris & Seth',
                'ctf' => 'Capture The Flag (CTF)',
                'ba_random' => 'Battle Arena (Random)',
                'ba_party' => 'Battle Arena (Party)',
                'ba_guild' => 'Battle Arena (Guild)',
                'ba_job' => 'Battle Arena (Job)',
                'survival_solo' => 'Survival (Solo)',
                'survival_party' => 'Survival (Party)',
            ],
        ],
        'fortress_war' => [
            'enable' => false,
            'data' => [
                1 => [
                    'name' => 'Jangan',
                    'icon' => 'images/sro/etc/fort_jangan.png',
                ],
                3 => [
                    'name' => 'Hotan',
                    'icon' => 'images/sro/etc/fort_hotan.png',
                ],
                4 => [
                    'name' => 'Constantinople',
                    'icon' => 'images/sro/etc/fort_constantinople.png',
                ],
                6 => [
                    'name' => 'Bandit',
                    'icon' => 'images/sro/etc/fort_bijeokdan.png',
                ],
            ],
        ],
    ],
    'ranking' => [
        'menu' => [
            'ranking_player' => [
                'enable' => true,
                'name' => 'Player Ranking',
                'icon' => 'fa fa-users',
                'route' => 'ranking.player',
            ],
            'ranking_guild' => [
                'enable' => true,
                'name' => 'Guild Ranking',
                'icon' => 'fa fa-users',
                'route' => 'ranking.guild',
            ],
            'ranking_unique' => [
                'enable' => true,
                'name' => 'Unique Ranking',
                'icon' => 'fa fa-users',
                'route' => 'ranking.unique',
            ],
            'ranking_unique-monthly' => [
                'enable' => true,
                'name' => 'Unique Ranking (Monthly)',
                'icon' => 'fa fa-users',
                'route' => 'ranking.unique-monthly',
            ],
            'ranking_job' => [
                'enable' => true,
                'name' => 'Job Ranking',
                'icon' => 'fa fa-users',
                'route' => 'ranking.job',
            ],
            'ranking-honor' => [
                'enable' => true,
                'name' => 'Honor Ranking',
                'icon' => 'fa fa-users',
                'route' => 'ranking.honor',
            ],
            'ranking-fortress-player' => [
                'enable' => true,
                'name' => 'Fortress War (Player)',
                'icon' => 'fa fa-users',
                'route' => 'ranking.fortress-player',
            ],
            'ranking-fortress-guild' => [
                'enable' => true,
                'name' => 'Fortress War (Guild)',
                'icon' => 'fa fa-users',
                'route' => 'ranking.fortress-guild',
            ],
        ],
        'job_menu' => [
            'ranking_job_all' => [
                'enable' => true,
                'name' => 'All',
                'icon' => 'fa fa-users',
                'route' => 'ranking.job-all',
            ],
            'ranking_job_hunters' => [
                'enable' => true,
                'name' => 'Hunters',
                'icon' => 'fa fa-users',
                'route' => 'ranking.job-hunter',
            ],
            'ranking_job_thieves' => [
                'enable' => true,
                'name' => 'Thieves',
                'icon' => 'fa fa-users',
                'route' => 'ranking.job-thieve',
            ],
            'ranking_job_traders' => [
                'enable' => true,
                'name' => 'Traders',
                'icon' => 'fa fa-users',
                'route' => 'ranking.job-trader',
            ],
        ],
        'hidden_characters' => [
            '[GM]Eva',
            '[GM]m1xawy',
        ],
        'hidden_guilds' => [
            'RigidStaff',
        ],
        'top_icons' => [
            1 => 'images/rank1.png',
            2 => 'images/rank2.png',
            3 => 'images/rank3.png',
        ],
        'unique_icons' => [
            1 => 'images/tw_icon_unique.png',
        ],
        'unique_points' => [
            'MOB_CH_TIGERWOMAN' => [
                'id' => 1954,
                'name' => 'Tiger Girl',
                'points' => 1
            ],
            'MOB_OA_URUCHI' => [
                'id' => 1982,
                'name' => 'Uruchi',
                'points' => 2
            ],
            'MOB_KK_ISYUTARU' => [
                'id' => 2002,
                'name' => 'Isyutaru',
                'points' => 3
            ],
            'MOB_TK_BONELORD' => [
                'id' => 3810,
                'name' => 'Lord Yarkan',
                'points' => 4
            ],
            'MOB_RM_TAHOMET' => [
                'id' => 3875,
                'name' => 'Demon Shaitan',
                'points' => 5
            ],
            'MOB_AM_IVY' => [
                'id' => 14778,
                'name' => 'Captain Ivy',
                'points' => 2
            ],
            'MOB_EU_KERBEROS' => [
                'id' => 5871,
                'name' => 'Cerberus',
                'points' => 1
            ],
            'MOB_RM_ROC' => [
                'id' => 3877,
                'name' => 'Roc',
                'points' => 15
            ],
            'MOB_TQ_WHITESNAKE' => [
                'id' => 14839,
                'name' => 'Medusa',
                'points' => 10
            ],
        ],
        'hwan_titles' => [
            'CH' => [
                1 => 'Captain',
                2 => 'General',
                3 => 'Senior General',
                4 => 'Chief General',
                5 => 'Vice Lord',
                6 => 'General Lord',
            ],
            'EU' => [
                1 => 'Knight',
                2 => 'Baronet',
                3 => 'Baron',
                4 => 'Count',
                5 => 'Marquis',
                6 => 'Duke',
            ],
        ],
        'skill_mastery' => [
            257 => [
                "name" => "Blade",
                "icon" => "images/sro/skillmastery/china/mastery_sword.png"
            ],
            258 => [
                "name" => "Glavie",
                "icon" => "images/sro/skillmastery/china/mastery_spear.png"
            ],
            259 => [
                "name" => "Bow",
                "icon" => "images/sro/skillmastery/china/mastery_bow.png"
            ],
            273 => [
                "name" => "Cold",
                "icon" => "images/sro/skillmastery/china/mastery_cold.png"
            ],
            274 => [
                "name" => "Lightning",
                "icon" => "images/sro/skillmastery/china/mastery_lightning.png"
            ],
            275 => [
                "name" => "Fire",
                "icon" => "images/sro/skillmastery/china/mastery_fire.png"
            ],
            276 => [
                "name" => "Force",
                "icon" => "images/sro/skillmastery/china/mastery_gigong.png"
            ],
            277 => [
                "name" => "Recovery",
                "icon" => "images/sro/skillmastery/china/mastery_water.png"
            ],
            513 => [
                "name" => "Warrior",
                "icon" => "images/sro/skillmastery/europe/eu_warrior.png"
            ],
            514 => [
                "name" => "Wizard",
                "icon" => "images/sro/skillmastery/europe/eu_wizard.png"
            ],
            515 => [
                "name" => "Rogue",
                "icon" => "images/sro/skillmastery/europe/eu_rog.png"
            ],
            516 => [
                "name" => "Warlock",
                "icon" => "images/sro/skillmastery/europe/eu_warlock.png"
            ],
            517 => [
                "name" => "Bard",
                "icon" => "images/sro/skillmastery/europe/eu_bard.png"
            ],
            518 => [
                "name" => "Cleric",
                "icon" => "images/sro/skillmastery/europe/eu_cleric.png"
            ],
        ],
        'honor_level' => [
            1 => 'images/com_honor_level_1.png',
            2 => 'images/com_honor_level_2.png',
            3 => 'images/com_honor_level_3.png',
            4 => 'images/com_honor_level_4.png',
            5 => 'images/com_honor_level_5.png',
        ],
        'job_type_icons' => [
            1 => [
                'name' => 'Hunter',
                'small_icon' => 'images/com_job_hunter.png',
                'icon' => 'images/job_hunter_icon.png',
            ],
            2 => [
                'name' => 'Thief',
                'small_icon' => 'images/com_job_thief.png',
                'icon' => 'images/job_teaf_icon.png',
            ],
            3 => [
                'name' => 'Trader',
                'small_icon' => 'images/com_job_merchant.png',
                'icon' => 'images/job_trader_icon.png',
            ],
        ],
        'vip_level' => [
            "level_access" => 4,
            "level" => [
                0 => [
                    'name' => "Normal",
                    'icon' => "",
                ],
                1 => [
                    'name' => "Iron",
                    'icon' => "images/viplevel_1.jpg",
                ],
                2 => [
                    'name' => "Bronze",
                    'icon' => "images/viplevel_2.jpg",
                ],
                3 => [
                    'name' => "Silver",
                    'icon' => "images/viplevel_3.jpg",
                ],
                4 => [
                    'name' => "Gold",
                    'icon' => "images/viplevel_4.jpg",
                ],
                5 => [
                    'name' => "Platinum",
                    'icon' => "images/viplevel_5.jpg",
                ],
                6 => [
                    'name' => "VIP",
                    'icon' => "images/viplevel_6.jpg",
                ],
            ],
            "type" => [
                0 => "General",
                1 => "VIP",
                2 => "New",
                3 => "Returne",
                4 => "Free"
            ]
        ],
        'guild_authority' => [
            1 => 'Leader',
            2 => 'Deputy Commander',
            4 => 'Fortress War Administrator',
            8 => 'Production Administrator',
            16 => 'Training Administrator',
            32 => 'Military Engineer',
        ],
        'race' => [
            0 => [
                'name' => 'Chinese',
                'icon' => 'images/com_kindred_china.png',
            ],
            1 => [
                'name' => 'Europe',
                'icon' => 'images/com_kindred_europe.png',
            ],
        ],
        'character_image' => [
            1907 => "images/character/char_ch_man1.png",
            1908 => "images/character/char_ch_man2.png",
            1909 => "images/character/char_ch_man3.png",
            1910 => "images/character/char_ch_man4.png",
            1911 => "images/character/char_ch_man5.png",
            1912 => "images/character/char_ch_man6.png",
            1913 => "images/character/char_ch_man7.png",
            1914 => "images/character/char_ch_man8.png",
            1915 => "images/character/char_ch_man9.png",
            1916 => "images/character/char_ch_man10.png",
            1917 => "images/character/char_ch_man11.png",
            1918 => "images/character/char_ch_man12.png",
            1919 => "images/character/char_ch_man13.png",

            1920 => "images/character/char_ch_woman1.png",
            1921 => "images/character/char_ch_woman2.png",
            1922 => "images/character/char_ch_woman3.png",
            1923 => "images/character/char_ch_woman4.png",
            1924 => "images/character/char_ch_woman5.png",
            1925 => "images/character/char_ch_woman6.png",
            1926 => "images/character/char_ch_woman7.png",
            1927 => "images/character/char_ch_woman8.png",
            1928 => "images/character/char_ch_woman9.png",
            1929 => "images/character/char_ch_woman10.png",
            1930 => "images/character/char_ch_woman11.png",
            1931 => "images/character/char_ch_woman12.png",
            1932 => "images/character/char_ch_woman13.png",

            14717 => "images/character/char_eu_man1.png",
            14718 => "images/character/char_eu_man2.png",
            14719 => "images/character/char_eu_man3.png",
            14720 => "images/character/char_eu_man4.png",
            14721 => "images/character/char_eu_man5.png",
            14722 => "images/character/char_eu_man6.png",
            14723 => "images/character/char_eu_man7.png",
            14724 => "images/character/char_eu_man8.png",
            14725 => "images/character/char_eu_man9.png",
            14726 => "images/character/char_eu_man10.png",
            14727 => "images/character/char_eu_man11.png",
            14728 => "images/character/char_eu_man12.png",
            14729 => "images/character/char_eu_man13.png",

            14730 => "images/character/char_eu_woman1.png",
            14731 => "images/character/char_eu_woman2.png",
            14732 => "images/character/char_eu_woman3.png",
            14733 => "images/character/char_eu_woman4.png",
            14734 => "images/character/char_eu_woman5.png",
            14735 => "images/character/char_eu_woman6.png",
            14736 => "images/character/char_eu_woman7.png",
            14737 => "images/character/char_eu_woman8.png",
            14738 => "images/character/char_eu_woman9.png",
            14739 => "images/character/char_eu_woman10.png",
            14740 => "images/character/char_eu_woman11.png",
            14741 => "images/character/char_eu_woman12.png",
            14742 => "images/character/char_eu_woman13.png",
        ],
    ],
    'item' => [
        'slots' => [
            0 => 'helm',
            1 => 'chest' ,
            2 => 'shoulders',
            3 => 'gauntlet',
            4 => 'pants',
            5 => 'boots',
            6 => 'weapon',
            7 => 'shield',
            8 => 'job',
            9 => 'earring',
            10 => 'necklace',
            11 => 'lring',
            12 => 'rring',
        ],
        'sox_type' => [
            3 => 'Seal of Heavy Storm',
            2 => 'Seal of Star',
            1 => 'Seal of Moon',
            0 => 'Seal of Sun'
        ],
        'rare_name' => [
            'SET_A_RARE' => [
                0 => 'Destruction',
                1 => 'Destruction',
                2 => 'Destruction',
                3 => 'Destruction',
                4 => 'Destruction',
                5 => 'Destruction',
                6 => 'Power',
                7 => 'Protection',
                9 => 'Myth',
                10 => 'Myth',
                11 => 'Myth',
                12 => 'Myth',
            ],
            'SET_B_RARE' => [
                0 => 'Immortality',
                1 => 'Immortality',
                2 => 'Immortality',
                3 => 'Immortality',
                4 => 'Immortality',
                5 => 'Immortality',
                6 => 'Fight',
                7 => 'Guard',
                9 => 'Legend',
                10 => 'Legend',
                11 => 'Legend',
                12 => 'Legend',
            ],
        ],
        'sex' => [
            0 => 'Female',
            1 => 'Male',
        ],
        'country' => [
            0 => 'Chinese',
            1 => 'Europe',
        ],
        'race' => [
            'CH' => 'Chinese',
            'EU' => 'European',
        ],
        'cloth_detail' => [
            'FA' => 'Foot',
            'HA' => 'Head',
            'CA' => 'Head',
            'SA' => 'Shoulder',
            'BA' => 'Chest',
            'LA' => 'Legs',
            'AA' => 'Hands'
        ],
        'cloth_type' => [
            'CH' => [
                'CLOTHES' => 'Garment',
                'HEAVY' => 'Armor',
                'LIGHT' => 'Protector'
            ],
            'EU' => [
                'CLOTHES' => 'Robe',
                'HEAVY' => 'Heavy armor',
                'LIGHT' => 'Light armor'
            ]
        ],
        'weapon_type' => [
            'CH' => [
                'TBLADE' => 'Glavie',
                'SPEAR' => 'Spear',
                'SWORD' => 'Sword',
                'BLADE' => 'Blade',
                'BOW' => 'Bow',
                'SHIELD' => 'Shield'
            ],
            'EU' => [
                'AXE' => 'Dual axe',
                'CROSSBOW' => 'Crossbow',
                'DAGGER' => 'Dagger',
                'DARKSTAFF' => 'Dark staff',
                'HARP' => 'Harp',
                'SHIELD' => 'Shield',
                'STAFF' => 'Light staff',
                'SWORD' => 'Onehand sword',
                'TSTAFF' => 'Twohand staff',
                'TSWORD' => 'Twohand sword'
            ]
        ],
        'avatar_type' => [
            0 => 'Avatar Flag',
            1 => 'Avatar Attach',
            2 => 'Avatar Hat',
            4 => 'Avatar Dress',
            9 => 'Devil spirit\'s'
        ],
        'job_detail' => [
            0 => 'Head',
            1 => 'Chest',
            2 => 'Shoulder',
            3 => 'Hands',
            4 => 'Legs',
            5 => 'Foot',
        ],
        'job_degree' => [
            1 => 'Lowest Quality',
            2 => 'Low Quality',
            3 => 'Medium Quality',
        ],
        'job_type' => [
            2 => [
                1 => 'Hunter Equipment (weapon)',
            ],
            1 => [
                1 => 'Hunter Equipment (head)',
                2 => 'Hunter Equipment (shoulder)',
                3 => 'Hunter Equipment (tunic)',
                4 => 'Hunter Equipment (pants)',
                5 => 'Hunter Equipment (gloves)',
                6 => 'Hunter Equipment (shoes)',
            ],
            3 => [
                1 => 'Hunter Equipment (earrging)',
                2 => 'Hunter Equipment (necklace)',
                3 => 'Hunter Equipment (ring)',
            ],
            5 => [
                1 => 'Thief Equipment (weapon)',
            ],
            4 => [
                1 => 'Thief Equipment (head)',
                2 => 'Thief Equipment (shoulder)',
                3 => 'Thief Equipment (tunic)',
                4 => 'Thief Equipment (pants)',
                5 => 'Thief Equipment (gloves)',
                6 => 'Thief Equipment (shoes)',
            ],
            6 => [
                1 => 'Thief Equipment (earrging)',
                2 => 'Thief Equipment (necklace)',
                3 => 'Thief Equipment (ring)',
            ],
        ],
    ],
];
