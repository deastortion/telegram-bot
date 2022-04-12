<?php

require_once './config/app.php';
require_once './helpers/print_html.php';
require_once './helpers/send_request.php';

# Receive the request from Telegram Webhook
$request = json_decode(file_get_contents('php://input'), true);

# Store the incoming request data into a file, so we can open and see all the structure
file_put_contents('log.txt', '$data: ' . print_r($request, true) . '\n');


# Process the data coming from request (button tap / message / command)
$data = $request['callback_query'] ? $request['callback_query'] : $request['message'];

# Process the message / make it lowercase
$message = mb_strtolower(($data['text'] ? $data['text'] : $data['data']), 'UTF-8');


# Get the chat_id from sender
$chat_id = $data['chat']['id'];

# Send a proper response for user's request
switch ($message) {
    case '/hello':
        sendRequest('sendMessage', [
            'chat_id' => $chat_id,
            'text' => 'Hi!',
        ]);
        break;

    case '/start':
        sendRequest('sendMessage', [
            'chat_id' => $chat_id,
            'text' => 'Alright! Let\'s get started!',
            'reply_markup' => json_encode([
                'resize_keyboard' => true,
                'one_time_keyboard' => false,
                'keyboard' => [
                    [
                        [
                            'text' => '🧾 Clubs',
                        ],
                    ],
                    [
                        [
                            'text' => '⚙️ Settings',
                        ],
                    ],
                    [
                        [
                            'text' => '✍🏻 Feedback',
                        ],
                    ],
                ],
            ]),
        ]);

        break;

    case '🧾 clubs':
        sendRequest('sendMessage', [
            'chat_id' => $chat_id,
            'text' => 'Okay, here is the list of our clubs',
            'reply_markup' => json_encode([
                'resize_keyboard' => true,
                'one_time_keyboard' => false,
                'keyboard' => [
                    [
                        [
                            'text' => '🏀 Basketball',
                        ],
                        [
                            'text' => '⚽️ Football',
                        ],

                    ],
                    [
                        [
                            'text' => '🎧 Cybersports',
                        ],
                        [
                            'text' => '👨‍🎨 Graphic Designers',
                        ],
                    ],
                    [
                        [
                            'text' => '❓ WWW',
                        ],
                        [
                            'text' => '🐲 D&D',
                        ],
                    ],
                    [
                        [
                            'text' => '📓 Creative Writing',
                        ],
                        [
                            'text' => '⌨️ Basic Skills',
                        ],
                    ],
                    [
                        [
                            'text' => '🇨🇳 Chinese',
                        ],
                        [
                            'text' => '🇫🇷 French',
                        ],

                    ],
                    [
                        [
                            'text' => '👯 Anime',
                        ],
                        [
                            'text' => '💃 Dance',
                        ],
                    ],
                    [],
                    [
                        [
                            'text' => '🗣 Public Speaking',
                        ],
                        [
                            'text' => '🙎‍♀️ Women\'s Society',
                        ],
                    ],
                    [
                        [
                            'text' => '⬅️ Back',
                        ]
                    ]
                ],
            ]),
        ]);
        break;

    case '📓 creative writing':
        sendRequest('sendPhoto', [
            'chat_id' => $chat_id,
            'photo' => 'https://images.squarespace-cdn.com/content/v1/58f883b420099e4ee8f08c62/1605192440644-P73NJQL6RYJU3X88FF57/https___cdn.evbuc.com_images_117378807_46763971293_1_original.jpg?format=1000w',
            'caption' => "Creative Writing Club\n\nCreative Writing Club is a place for aspiring writers and poets to express themselves, communicate, and have fun practicing storytelling together! However, you don't have to be a writer to join! This club is all about the freedom of self-expression and unleashing your creativity! \n\nCreative Writing has no rules, limits, or obligations. It is never met with judgment, and it always comes from the heart.\n\nWhy Creative Writing?\n Everyone has a story to tell (lots of them actually), the question is: \"do you have the courage to bring forth the treasures that are hidden within you?\" By telling yours, you're bringing so much good into this world! You just have to believe that!\n\nFor this club you are going to have:\n- fun games and activities;\n- discussions;\n- storytelling tutorials;\n- guest speakers;\n- workshops;\n- practice sessions;\n- poetry/writing competitions;\n- informal hanging out days\nAnd more!",
        ]);
        break;

    case '⬅️ back':


        sendRequest('sendMessage', [
            'chat_id' => $chat_id,
            'text' => 'Alright! Got back to main menu!',
            'reply_markup' => json_encode([
                'resize_keyboard' => true,
                'one_time_keyboard' => false,
                'keyboard' => [
                    [
                        [
                            'text' => '🧾 Clubs',
                        ],
                    ],
                    [
                        [
                            'text' => '⚙️ Settings',
                        ],
                    ],
                    [
                        [
                            'text' => '✍🏻 Feedback',
                        ],
                    ],
                ],
            ]),
        ]);
        break;

    default:
        # Respond to non-existing command / message
        sendRequest('sendMessage', [
            'chat_id' => $chat_id,
            'text' => 'Sorry, I didn\'t get it',
        ]);
        break;
}
