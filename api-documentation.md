FORMAT: 1A

HOST: http://52.35.243.250/v1/api/

# API

# Login [/login]

## Tutor Login with Google [POST /login/google/tutor]
Login user with a google code.
Token is returned which will be required in every request

+ Parameters
    + code: (string, required) - Google Code

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

+ Parameters
    + code: (string, required) - Google Code

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

## Tutor/Student Login with Email and Password [POST /login]
Token is returned which will be required in every request

+ Parameters
    + email: (string, required) - 
    + password: (string, required) - 

+ Request (application/json)
    + Body

            {
                "email": "tlabadie@example.com",
                "password": "123456"
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
                        "experience": "1",
                        "email": "doyle.freddie@example.org",
                        "qualifications": [],
                        "teaches": "Matric",
                        "specialist": "Maths",
                        "average_rating": "3.0000"
                    }
                ]
            }

## Register Student [POST /users/register/student]


+ Parameters
    + email: (string, required) - Student Email address
    + password: (string, required) - Password
    + name: (string, optional) - Student Name

+ Request (application/json)
    + Body

            {
                "email": "tlabadie1@example.com",
                "password": "123456"
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

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not register student.",
                "errors": {
                    "email": [
                        "The email has already been taken."
                    ]
                },
                "status_code": 422
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not register student.",
                "errors": {
                    "email": [
                        "The email has already been taken."
                    ]
                },
                "status_code": 422
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not register student.",
                "errors": {
                    "email": [
                        "The email must be a valid email address."
                    ]
                },
                "status_code": 422
            }

## Register Tutor [POST /users/register/tutor]


+ Parameters
    + email: (string, required) - Tutor Email address
    + password: (string, required) - Password
    + name: (string, required) - Tutor Name

+ Request (application/json)
    + Body

            {
                "email": "tlabadie1@example.com",
                "password": "123456"
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

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not register tutor.",
                "errors": {
                    "email": [
                        "The email has already been taken."
                    ]
                },
                "status_code": 422
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not register tutor.",
                "errors": {
                    "email": [
                        "The email has already been taken."
                    ]
                },
                "status_code": 422
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not register tutor.",
                "errors": {
                    "email": [
                        "The email must be a valid email address."
                    ]
                },
                "status_code": 422
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
                    "id": 11,
                    "email": "cleta71@example.net",
                    "user_type": "2",
                    "created_at": "2017-04-06 05:28:03",
                    "profile": {
                        "id": 13,
                        "gender": "M",
                        "name": "Sam",
                        "avatar": "uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg",
                        "latitude": "-69.92557000",
                        "longitude": "-144.58138800",
                        "phone_number": "+1-548-519-6469",
                        "bio": "Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.",
                        "hourly_rate": "12.00",
                        "radius": "5000",
                        "experience": "1",
                        "qualifications": [
                            "Mba",
                            "Bs"
                        ],
                        "stage_complete": 1,
                        "teaches": "Matric",
                        "specialist": "Maths",
                        "average_rating": "3.0000",
                        "avatar_url": "http:\/\/localhost:8000\/uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg",
                        "answers": [
                            {
                                "id": 1,
                                "questionable_id": "13",
                                "question_id": "1",
                                "text": "IT\/CS",
                                "created_at": "2017-05-04 05:39:51"
                            },
                            {
                                "id": 2,
                                "questionable_id": "13",
                                "question_id": "2",
                                "text": "A1",
                                "created_at": "2017-05-04 05:39:51"
                            },
                            {
                                "id": 3,
                                "questionable_id": "13",
                                "question_id": "3",
                                "text": "4",
                                "created_at": "2017-05-04 05:39:51"
                            },
                            {
                                "id": 4,
                                "questionable_id": "13",
                                "question_id": "4",
                                "text": "2",
                                "created_at": "2017-05-04 05:39:52"
                            },
                            {
                                "id": 5,
                                "questionable_id": "13",
                                "question_id": "5",
                                "text": "Samar",
                                "created_at": "2017-05-04 05:39:52"
                            },
                            {
                                "id": 6,
                                "questionable_id": "13",
                                "question_id": "6",
                                "text": "Test",
                                "created_at": "2017-05-04 05:39:52"
                            },
                            {
                                "id": 7,
                                "questionable_id": "13",
                                "question_id": "7",
                                "text": "Test one of these",
                                "created_at": "2017-05-04 05:39:52"
                            }
                        ]
                    }
                }
            }

## Show User profile [GET /users/{id}]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "user": {
                    "id": 11,
                    "email": "cleta71@example.net",
                    "user_type": "2",
                    "created_at": "2017-04-06 05:28:03",
                    "profile": {
                        "id": 13,
                        "gender": "M",
                        "name": "Sam",
                        "avatar": "uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg",
                        "latitude": "-69.92557000",
                        "longitude": "-144.58138800",
                        "phone_number": "+1-548-519-6469",
                        "bio": "Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.",
                        "hourly_rate": "12.00",
                        "radius": "5000",
                        "experience": "1",
                        "qualifications": [
                            "Mba",
                            "Bs"
                        ],
                        "stage_complete": 1,
                        "teaches": "Matric",
                        "specialist": "Maths",
                        "average_rating": "3.0000",
                        "avatar_url": "http:\/\/localhost:8000\/uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg",
                        "answers": [
                            {
                                "id": 1,
                                "questionable_id": "13",
                                "question_id": "1",
                                "text": "IT\/CS",
                                "created_at": "2017-05-04 05:39:51"
                            },
                            {
                                "id": 2,
                                "questionable_id": "13",
                                "question_id": "2",
                                "text": "A1",
                                "created_at": "2017-05-04 05:39:51"
                            },
                            {
                                "id": 3,
                                "questionable_id": "13",
                                "question_id": "3",
                                "text": "4",
                                "created_at": "2017-05-04 05:39:51"
                            },
                            {
                                "id": 4,
                                "questionable_id": "13",
                                "question_id": "4",
                                "text": "2",
                                "created_at": "2017-05-04 05:39:52"
                            },
                            {
                                "id": 5,
                                "questionable_id": "13",
                                "question_id": "5",
                                "text": "Samar",
                                "created_at": "2017-05-04 05:39:52"
                            },
                            {
                                "id": 6,
                                "questionable_id": "13",
                                "question_id": "6",
                                "text": "Test",
                                "created_at": "2017-05-04 05:39:52"
                            },
                            {
                                "id": 7,
                                "questionable_id": "13",
                                "question_id": "7",
                                "text": "Test one of these",
                                "created_at": "2017-05-04 05:39:52"
                            }
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
    + experience: (integer, optional) - Experience in Years
    + address: (string, optional) - 
    + stage_complete: (integer, optional) - 
    + teaches: (string, optional) - 
    + specialist: (string, optional) - 
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
                "experience": "1",
                "address": "test",
                "qualifications": [
                    "MBA",
                    "BS"
                ],
                "stage_complete": 1,
                "teaches": "Matric",
                "specialist": "Maths",
                "average_rating": "3.0000"
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
                "experience": "1",
                "address": "test",
                "qualifications": [
                    "MBA",
                    "BS"
                ],
                "teaches": "Matric",
                "specialist": "Maths",
                "average_rating": "3.0000"
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
                    "experience": "1",
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
                        "id": 1,
                        "questionable_id": "13",
                        "question_id": "1",
                        "text": "IT\/CS",
                        "created_at": "2017-05-04 05:39:51"
                    },
                    {
                        "id": 2,
                        "questionable_id": "13",
                        "question_id": "2",
                        "text": "A1",
                        "created_at": "2017-05-04 05:39:51"
                    },
                    {
                        "id": 3,
                        "questionable_id": "13",
                        "question_id": "3",
                        "text": "4",
                        "created_at": "2017-05-04 05:39:51"
                    },
                    {
                        "id": 4,
                        "questionable_id": "13",
                        "question_id": "4",
                        "text": "2",
                        "created_at": "2017-05-04 05:39:52"
                    },
                    {
                        "id": 5,
                        "questionable_id": "13",
                        "question_id": "5",
                        "text": "Samar",
                        "created_at": "2017-05-04 05:39:52"
                    },
                    {
                        "id": 6,
                        "questionable_id": "13",
                        "question_id": "6",
                        "text": "Test",
                        "created_at": "2017-05-04 05:39:52"
                    },
                    {
                        "id": 7,
                        "questionable_id": "13",
                        "question_id": "7",
                        "text": "Test one of these",
                        "created_at": "2017-05-04 05:39:52"
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
                        "text": "IT/CS"
                    },
                    {
                        "question_id": 2,
                        "text": "A1"
                    },
                    {
                        "question_id": 3,
                        "text": 4
                    },
                    {
                        "question_id": 4,
                        "text": 2
                    },
                    {
                        "question_id": 5,
                        "text": "Samar"
                    },
                    {
                        "question_id": 6,
                        "text": "Test"
                    },
                    {
                        "question_id": 7,
                        "text": "Test one of these"
                    }
                ]
            }

+ Response 200 (application/json)
    + Body

            {
                "answers": [
                    {
                        "id": 1,
                        "questionable_id": "13",
                        "question_id": "1",
                        "text": "IT\/CS",
                        "created_at": "2017-05-04 05:39:51"
                    },
                    {
                        "id": 2,
                        "questionable_id": "13",
                        "question_id": "2",
                        "text": "A1",
                        "created_at": "2017-05-04 05:39:51"
                    },
                    {
                        "id": 3,
                        "questionable_id": "13",
                        "question_id": "3",
                        "text": "4",
                        "created_at": "2017-05-04 05:39:51"
                    },
                    {
                        "id": 4,
                        "questionable_id": "13",
                        "question_id": "4",
                        "text": "2",
                        "created_at": "2017-05-04 05:39:52"
                    },
                    {
                        "id": 5,
                        "questionable_id": "13",
                        "question_id": "5",
                        "text": "Samar",
                        "created_at": "2017-05-04 05:39:52"
                    },
                    {
                        "id": 6,
                        "questionable_id": "13",
                        "question_id": "6",
                        "text": "Test",
                        "created_at": "2017-05-04 05:39:52"
                    },
                    {
                        "id": 7,
                        "questionable_id": "13",
                        "question_id": "7",
                        "text": "Test one of these",
                        "created_at": "2017-05-04 05:39:52"
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

## Change Password [POST /users/change-password]


+ Parameters
    + current_password: (string, required) - 
    + new_password: (string, required) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "current_password": "new_password",
                "new_password": "123456"
            }

+ Response 200 (application/json)
    + Body

            {
                "user": {
                    "id": 15,
                    "email": "student2@mailinator.com",
                    "user_type": "2",
                    "created_at": "2017-04-27 18:01:32"
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not update password.",
                "errors": {
                    "current_password": [
                        "Current password is not matched"
                    ]
                },
                "status_code": 422
            }

## Verify Phone Number [POST /users/verify-phone-number]


+ Parameters
    + phone_number: (string, required) - 
    + code: (string, required) - 

+ Request (application/json)
    + Body

            {
                "phone_number": "923415641025",
                "code": "5548"
            }

+ Response 200 (application/json)
    + Body

            []

+ Response 500 (application/json)
    + Body

            {
                "message": "No query results for model [App\\Models\\Verification].",
                "status_code": 500
            }

# Subject [/subjects]

## Subjects List [GET /subjects]


+ Response 200 (application/json)
    + Body

            [
                "Maths",
                "Science",
                "Language",
                "Test preparation",
                "Elementary education",
                "Computer",
                "Business",
                "History",
                "Music",
                "Special Needs",
                "Sports\/Recreation",
                "Religion",
                "Art"
            ]

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


+ Parameters
    + search_type: (string, optional) - 1= new, 2= pending 3=completed, 100=near by me

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
                        "id": 6,
                        "student_id": "11",
                        "tutor_id": "6",
                        "status": "2",
                        "private": true,
                        "title": "Tution 6",
                        "budget": "100 dollar",
                        "latitude": "11.45609800",
                        "longitude": "-51.78216000",
                        "start_date": "2019-08-12",
                        "daily_timing": "05:00:00",
                        "city": null,
                        "state": null,
                        "date": null,
                        "time": null,
                        "attachments": [],
                        "day_of_week_0": true,
                        "day_of_week_1": true,
                        "day_of_week_2": true,
                        "day_of_week_3": true,
                        "day_of_week_4": true,
                        "day_of_week_5": true,
                        "day_of_week_6": true,
                        "description": null,
                        "created_at": "2017-04-12 19:20:03",
                        "subjects": [],
                        "last_class": "",
                        "answers": [],
                        "student": {
                            "id": 13,
                            "gender": "M",
                            "name": "Sam",
                            "avatar": "uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg",
                            "latitude": "-69.92557000",
                            "longitude": "-144.58138800",
                            "address": "My locatio",
                            "phone_number": "+1-548-519-6469",
                            "bio": "Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.",
                            "hourly_rate": "12.00",
                            "radius": "5000",
                            "experience": "1",
                            "stage_complete": null,
                            "teaches": null,
                            "city": null,
                            "state": null,
                            "paypal_address": null,
                            "specialist": null,
                            "qualifications": [
                                "Mba",
                                "Bs"
                            ],
                            "average_rating": "3.0000",
                            "completed_tutions": 2,
                            "avatar_url": "http:\/\/localhost:8000\/uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg",
                            "total_hours": 5,
                            "user": {
                                "id": 11,
                                "email": "cleta71@example.net",
                                "user_type": "2",
                                "created_at": "2017-04-06 05:28:03"
                            }
                        }
                    },
                    {
                        "id": 4,
                        "student_id": "11",
                        "tutor_id": "6",
                        "status": "2",
                        "private": true,
                        "title": "Tution 4",
                        "budget": "100 dollar",
                        "latitude": "11.45609800",
                        "longitude": "-51.78216000",
                        "start_date": "2019-08-12",
                        "daily_timing": "05:00:00",
                        "city": null,
                        "state": null,
                        "date": null,
                        "time": null,
                        "attachments": [],
                        "day_of_week_0": true,
                        "day_of_week_1": true,
                        "day_of_week_2": true,
                        "day_of_week_3": true,
                        "day_of_week_4": true,
                        "day_of_week_5": true,
                        "day_of_week_6": true,
                        "description": null,
                        "created_at": "2017-04-12 17:32:16",
                        "subjects": [],
                        "last_class": "",
                        "answers": [],
                        "student": {
                            "id": 13,
                            "gender": "M",
                            "name": "Sam",
                            "avatar": "uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg",
                            "latitude": "-69.92557000",
                            "longitude": "-144.58138800",
                            "address": "My locatio",
                            "phone_number": "+1-548-519-6469",
                            "bio": "Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.",
                            "hourly_rate": "12.00",
                            "radius": "5000",
                            "experience": "1",
                            "stage_complete": null,
                            "teaches": null,
                            "city": null,
                            "state": null,
                            "paypal_address": null,
                            "specialist": null,
                            "qualifications": [
                                "Mba",
                                "Bs"
                            ],
                            "average_rating": "3.0000",
                            "completed_tutions": 2,
                            "avatar_url": "http:\/\/localhost:8000\/uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg",
                            "total_hours": 5,
                            "user": {
                                "id": 11,
                                "email": "cleta71@example.net",
                                "user_type": "2",
                                "created_at": "2017-04-06 05:28:03"
                            }
                        }
                    }
                ]
            }

## Create Tution [POST /tutions]


+ Parameters
    + title: (string, optional) - Customer Name
    + private: (boolean, required) - 
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
    + subjects: (array, optional) - string array of subjects
    + answers: (array, required) - array of objects
    + attachments: (array, optional) - array of objects
    + description: (string, optional) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "title": "Tution 3",
                "private": true,
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
                "subjects": [
                    "English",
                    "Urdu"
                ],
                "answers": {
                    "0": {
                        "question_id": 1,
                        "choice_id": 2
                    },
                    "1": {
                        "question_id": 4,
                        "choice_id": 2
                    },
                    "2": {
                        "question_id": 6,
                        "choice_id": 2
                    },
                    "3": {
                        "question_id": 8,
                        "choice_id": 2
                    },
                    "4": {
                        "question_id": 12,
                        "choice_id": 2
                    },
                    "attachments": [
                        "attachments/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt",
                        "attachments/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"
                    ]
                }
            }

+ Response 200 (application/json)
    + Body

            {
                "tution": {
                    "title": "Tution 3",
                    "private": true,
                    "budget": "100 dollar",
                    "attachments": [
                        "attachments/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt",
                        "attachments/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"
                    ],
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
                    "subjects": [
                        "English",
                        "Urdu"
                    ],
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

## Rate Tution by Student / Tutor [POST /tutions/{id}/rate]


+ Parameters
    + rating: (integer, required) - value between 1-5

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "rating": "1"
            }

+ Response 200 (application/json)
    + Body

            {
                "rating": {
                    "rating": 3,
                    "reviews": null,
                    "user_id": 11,
                    "rateable_type": "App\\Models\\Profile",
                    "rateable_id": 6,
                    "updated_at": "2017-04-29 10:45:56",
                    "created_at": "2017-04-29 10:45:56",
                    "id": 1
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not rate Tution.",
                "errors": {
                    "rating": [
                        "You have already rated this tution."
                    ]
                },
                "status_code": 422
            }

## Complete/Finished tution by Student / Tutor [POST /tutions/{id}/finished]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "rating": {
                    "rating": 3,
                    "reviews": null,
                    "user_id": 11,
                    "rateable_type": "App\\Models\\Profile",
                    "rateable_id": 6,
                    "updated_at": "2017-04-29 10:45:56",
                    "created_at": "2017-04-29 10:45:56",
                    "id": 1
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not rate Tution.",
                "errors": {
                    "rating": [
                        "You have already rated this tution."
                    ]
                },
                "status_code": 422
            }

# Messages [/messages]

## List of Communications [GET /messages]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "message": {
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
                            "id": 1,
                            "last_message": {
                                "id": 52,
                                "thread_id": "1",
                                "sender_id": "4",
                                "body": "I will be in meeting room",
                                "created_at": "2017-05-09 11:14:00"
                            },
                            "messages": [
                                {
                                    "id": 52,
                                    "thread_id": "1",
                                    "sender_id": "4",
                                    "body": "I will be in meeting room",
                                    "created_at": "2017-05-09 11:14:00"
                                }
                            ],
                            "participants": [
                                {
                                    "id": 1,
                                    "thread_id": "1",
                                    "user_id": "4",
                                    "last_read": "2017-05-09 13:12:32",
                                    "deleted_at": null,
                                    "user": {
                                        "id": 4,
                                        "username": "jamaal23",
                                        "email": "jamaal23@example.org",
                                        "created_at": "2017-05-03 07:25:41",
                                        "banned_at": null,
                                        "profile": {
                                            "name": "jamaal 23",
                                            "weight": null,
                                            "height": null,
                                            "gender": null,
                                            "dob": null,
                                            "biceps": null,
                                            "shoulders": null,
                                            "gym_name": null,
                                            "avatar": null,
                                            "ethnicity": null,
                                            "latitude": null,
                                            "longitude": null,
                                            "description": null
                                        }
                                    }
                                },
                                {
                                    "id": 2,
                                    "thread_id": "1",
                                    "user_id": "11",
                                    "last_read": null,
                                    "deleted_at": null,
                                    "user": {
                                        "id": 11,
                                        "username": "cecelia.mertz",
                                        "email": "jacquelyn20@example.com",
                                        "created_at": "2017-05-09 10:05:19",
                                        "banned_at": null,
                                        "profile": {
                                            "name": "Roslyn Smitham",
                                            "weight": "140.14",
                                            "height": "126.77",
                                            "gender": "M",
                                            "dob": "1977-12-30",
                                            "biceps": "24.57",
                                            "shoulders": "42.74",
                                            "gym_name": "Glover, Lubowitz and Torphy",
                                            "avatar": "http:\/\/lorempixel.com\/640\/480\/?18089",
                                            "ethnicity": "4",
                                            "latitude": "73.93778600",
                                            "longitude": "-94.09201300",
                                            "description": "I'm grown up now,' she added in a hurry. 'No, I'll look first,' she said, 'for her hair goes in such a puzzled expression that she knew the meaning of it in asking riddles that have no idea what."
                                        }
                                    }
                                }
                            ],
                            "pivot": {
                                "user_id": "4",
                                "thread_id": "1",
                                "last_read": "2017-05-09 13:12:32"
                            }
                        }
                    ]
                }
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

## List of Messages of Specific Thread [GET /messages/{id}]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "total": 52,
                "per_page": 3,
                "current_page": 1,
                "last_page": 18,
                "next_page_url": "http:\/\/localhost:8000\/api\/messages\/1?page=2",
                "prev_page_url": null,
                "from": 1,
                "to": 3,
                "data": [
                    {
                        "id": 52,
                        "thread_id": "1",
                        "sender_id": "4",
                        "body": "I will be in meeting room",
                        "created_at": "2017-05-09 11:14:00"
                    },
                    {
                        "id": 53,
                        "thread_id": "1",
                        "sender_id": "4",
                        "body": "I will be in meeting room",
                        "created_at": "2017-05-09 11:14:00"
                    },
                    {
                        "id": 49,
                        "thread_id": "1",
                        "sender_id": "4",
                        "body": "I will be in meeting room",
                        "created_at": "2017-05-09 11:13:59"
                    }
                ]
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
                        "user_id": "4",
                        "thread_id": "2",
                        "last_read": "2017-05-09 13:15:59"
                    }
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

# Proposal [/proposals]

## List of Proposals [GET /proposals]


+ Parameters
    + status: (integer, optional) - 1 = pending, 2 = accepted, 3 = rejected, 4 = with drawl

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "status": 1
            }

+ Response 200 (application/json)
    + Body

            {
                "total": 1,
                "per_page": 20,
                "current_page": 1,
                "last_page": 1,
                "next_page_url": null,
                "prev_page_url": null,
                "from": 1,
                "to": 1,
                "data": [
                    {
                        "id": 2,
                        "tutor_id": "5",
                        "tution_id": "3",
                        "status": "1",
                        "description": "This is cover letter",
                        "deleted_at": null,
                        "created_at": "2017-04-18 17:59:26",
                        "updated_at": "2017-04-18 17:59:26",
                        "tution": {
                            "id": 3,
                            "student_id": "11",
                            "tutor_id": null,
                            "status": "1",
                            "private": true,
                            "title": "Tution 1",
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
                            "created_at": "2017-04-12 17:32:05"
                        }
                    }
                ]
            }

## Submit Proposal by Tutor [POST /proposals]


+ Parameters
    + title: (string, required) - 
    + availability_from: (string, optional) - 
    + availability_to: (string, optional) - 
    + schedule: (string, optional) - 
    + attachments: (array, optional) - array of objects
    + tution_id: (integer, required) - 
    + description: (string, required) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "title": "title abc",
                "tution_id": 3,
                "description": "This is cover letter"
            }

+ Response 200 (application/json)
    + Body

            {
                "proposal": {
                    "tution_id": 3,
                    "description": "This is cover letter",
                    "tutor_id": 10,
                    "updated_at": "2017-04-18 17:32:47",
                    "created_at": "2017-04-18 17:32:47",
                    "id": 1
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not submit Proposal.",
                "errors": {
                    "tution_id": [
                        "You have already applied on this tution."
                    ]
                },
                "status_code": 422
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not submit Proposal.",
                "errors": {
                    "description": [
                        "The description id field is required."
                    ]
                },
                "status_code": 422
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not submit Proposal.",
                "errors": {
                    "tution_id": [
                        "The tution id field is required."
                    ]
                },
                "status_code": 422
            }

## View specific proposal [GET /proposals/{id}]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "proposal": {
                    "id": 1,
                    "tutor_id": "10",
                    "tution_id": "3",
                    "status": "1",
                    "description": "This is cover letter",
                    "deleted_at": null,
                    "created_at": "2017-04-18 17:32:47",
                    "updated_at": "2017-04-18 17:32:47",
                    "tution": {
                        "id": 3,
                        "student_id": "11",
                        "tutor_id": null,
                        "status": "1",
                        "private": true,
                        "title": "Tution 1",
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
                        "created_at": "2017-04-12 17:32:05"
                    }
                }
            }

## Update Proposal by Tutor [POST /proposals/{id}]


+ Parameters
    + description: (string, required) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "description": "This is cover letter"
            }

+ Response 200 (application/json)
    + Body

            {
                "proposal": {
                    "tution_id": 3,
                    "description": "This is cover letter",
                    "tutor_id": 10,
                    "updated_at": "2017-04-18 17:32:47",
                    "created_at": "2017-04-18 17:32:47",
                    "id": 1
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not submit Proposal.",
                "errors": {
                    "description": [
                        "The description id field is required."
                    ]
                },
                "status_code": 422
            }

## Withdrawl proposal by Tutor [POST /proposals/withdrawl/{id}]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "proposal": {
                    "id": 1,
                    "tutor_id": "10",
                    "tution_id": "3",
                    "status": 4,
                    "description": "Update: This is cover letter",
                    "deleted_at": null,
                    "created_at": "2017-04-18 17:32:47",
                    "updated_at": "2017-04-18 17:57:20",
                    "tution": {
                        "id": 3,
                        "student_id": "11",
                        "tutor_id": null,
                        "status": "1",
                        "private": true,
                        "title": "Tution 1",
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
                        "created_at": "2017-04-12 17:32:05"
                    }
                }
            }

## Accept proposal by Student [POST /proposals/accept/{id}]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "proposal": {
                    "id": 1,
                    "tutor_id": "10",
                    "tution_id": "3",
                    "status": 4,
                    "description": "Update: This is cover letter",
                    "deleted_at": null,
                    "created_at": "2017-04-18 17:32:47",
                    "updated_at": "2017-04-18 17:57:20",
                    "tution": {
                        "id": 3,
                        "student_id": "11",
                        "tutor_id": null,
                        "status": "1",
                        "private": true,
                        "title": "Tution 1",
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
                        "created_at": "2017-04-12 17:32:05"
                    }
                }
            }

## Reject proposal by Student [POST /proposals/reject/{id}]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "proposal": {
                    "id": 1,
                    "tutor_id": "10",
                    "tution_id": "3",
                    "status": 4,
                    "description": "Update: This is cover letter",
                    "deleted_at": null,
                    "created_at": "2017-04-18 17:32:47",
                    "updated_at": "2017-04-18 17:57:20",
                    "tution": {
                        "id": 3,
                        "student_id": "11",
                        "tutor_id": null,
                        "status": "1",
                        "private": true,
                        "title": "Tution 1",
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
                        "created_at": "2017-04-12 17:32:05"
                    }
                }
            }

# Invitation [/invitations]

## List of Invitations [GET /invitations]


+ Parameters
    + status: (integer, optional) - 1 = pending, 2 = accepted, 3 = rejected, 4 = with drawl

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "total": 1,
                "per_page": 20,
                "current_page": 1,
                "last_page": 1,
                "next_page_url": null,
                "prev_page_url": null,
                "from": 1,
                "to": 1,
                "data": [
                    {
                        "id": 6,
                        "tutor_id": "6",
                        "tution_id": "31",
                        "status": "1",
                        "end_date": null,
                        "grade": "A1",
                        "attachments": [
                            "attachments\/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt",
                            "attachments\/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"
                        ],
                        "description": "test",
                        "message": null,
                        "deleted_at": null,
                        "created_at": "2017-05-12 10:01:28",
                        "updated_at": "2017-05-12 10:01:28",
                        "tution": {
                            "id": 31,
                            "student_id": "11",
                            "tutor_id": null,
                            "status": "1",
                            "private": false,
                            "title": "Tution 7",
                            "budget": "100 dollar",
                            "latitude": "11.45609800",
                            "longitude": "-51.78216000",
                            "start_date": "2019-08-12",
                            "daily_timing": "05:00:00",
                            "city": null,
                            "state": null,
                            "date": null,
                            "time": null,
                            "attachments": [],
                            "day_of_week_0": true,
                            "day_of_week_1": true,
                            "day_of_week_2": true,
                            "day_of_week_3": true,
                            "day_of_week_4": true,
                            "day_of_week_5": true,
                            "day_of_week_6": true,
                            "description": null,
                            "created_at": "2017-05-11 10:11:33",
                            "subjects": [
                                "English",
                                "Urdu"
                            ],
                            "last_class": "",
                            "answers": [],
                            "student": {
                                "id": 13,
                                "gender": "M",
                                "name": "Sam",
                                "avatar": "uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg",
                                "latitude": "-69.92557000",
                                "longitude": "-144.58138800",
                                "address": "My locatio",
                                "phone_number": "+1-548-519-6469",
                                "bio": "Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.",
                                "hourly_rate": "12.00",
                                "radius": "5000",
                                "experience": "1",
                                "stage_complete": null,
                                "teaches": null,
                                "city": null,
                                "state": null,
                                "paypal_address": null,
                                "specialist": null,
                                "qualifications": [
                                    "Mba",
                                    "Bs"
                                ],
                                "average_rating": "3.0000",
                                "completed_tutions": 2,
                                "avatar_url": "http:\/\/localhost:8000\/uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg",
                                "total_hours": 5,
                                "user": {
                                    "id": 11,
                                    "email": "cleta71@example.net",
                                    "user_type": "2",
                                    "created_at": "2017-04-06 05:28:03"
                                }
                            }
                        }
                    }
                ]
            }

## Submit Invitation by Student [POST /invitations]


+ Parameters
    + attachments: (array, optional) - array of objects
    + description: (string, optional) - 
    + grade: (string, optional) - 
    + end_date: (string, optional) - 
    + tution_id: (integer, required) - 
    + tutor_id: (integer, required) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "tutor_id": 7,
                "tution_id": 3,
                "attachments": [
                    "attachments/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt",
                    "attachments/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"
                ]
            }

+ Response 200 (application/json)
    + Body

            {
                "invitation": {
                    "tutor_id": 7,
                    "tution_id": 3,
                    "attachments": [
                        "attachments/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt",
                        "attachments/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"
                    ],
                    "updated_at": "2017-04-18 18:15:06",
                    "created_at": "2017-04-18 18:15:06",
                    "id": 1
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not submit Invitation.",
                "errors": {
                    "tution_id": [
                        "You have already sent invitation of this tutor."
                    ]
                },
                "status_code": 422
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not submit Invitation.",
                "errors": {
                    "tution_id": [
                        "The tution id field is required."
                    ]
                },
                "status_code": 422
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not submit Invitation.",
                "errors": {
                    "tutor_id": [
                        "The tutor id field is required."
                    ]
                },
                "status_code": 422
            }

## View specific invitation [GET /invitations/{id}]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "invitation": {
                    "id": 1,
                    "tutor_id": "10",
                    "tution_id": "3",
                    "status": "1",
                    "description": "This is cover letter",
                    "deleted_at": null,
                    "created_at": "2017-04-18 17:32:47",
                    "updated_at": "2017-04-18 17:32:47",
                    "tution": {
                        "id": 3,
                        "student_id": "11",
                        "tutor_id": null,
                        "status": "1",
                        "private": true,
                        "title": "Tution 1",
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
                        "created_at": "2017-04-12 17:32:05"
                    }
                }
            }

## Update Invitation [POST /invitations/{id}]


+ Parameters
    + description: (string, required) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "description": "This is cover letter"
            }

+ Response 200 (application/json)
    + Body

            {
                "invitation": {
                    "tution_id": 3,
                    "description": "This is cover letter",
                    "tutor_id": 10,
                    "updated_at": "2017-04-18 17:32:47",
                    "created_at": "2017-04-18 17:32:47",
                    "id": 1
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not update Invitation.",
                "errors": {
                    "description": [
                        "The description id field is required."
                    ]
                },
                "status_code": 422
            }

## Reject invitation by Tutor [POST /invitations/reject/{id}]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "invitation": {
                    "id": 1,
                    "tutor_id": "10",
                    "tution_id": "3",
                    "status": 3,
                    "description": "Update: This is cover letter",
                    "deleted_at": null,
                    "created_at": "2017-04-18 17:32:47",
                    "updated_at": "2017-04-18 17:57:20",
                    "tution": {
                        "id": 3,
                        "student_id": "11",
                        "tutor_id": null,
                        "status": "1",
                        "private": true,
                        "title": "Tution 1",
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
                        "created_at": "2017-04-12 17:32:05"
                    }
                }
            }

## Accept Invitation by Tutor [POST /invitations/accept/{id}]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "proposal": {
                    "id": 1,
                    "tutor_id": "10",
                    "tution_id": "3",
                    "status": 4,
                    "description": "Update: This is cover letter",
                    "deleted_at": null,
                    "created_at": "2017-04-18 17:32:47",
                    "updated_at": "2017-04-18 17:57:20",
                    "tution": {
                        "id": 3,
                        "student_id": "11",
                        "tutor_id": null,
                        "status": "1",
                        "private": true,
                        "title": "Tution 1",
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
                        "created_at": "2017-04-12 17:32:05"
                    }
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not accept Invitation.",
                "errors": {
                    "description": [
                        "The description id field is required."
                    ]
                },
                "status_code": 422
            }

# CreditCard [/credit-cards]

## List of CreditCards [GET /credit-cards]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "credit_card": {
                    "id": 1,
                    "user_id": "15",
                    "name": null,
                    "month": "11",
                    "year": "2018",
                    "card_number": "4242-4242-4242-4242",
                    "cvc": "123"
                }
            }

## Add/Edit CreditCard [POST /credit-cards]


+ Parameters
    + month: (integer, required) - 
    + year: (integer, required) - 
    + card_number: (string, required) - 
    + cvc: (integer, required) - 
    + name: (string, optional) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "month": "11",
                "year": "2018",
                "card_number": "4242-4242-4242-4242",
                "cvc": 123
            }

+ Response 200 (application/json)
    + Body

            {
                "credit_card": {
                    "id": 1,
                    "user_id": "15",
                    "name": null,
                    "month": "11",
                    "year": "2018",
                    "card_number": "4242-4242-4242-4242",
                    "cvc": "123"
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not update credit card information.",
                "errors": {
                    "month": [
                        "The month field is required."
                    ],
                    "year": [
                        "The year field is required."
                    ],
                    "card_number": [
                        "The card number field is required."
                    ],
                    "cvc": [
                        "The cvc field is required."
                    ]
                },
                "status_code": 422
            }

# Lecture [/lectures]

## List of Lectures [GET /lectures]


+ Parameters
    + tution_id: (integer, optional) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "total": 1,
                "per_page": 20,
                "current_page": 1,
                "last_page": 1,
                "next_page_url": null,
                "prev_page_url": null,
                "from": 1,
                "to": 1,
                "data": [
                    {
                        "id": 1,
                        "tution_id": "3",
                        "start_time": "2017-06-04 12:19:48",
                        "end_time": "2017-06-04 12:24:48",
                        "goals": "This is cover letter",
                        "reviews": "reviews reviews reviews, reviews",
                        "lecture_number": "1",
                        "progress": "10",
                        "attachments": [
                            "attachments\/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt",
                            "attachments\/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"
                        ],
                        "created_at": "2017-06-04 12:19:48",
                        "updated_at": "2017-06-04 12:24:48",
                        "deleted_at": null
                    }
                ]
            }

## Start Lecture [POST /lectures/start]


+ Parameters
    + tution_id: (integer, required) - 
    + goals: (string, required) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "tution_id": 3,
                "goals": "This is cover letter"
            }

+ Response 200 (application/json)
    + Body

            {
                "lecture": {
                    "tution_id": 3,
                    "goals": "This is cover letter",
                    "lecture_number": 1,
                    "start_time": "2017-06-04 12:19:48",
                    "updated_at": "2017-06-04 12:19:48",
                    "created_at": "2017-06-04 12:19:48",
                    "id": 1
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not start Lecture.",
                "errors": {
                    "tution_id": [
                        "The tution id field is required."
                    ]
                },
                "status_code": 422
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not start Lecture.",
                "errors": {
                    "tution_id": [
                        "You have already started lecture."
                    ]
                },
                "status_code": 422
            }

## End lecture [POST /lectures/{lecture_id}/end]


+ Parameters
    + attachments: (array, optional) - array of objects
    + reviews: (string, required) - 

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "reviews": "reviews reviews reviews, reviews",
                "progress": 10,
                "attachments": [
                    "attachments/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt",
                    "attachments/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"
                ]
            }

+ Response 200 (application/json)
    + Body

            {
                "lecture": {
                    "id": 1,
                    "tution_id": "3",
                    "start_time": "2017-06-04 12:19:48",
                    "end_time": "2017-06-04 12:24:48",
                    "goals": "This is cover letter",
                    "reviews": "reviews reviews reviews, reviews",
                    "lecture_number": "1",
                    "progress": 10,
                    "attachments": [
                        "attachments\/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt",
                        "attachments\/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"
                    ],
                    "created_at": "2017-06-04 12:19:48",
                    "updated_at": "2017-06-04 12:24:48",
                    "deleted_at": null
                }
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not end Lecture.",
                "errors": {
                    "tution_id": [
                        "You have already ended lecture."
                    ]
                },
                "status_code": 422
            }

# Uploads [/uploads]

## Upload Attachments [POST /uploads]


+ Parameters
    + attachments: (array, required) - 

+ Response 200 (application/json)
    + Body

            [
                "attachments/m5YVZqMJagSdoUxalVFe5CYfPVmhPOvjFPgLlkkt.txt",
                "attachments/hMdyme9xiDBmN577nuDiGo4o5qGs8qtI3YsqdMCj.html"
            ]

+ Response 422 (application/json)
    + Body

            {
                "message": "Could not upload attachments.",
                "errors": {
                    "attachments": [
                        "Attachments is required."
                    ]
                },
                "status_code": 422
            }