### Instrukcja odpalenia apki

- Budujemy dockera `DEV` komendą `docker-compose -f docker-compose-dev.yml up -d`
- Wchodzimy w dockera komendą `docker exec -it php-container bash` i wykonujemy następujące komendy:
    * `composer install` - instalacja libek
    * `php bin/console d:m:m` - migracja bazy danych

Przykładowe requesty i response:
- Strzał POST pod adresem `localhost:15600/reception/add` z body (json) dodaje nową możliwą godzinę umówienia wizyty:
{
    "time": "11:20"
}

-Przykładowy response:
{
    "id": 12,
    "time": "11:20"
}

- Strzał `POST` pod adresem `localhost:15600/booking/add` z body (json) dodaje nową rezerwację:
{
    "registrationNumber" : "ZS1111",
    "date": "2023-12-12",
    "time": "11:20"
}
Przykładowy response:
{
    "id": 172,
    "registrationNumber": "ZS785AJsadaasa",
    "date": "2023-12-12T00:00:00+00:00",
    "time": "19:20"
}

- Strzał `POST` pod adresem `localhost:15600/booking/freedates` z podanym niżej form data np. key date, value 2012-12-12 w postman pokazuje nam dostępne wolne godziny w dany dzień:

Przykład response:
{
    "data": [
        {
            "time": "12:00"
        },
        {
            "time": "17:00"
        },
        {
            "time": "17:07"
        },
        {
            "time": "17:08"
        },
        {
            "time": "12:20"
        },
        {
            "time": "19:13"
        },
        {
            "time": "19:23"
        },
        {
            "time": "19:20"
        }
    ]
}

- Strzał `GET` pod adresem `localhost:15600/booking/get?page=5` ukazuje nam 5 stronę dodanych rezerwacji:
Przykład response:
{
    "data": [
        {
            "id": 44,
            "registrationNumber": "GDA5464",
            "date": "2015-08-12",
            "time": "10:00"
        },
        {
            "id": 45,
            "registrationNumber": "GDA5464",
            "date": "2015-08-12",
            "time": "10:00"
        },
        {
            "id": 46,
            "registrationNumber": "GDA5464",
            "date": "2015-08-12",
            "time": "10:00"
        },
        {
            "id": 47,
            "registrationNumber": "GDA5464",
            "date": "2015-08-12",
            "time": "10:00"
        },
        {
            "id": 48,
            "registrationNumber": "GDA5464",
            "date": "2015-08-12",
            "time": "10:00"
        },
        {
            "id": 49,
            "registrationNumber": "GDA5464",
            "date": "2015-08-12",
            "time": "10:00"
        },
        {
            "id": 50,
            "registrationNumber": "GDA5464",
            "date": "2015-08-12",
            "time": "10:00"
        },
        {
            "id": 51,
            "registrationNumber": "GDA5464",
            "date": "2015-08-12",
            "time": "10:00"
        },
        {
            "id": 52,
            "registrationNumber": "GDA5464",
            "date": "2015-08-12",
            "time": "10:00"
        },
        {
            "id": 53,
            "registrationNumber": "GDA5464",
            "date": "2015-08-12",
            "time": "10:00"
        }
    ],
    "totalItemCount": 166,
    "currentPage": 5
}
