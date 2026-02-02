<?php

return [
    'xtremetop100' => [
        'enabled' => true, //Postback url: https://localhost/postback/xtremetop100
        'name' => 'XtremeTop100',
        'route' => 'xtremetop100',
        'image' => 'https://www.xtremetop100.com/votenew.jpg',
        'url' => 'https://www.xtremetop100.com/in.php?site=SERVER_ID&postback={JID}',
        'ip' => '137.74.41.178, 2001:41d0:305:2100::413b, ::1',
        'reward' => 5,
        'timeout' => 12,
    ],
    'gtop100' => [
        'enabled' => true, //Postback url: https://localhost/postback/gtop100
        'name' => 'GTop100',
        'route' => 'gtop100',
        'image' => 'https://gtop100.com/images/votebutton.jpg',
        'url' => 'https://gtop100.com/Silkroad-Online/SERVER_ID?vote=1&pingUsername={JID}',
        'ip' => '213.233.110.198, 213.233.110.199',
        'reward' => 5,
        'timeout' => 12,
    ],
    'topg' => [
        'enabled' => true, //Postback url: https://localhost/postback/topg
        'name' => 'TopG',
        'route' => 'topg',
        'image' => 'https://topg.org/topg.gif',
        'url' => 'https://topg.org/silkroad-private-servers/in-SERVER_ID-{JID}',
        'ip' => '54.36.225.177',
        'reward' => 5,
        'timeout' => 12,
    ],
    'top100arena' => [
        'enabled' => true, //Postback url: https://localhost/postback/top100arena
        'name' => 'Top100 Arena',
        'route' => 'top100arena',
        'image' => 'https://www.top100arena.com/hit/101410/medium',
        'url' => 'https://www.top100arena.com/listing/SERVER_ID/vote?incentive={JID}',
        'ip' => '3.86.48.116',
        'reward' => 5,
        'timeout' => 12,
    ],
    'arenatop100' => [
        'enabled' => true, //Postback url: https://localhost/postback/arenatop100
        'name' => 'Arena Top100',
        'route' => 'arenatop100',
        'image' => 'https://www.arena-top100.com/images/vote/silkroad-private-servers.png',
        'url' => 'https://www.arena-top100.com/index.php?a=in&u=SERVER_ID&id={JID}',
        'ip' => '184.154.46.76',
        'reward' => 5,
        'timeout' => 12,
    ],
    'silkroadservers' => [
        'enabled' => true, //Postback url: https://localhost/postback/silkroadservers
        'name' => 'Silkroad Servers',
        'route' => 'silkroadservers',
        'image' => 'https://silkroad-servers.com/images/button.png',
        'url' => 'https://silkroad-servers.com/index.php?a=in&u=SERVER_ID&id={JID}',
        'ip' => '116.203.217.217',
        'reward' => 5,
        'timeout' => 12,
    ],
    'privateserver' => [
        'enabled' => true, //Postback url: https://localhost/postback/privateserver
        'name' => 'Private Servers',
        'route' => 'privateserver',
        'image' => 'https://private-server.ws/images/vote_button.jpg',
        'url' => 'https://private-server.ws/index.php?a=in&u=SERVER_ID&id={JID}',
        'ip' => '116.203.234.215',
        'reward' => 5,
        'timeout' => 12,
    ],
    'vote4rewards' => [
        'enabled' => true, //Postback url: https://localhost/postback/vote4rewards
        'name' => 'Vote4Rewards',
        'route' => 'vote4rewards',
        'image' => 'https://vote4rewards.de/vote4rewards_small_banner.png',
        'webhook_secret' => '0EKA5t4XD0vGrNCnkNzFZULVVm3ighm0', // example: Q7A9DA2xVdkL3rP0B8mNfH5S3LJcWgUy
        'url' => 'https://vote4rewards.de/vote/<Server UUID FROM vote4rewards>?rewarder={JID}', // example: https://vote4rewards.de/vote/fc5296a9-814d-406b-aeba-68d83ff414bb?rewarder={JID}
        'ip' => '91.98.130.153',
        'reward' => 2,
        'timeout' => 6,
    ],
];
