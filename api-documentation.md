FORMAT: 1A

# API

# Login [/login]

## Tutor Login with Google [POST /login/google/tutor]
Login user with a google code.
Token is returned which will be required in every request

+ Request (application/json)
    + Body

            {
                "code": "4/7zE1BAw89p1hyBuVS1NCMjMVIVfHD81VIPo0PdFhpTU"
            }

+ Response 200 (application/json)
    + Body

            {
                "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2dhbmdzdGVyLXN0cmVuZ3RoLmxvY2FsXC9hcGlcL3VzZXJzXC9yZWdpc3RlciIsImlhdCI6MTQ5MTIwNDU4MSwiZXhwIjoxNDkxMjA4MTgxLCJuYmYiOjE0OTEyMDQ1ODEsImp0aSI6ImZiMzAxMzI1YzgyMmRiMzkxMzhmOTkzMjc0MDQ5NTk1In0.L2PcdY3kuUdakNzgWirglwuJqCTtdLa-uHaAfL5OZqA",
                "user": {
                    "email": "user2@mailinator.com",
                    "created_at": "2017-04-03 07:29:40",
                    "id": 2
                }
            }

+ Response 401 (application/json)
    + Body

            {
                "error": "invalid_credentials",
                "message": "Invalid credentials",
                "status_code": 401
            }

+ Response 401 (application/json)
    + Body

            {
                "error": "user_blocked",
                "message": "Your Account has been blocked.",
                "status_code": 401
            }

+ Response 500 (application/json)
    + Body

            {
                "error": "could_not_create_token",
                "message": "Internal Server Error",
                "status_code": 500
            }

## Student Login with Google [POST /login/google/student]
Login user with a google code.
Token is returned which will be required in every request

+ Request (application/json)
    + Body

            {
                "code": "4/7zE1BAw89p1hyBuVS1NCMjMVIVfHD81VIPo0PdFhpTU"
            }

+ Response 200 (application/json)
    + Body

            {
                "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2dhbmdzdGVyLXN0cmVuZ3RoLmxvY2FsXC9hcGlcL3VzZXJzXC9yZWdpc3RlciIsImlhdCI6MTQ5MTIwNDU4MSwiZXhwIjoxNDkxMjA4MTgxLCJuYmYiOjE0OTEyMDQ1ODEsImp0aSI6ImZiMzAxMzI1YzgyMmRiMzkxMzhmOTkzMjc0MDQ5NTk1In0.L2PcdY3kuUdakNzgWirglwuJqCTtdLa-uHaAfL5OZqA",
                "user": {
                    "email": "user2@mailinator.com",
                    "created_at": "2017-04-03 07:29:40",
                    "id": 2
                }
            }

+ Response 401 (application/json)
    + Body

            {
                "error": "invalid_credentials",
                "message": "Invalid credentials",
                "status_code": 401
            }

+ Response 401 (application/json)
    + Body

            {
                "error": "user_blocked",
                "message": "Your Account has been blocked.",
                "status_code": 401
            }

+ Response 500 (application/json)
    + Body

            {
                "error": "could_not_create_token",
                "message": "Internal Server Error",
                "status_code": 500
            }

# Users [/users]

## List of tutors [GET /users]


+ Parameters
    + latitude: (decimal, optional) - 
    + longitude: (decimal, optional) - 
    + radius: (integer, optional) - Radius in meters
    + qualifications: (array, optional) - string array of qualification

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "total": 8,
                "per_page": 1,
                "current_page": 1,
                "last_page": 8,
                "next_page_url": "http:\/\/localhost:8000\/api\/users?page=2",
                "prev_page_url": null,
                "from": 1,
                "to": 1,
                "data": [
                    {
                        "id": 1,
                        "gender": "M",
                        "name": "Maye Klocko",
                        "avatar": null,
                        "latitude": "40.53965400",
                        "longitude": "36.50458600",
                        "phone_number": "383-672-5171 x714",
                        "bio": "Occaecati incidunt doloremque id rerum incidunt tempora. Dolore tempore recusandae sequi commodi. Repellendus dolorem ea iusto quidem. Quis assumenda et eveniet.",
                        "hourly_rate": "10.00",
                        "radius": "4580",
                        "email": "doyle.freddie@example.org",
                        "qualifications": []
                    }
                ]
            }

## Show My Account info [GET /users/me]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "user": {
                    "id": 10,
                    "email": "tanner.damore@example.com",
                    "created_at": "2017-04-05 18:40:47",
                    "profile": {
                        "gender": "F",
                        "name": "Destinee Leannon",
                        "avatar": null,
                        "latitude": "-69.92557000",
                        "longitude": "-144.58138800",
                        "phone_number": "+1-548-519-6469",
                        "bio": "Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.",
                        "hourly_rate": "1.00",
                        "radius": "10588",
                        "address": "test",
                        "qualifications": [
                            "MBA",
                            "BS"
                        ]
                    }
                }
            }

## Update My Profile Information [POST /users/me]


+ Parameters
    + name: (string, optional) - Customer Name
    + gender: (string, optional) - Gender is M/F
    + latitude: (decimal, optional) - 
    + longitude: (decimal, optional) - 
    + phone_number: (string, optional) - 
    + hourly_rate: (decimal, optional) - 
    + radius: (integer, optional) - Radius in meters
    + address: (string, optional) - 
    + qualifications: (array, optional) - string array of qualification
    + bio: (string, optional) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "gender": "F",
                "name": "Destinee Leannon",
                "avatar": null,
                "latitude": "-69.92557000",
                "longitude": "-144.58138800",
                "phone_number": "+1-548-519-6469",
                "bio": "Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.",
                "hourly_rate": "1.00",
                "radius": "10588",
                "address": "test",
                "qualifications": [
                    "MBA",
                    "BS"
                ]
            }

+ Response 200 (application/json)
    + Body

            {
                "gender": "F",
                "name": "Destinee Leannon",
                "avatar": null,
                "latitude": "-69.92557000",
                "longitude": "-144.58138800",
                "phone_number": "+1-548-519-6469",
                "bio": "Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.",
                "hourly_rate": "1.00",
                "radius": "10588",
                "address": "test",
                "qualifications": [
                    "MBA",
                    "BS"
                ]
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not update user profile information.",
                "errors": {
                    "message": "Could not update user profile information.",
                    "errors": {
                        "latitude": [
                            "The latitude format is invalid."
                        ],
                        "longitude": [
                            "The longitude format is invalid."
                        ]
                    },
                    "status_code": 422
                }
            }

## Upload User Avatar [POST /users/avatar]


+ Parameters
    + avatar: (string, required) - This request is not Json based. So, please be careful before using it

+ Response 200 (application/json)
    + Body

            {
                "profile": {
                    "id": 13,
                    "gender": "M",
                    "name": "Sam",
                    "avatar": "uploads/avatars/P2ehhNLyHx53dpY1ve6wYT6Tl5exCzYPYfCtnKA4.jpeg",
                    "latitude": "-69.92557000",
                    "longitude": "-144.58138800",
                    "phone_number": "+1-548-519-6469",
                    "bio": "Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.",
                    "hourly_rate": "12.00",
                    "radius": "5000",
                    "qualifications": [
                        "Mba",
                        "Bs"
                    ]
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not update user avatar.",
                "errors": {
                    "errors": {
                        "avatar": "The avatar field is required."
                    }
                },
                "status_code": 422
            }

## List of Answers of profile Questionnaires [GET /users/questionnaires]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "answers": [
                    {
                        "id": 26,
                        "questionable_id": "13",
                        "questionable_type": "App\\Models\\Profile",
                        "question_id": "2",
                        "choice_id": "4",
                        "created_at": "2017-04-12 18:58:10"
                    },
                    {
                        "id": 27,
                        "questionable_id": "13",
                        "questionable_type": "App\\Models\\Profile",
                        "question_id": "5",
                        "choice_id": "2",
                        "created_at": "2017-04-12 18:58:10"
                    },
                    {
                        "id": 28,
                        "questionable_id": "13",
                        "questionable_type": "App\\Models\\Profile",
                        "question_id": "9",
                        "choice_id": "4",
                        "created_at": "2017-04-12 18:58:10"
                    },
                    {
                        "id": 29,
                        "questionable_id": "13",
                        "questionable_type": "App\\Models\\Profile",
                        "question_id": "11",
                        "choice_id": "2",
                        "created_at": "2017-04-12 18:58:10"
                    },
                    {
                        "id": 30,
                        "questionable_id": "13",
                        "questionable_type": "App\\Models\\Profile",
                        "question_id": "13",
                        "choice_id": "5",
                        "created_at": "2017-04-12 18:58:10"
                    }
                ]
            }

## Add/Edit Answer of Profile Questionnaires [POST /users/questionnaires]


+ Parameters
    + answers: (array, required) - array of objects

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "answers": [
                    {
                        "question_id": 1,
                        "choice_id": 2
                    },
                    {
                        "question_id": 4,
                        "choice_id": 2
                    },
                    {
                        "question_id": 6,
                        "choice_id": 2
                    },
                    {
                        "question_id": 8,
                        "choice_id": 2
                    },
                    {
                        "question_id": 12,
                        "choice_id": 2
                    }
                ]
            }

+ Response 200 (application/json)
    + Body

            {
                "answers": [
                    {
                        "id": 21,
                        "questionable_id": "5",
                        "questionable_type": "App\\Models\\Tution",
                        "question_id": "1",
                        "choice_id": "2",
                        "created_at": "2017-04-12 17:32:21"
                    },
                    {
                        "id": 22,
                        "questionable_id": "5",
                        "questionable_type": "App\\Models\\Tution",
                        "question_id": "4",
                        "choice_id": "2",
                        "created_at": "2017-04-12 17:32:21"
                    },
                    {
                        "id": 23,
                        "questionable_id": "5",
                        "questionable_type": "App\\Models\\Tution",
                        "question_id": "6",
                        "choice_id": "2",
                        "created_at": "2017-04-12 17:32:21"
                    },
                    {
                        "id": 24,
                        "questionable_id": "5",
                        "questionable_type": "App\\Models\\Tution",
                        "question_id": "8",
                        "choice_id": "2",
                        "created_at": "2017-04-12 17:32:21"
                    },
                    {
                        "id": 25,
                        "questionable_id": "5",
                        "questionable_type": "App\\Models\\Tution",
                        "question_id": "12",
                        "choice_id": "2",
                        "created_at": "2017-04-12 17:32:22"
                    }
                ]
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not add answers.",
                "errors": {
                    "answers": [
                        "Invalid number of answers"
                    ]
                },
                "status_code": 422
            }

# Question [/questions]

## List of Questionnaires with options [GET /questions]
for student/tutor profile and tutions

+ Parameters
    + type: (integer, optional) - 1=for tutions, 2= student, 3= tutor

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "questions": [
                    {
                        "id": 2,
                        "text": "Duchess. 'Everything's got a moral, if only you.",
                        "choices": [
                            {
                                "id": 6,
                                "question_id": "2",
                                "text": "White Rabbit, with."
                            },
                            {
                                "id": 7,
                                "question_id": "2",
                                "text": "What WILL become."
                            },
                            {
                                "id": 8,
                                "question_id": "2",
                                "text": "Alice dodged."
                            },
                            {
                                "id": 9,
                                "question_id": "2",
                                "text": "Cheshire Cat,'."
                            },
                            {
                                "id": 10,
                                "question_id": "2",
                                "text": "Gryphon, and the."
                            }
                        ]
                    },
                    {
                        "id": 5,
                        "text": "Soup! Beau--ootiful Soo--oop! Beau--ootiful.",
                        "choices": [
                            {
                                "id": 21,
                                "question_id": "5",
                                "text": "THIS!' (Sounds of."
                            },
                            {
                                "id": 22,
                                "question_id": "5",
                                "text": "Gryphon: and it."
                            },
                            {
                                "id": 23,
                                "question_id": "5",
                                "text": "She is such a long."
                            },
                            {
                                "id": 24,
                                "question_id": "5",
                                "text": "I beg your."
                            },
                            {
                                "id": 25,
                                "question_id": "5",
                                "text": "White Rabbit read."
                            }
                        ]
                    },
                    {
                        "id": 9,
                        "text": "The Duchess took no notice of her or of anything.",
                        "choices": [
                            {
                                "id": 41,
                                "question_id": "9",
                                "text": "ME.' 'You!' said."
                            },
                            {
                                "id": 42,
                                "question_id": "9",
                                "text": "Hatter added as an."
                            },
                            {
                                "id": 43,
                                "question_id": "9",
                                "text": "Gryphon, and the."
                            },
                            {
                                "id": 44,
                                "question_id": "9",
                                "text": "They had a door."
                            },
                            {
                                "id": 45,
                                "question_id": "9",
                                "text": "I mean what I used."
                            }
                        ]
                    },
                    {
                        "id": 11,
                        "text": "It means much the most interesting, and perhaps.",
                        "choices": [
                            {
                                "id": 51,
                                "question_id": "11",
                                "text": "FIT you,' said the."
                            },
                            {
                                "id": 52,
                                "question_id": "11",
                                "text": "YOUR table,' said."
                            },
                            {
                                "id": 53,
                                "question_id": "11",
                                "text": "Alice. 'That's the."
                            },
                            {
                                "id": 54,
                                "question_id": "11",
                                "text": "Duchess was."
                            },
                            {
                                "id": 55,
                                "question_id": "11",
                                "text": "However,."
                            }
                        ]
                    },
                    {
                        "id": 13,
                        "text": "Though they were filled with cupboards and.",
                        "choices": [
                            {
                                "id": 61,
                                "question_id": "13",
                                "text": "I grow up, I'll."
                            },
                            {
                                "id": 62,
                                "question_id": "13",
                                "text": "In another moment."
                            },
                            {
                                "id": 63,
                                "question_id": "13",
                                "text": "Caterpillar took."
                            },
                            {
                                "id": 64,
                                "question_id": "13",
                                "text": "Majesty,' said the."
                            },
                            {
                                "id": 65,
                                "question_id": "13",
                                "text": "She pitied him."
                            }
                        ]
                    }
                ]
            }

# Tutions [/tutions]

## List of my tutions [GET /tutions]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "total": 20,
                "per_page": 1,
                "current_page": 1,
                "last_page": 1,
                "next_page_url": "http:\/\/localhost:8000\/api\/tutions?page=2",
                "prev_page_url": null,
                "from": 1,
                "to": 1,
                "data": [
                    {
                        "id": 5,
                        "student_id": "11",
                        "tutor_id": "6",
                        "status": "1",
                        "title": "Tution 3",
                        "budget": "100 dollar",
                        "latitude": "11.45609800",
                        "longitude": "-51.78216000",
                        "start_date": "2019-08-12 00:00:00",
                        "daily_timing": "05:00:00",
                        "day_of_week_0": true,
                        "day_of_week_1": true,
                        "day_of_week_2": true,
                        "day_of_week_3": true,
                        "day_of_week_4": true,
                        "day_of_week_5": true,
                        "day_of_week_6": true,
                        "description": null,
                        "created_at": "2017-04-12 17:32:21",
                        "tutor_profile": {
                            "id": 6,
                            "gender": "M",
                            "name": "Alva Runolfsson",
                            "avatar": null,
                            "latitude": "-50.45929600",
                            "longitude": "125.86288200",
                            "phone_number": "+18872230060",
                            "bio": "Beatae hic sint voluptatum ea. Ipsa quia et quos nam qui ut officiis laboriosam. Autem totam voluptates voluptate ducimus qui necessitatibus et ullam. Temporibus et magni totam.",
                            "hourly_rate": "4.00",
                            "radius": "7306",
                            "qualifications": []
                        }
                    }
                ]
            }

## Create Tution [POST /tutions]


+ Parameters
    + title: (string, optional) - Customer Name
    + start_date: (date, required) - date format Y-m-d like 2016-12-12
    + latitude: (decimal, required) - 
    + longitude: (decimal, required) - 
    + budget: (string, required) - 
    + daily_timing: (time, required) - time format H:i:s like 22:00:00
    + day_of_week_0: (boolean, required) - 
    + day_of_week_1: (boolean, required) - 
    + day_of_week_2: (boolean, required) - 
    + day_of_week_3: (boolean, required) - 
    + day_of_week_4: (boolean, required) - 
    + day_of_week_5: (boolean, required) - 
    + day_of_week_6: (boolean, required) - 
    + answers: (array, required) - array of objects
    + description: (string, optional) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "title": "Tution 3",
                "budget": "100 dollar",
                "start_date": "2018-20-12",
                "day_of_week_0": 1,
                "day_of_week_1": 1,
                "day_of_week_2": 1,
                "day_of_week_3": 1,
                "day_of_week_4": 1,
                "day_of_week_5": 1,
                "day_of_week_6": 1,
                "latitude": "11.45609800",
                "longitude": "-51.78216000",
                "daily_timing": "05:00:00",
                "answers": [
                    {
                        "question_id": 1,
                        "choice_id": 2
                    },
                    {
                        "question_id": 4,
                        "choice_id": 2
                    },
                    {
                        "question_id": 6,
                        "choice_id": 2
                    },
                    {
                        "question_id": 8,
                        "choice_id": 2
                    },
                    {
                        "question_id": 12,
                        "choice_id": 2
                    }
                ]
            }

+ Response 200 (application/json)
    + Body

            {
                "tution": {
                    "title": "Tution 3",
                    "budget": "100 dollar",
                    "start_date": "2019-08-12 00:00:00",
                    "day_of_week_0": true,
                    "day_of_week_1": true,
                    "day_of_week_2": true,
                    "day_of_week_3": true,
                    "day_of_week_4": true,
                    "day_of_week_5": true,
                    "day_of_week_6": true,
                    "latitude": "11.45609800",
                    "longitude": "-51.78216000",
                    "daily_timing": "05:00:00",
                    "student_id": 11,
                    "created_at": "2017-04-12 17:32:21",
                    "id": 5,
                    "answers": [
                        {
                            "id": 21,
                            "questionable_id": "5",
                            "questionable_type": "App\\Models\\Tution",
                            "question_id": "1",
                            "choice_id": "2",
                            "created_at": "2017-04-12 17:32:21"
                        },
                        {
                            "id": 22,
                            "questionable_id": "5",
                            "questionable_type": "App\\Models\\Tution",
                            "question_id": "4",
                            "choice_id": "2",
                            "created_at": "2017-04-12 17:32:21"
                        },
                        {
                            "id": 23,
                            "questionable_id": "5",
                            "questionable_type": "App\\Models\\Tution",
                            "question_id": "6",
                            "choice_id": "2",
                            "created_at": "2017-04-12 17:32:21"
                        },
                        {
                            "id": 24,
                            "questionable_id": "5",
                            "questionable_type": "App\\Models\\Tution",
                            "question_id": "8",
                            "choice_id": "2",
                            "created_at": "2017-04-12 17:32:21"
                        },
                        {
                            "id": 25,
                            "questionable_id": "5",
                            "questionable_type": "App\\Models\\Tution",
                            "question_id": "12",
                            "choice_id": "2",
                            "created_at": "2017-04-12 17:32:22"
                        }
                    ]
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not add Tution.",
                "errors": {
                    "title": [
                        "The title field is required."
                    ],
                    "budget": [
                        "The budget field is required."
                    ],
                    "latitude": [
                        "The latitude field is required."
                    ],
                    "longitude": [
                        "The longitude field is required."
                    ],
                    "start_date": [
                        "The start date field is required."
                    ],
                    "daily_timing": [
                        "The daily timing field is required."
                    ],
                    "day_of_week_0": [
                        "The day of week 0 field is required."
                    ],
                    "day_of_week_1": [
                        "The day of week 1 field is required."
                    ],
                    "day_of_week_2": [
                        "The day of week 2 field is required."
                    ],
                    "day_of_week_3": [
                        "The day of week 3 field is required."
                    ],
                    "day_of_week_4": [
                        "The day of week 4 field is required."
                    ],
                    "day_of_week_5": [
                        "The day of week 5 field is required."
                    ],
                    "day_of_week_6": [
                        "The day of week 6 field is required."
                    ]
                },
                "status_code": 422
            }

## Tution Information [GET /tutions/{id}]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            []

# Messages [/messages]

## List of my messages [GET /messages]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "total": 2,
                "per_page": 20,
                "current_page": 1,
                "last_page": 1,
                "next_page_url": null,
                "prev_page_url": null,
                "from": 1,
                "to": 2,
                "data": [
                    {
                        "id": 2,
                        "unread_messages_count": 3,
                        "last_message": {
                            "id": 7,
                            "thread_id": "2",
                            "sender_id": "10",
                            "body": "Fine",
                            "created_at": "2017-04-16 13:59:09"
                        },
                        "participants": [
                            {
                                "id": 3,
                                "thread_id": "2",
                                "user_id": "11",
                                "last_read": null,
                                "deleted_at": null
                            },
                            {
                                "id": 4,
                                "thread_id": "2",
                                "user_id": "10",
                                "last_read": null,
                                "deleted_at": null
                            }
                        ],
                        "pivot": {
                            "user_id": "10",
                            "thread_id": "2",
                            "last_read": null
                        },
                        "messages": [
                            {
                                "id": 3,
                                "thread_id": "2",
                                "sender_id": "11",
                                "body": "Salam",
                                "created_at": "2017-04-16 13:53:37"
                            },
                            {
                                "id": 4,
                                "thread_id": "2",
                                "sender_id": "11",
                                "body": "How are you?",
                                "created_at": "2017-04-16 13:53:44"
                            },
                            {
                                "id": 5,
                                "thread_id": "2",
                                "sender_id": "11",
                                "body": "Wait!",
                                "created_at": "2017-04-16 13:53:52"
                            },
                            {
                                "id": 6,
                                "thread_id": "2",
                                "sender_id": "10",
                                "body": "WS",
                                "created_at": "2017-04-16 13:59:01"
                            },
                            {
                                "id": 7,
                                "thread_id": "2",
                                "sender_id": "10",
                                "body": "Fine",
                                "created_at": "2017-04-16 13:59:09"
                            }
                        ]
                    },
                    {
                        "id": 3,
                        "unread_messages_count": 4,
                        "last_message": {
                            "id": 11,
                            "thread_id": "3",
                            "sender_id": "5",
                            "body": "I will be in meeting room",
                            "created_at": "2017-04-17 06:57:15"
                        },
                        "participants": [
                            {
                                "id": 5,
                                "thread_id": "3",
                                "user_id": "5",
                                "last_read": null,
                                "deleted_at": null
                            },
                            {
                                "id": 6,
                                "thread_id": "3",
                                "user_id": "10",
                                "last_read": null,
                                "deleted_at": null
                            }
                        ],
                        "pivot": {
                            "user_id": "10",
                            "thread_id": "3",
                            "last_read": null
                        },
                        "messages": [
                            {
                                "id": 8,
                                "thread_id": "3",
                                "sender_id": "5",
                                "body": "Hello,",
                                "created_at": "2017-04-17 06:55:11"
                            },
                            {
                                "id": 9,
                                "thread_id": "3",
                                "sender_id": "5",
                                "body": "Lets discuss on new project",
                                "created_at": "2017-04-17 06:55:25"
                            },
                            {
                                "id": 10,
                                "thread_id": "3",
                                "sender_id": "5",
                                "body": "I will be in meeting room",
                                "created_at": "2017-04-17 06:57:01"
                            },
                            {
                                "id": 11,
                                "thread_id": "3",
                                "sender_id": "5",
                                "body": "I will be in meeting room",
                                "created_at": "2017-04-17 06:57:15"
                            }
                        ]
                    }
                ]
            }

## Send Message to User [POST /messages]


+ Parameters
    + user_id: (integer, required) - 
    + message: (string, required) - 

+ Request (application/json)
    + Body

            {
                "user_id": 11,
                "message": "I will be in meeting room"
            }

+ Response 200 (application/json)
    + Body

            {
                "message": {
                    "id": 12,
                    "thread_id": "4",
                    "sender_id": "5",
                    "body": "I will be in meeting room",
                    "created_at": "2017-04-17 06:57:39"
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not add Message.",
                "errors": {
                    "message": [
                        "The message field is required."
                    ],
                    "user_id": [
                        "The user id field is required."
                    ]
                },
                "status_code": 422
            }

## Unread Messages Count [GET /messages/unread-messages-count]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "unread_messages_count": 4
            }

## Read Thread/Messages [POST /messages/read-thread]


+ Parameters
    + thread_id: (integer, required) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "thread_id": 2
            }

+ Response 200 (application/json)
    + Body

            {
                "message_thread": {
                    "id": 2,
                    "pivot": {
                        "user_id": "10",
                        "thread_id": "2",
                        "last_read": "2017-04-17 17:25:23"
                    },
                    "messages": [
                        {
                            "id": 3,
                            "thread_id": "2",
                            "sender_id": "11",
                            "body": "Salam",
                            "created_at": "2017-04-16 13:53:37"
                        },
                        {
                            "id": 4,
                            "thread_id": "2",
                            "sender_id": "11",
                            "body": "How are you?",
                            "created_at": "2017-04-16 13:53:44"
                        },
                        {
                            "id": 5,
                            "thread_id": "2",
                            "sender_id": "11",
                            "body": "Wait!",
                            "created_at": "2017-04-16 13:53:52"
                        },
                        {
                            "id": 6,
                            "thread_id": "2",
                            "sender_id": "10",
                            "body": "WS",
                            "created_at": "2017-04-16 13:59:01"
                        },
                        {
                            "id": 7,
                            "thread_id": "2",
                            "sender_id": "10",
                            "body": "Fine",
                            "created_at": "2017-04-16 13:59:09"
                        }
                    ]
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not read Messages.",
                "errors": {
                    "thread_id": [
                        "The thread_id field is required."
                    ]
                },
                "status_code": 422
            }