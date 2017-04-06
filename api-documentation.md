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
                        "address": "test"
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
                "address": "test"
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
                "address": "test"
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