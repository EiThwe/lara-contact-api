# Laraval Contact Api

## Api Reference

### Authentication

__Login__ `POST`

```
 http://127.0.0.1:8000/api/v1/login
```

Arguments  |  Type  |  Description
-----------|--------|-------------
email      | string | **Required** tth@gmail.com
password   | string | **Required** 11223344

__Register__ `POST`

```
 http://127.0.0.1:8000/api/v1/register
```

Arguments  |  Type  |  Description
-----------|--------|-------------
name      | string | **Required** Thwe Thwe
email      | string | **Required** tth@gmail.com
password   | string | **Required** 11223344  

### Contacts

__Get Contacts__ `GET`

```
 http://127.0.0.1:8000/api/v1/contact?page=1
```

__Get Contact__ `GET`

```
 http://127.0.0.1:8000/api/v1/contact/:id
```

__Create Contact__ `POST`

```
 http://127.0.0.1:8000/api/v1/contact
```

Arguments  |  Type  |  Description
-----------|--------|-------------
name      | string | **Required** Chit Chit
country_code      | string | **Required** 95
phone_number   | string | **Required** 96996996

__Update Contact__ `PUT`

```
 http://127.0.0.1:8000/api/v1/contact/:id
```

Arguments  |  Type  |  Description
-----------|--------|-------------
name      | string | **Required** Chit Chit
country_code      | string | **Required** 95
phone_number   | string | **Required** 96996996

__Delete Contact__ `DELETE`

```
 http://127.0.0.1:8000/api/v1/contact/:id
```

### Profile

__All Devices__ `GET`

```
 http://127.0.0.1:8000/api/v1/devices
```

__Logout All Devices__ `GET`

```
 http://127.0.0.1:8000/api/v1/logout-all
```
