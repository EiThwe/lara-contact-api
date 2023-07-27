# Laraval Contact Api

## Api Reference
_All api services need bearer_token to access_

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

  __Logout__ `POST`

```
 http://127.0.0.1:8000/api/v1/logout
```

### Contacts

__Get Contacts__ `GET`

```
 http://127.0.0.1:8000/api/v1/contact?page=1
```

__Get Single Contact__ `GET`

```
 http://127.0.0.1:8000/api/v1/contact/{id}
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

__Update Contact__ `PUT/PATCH`

```
 http://127.0.0.1:8000/api/v1/contact/{id}
```
__You can update single parameter or more__

Arguments  |  Type  |  Description
-----------|--------|-------------
name      | string | **Required** Chit Chit
country_code      | string | **Required** 95
phone_number   | string | **Required** 96996996

__Delete Contact__ `DELETE`

```
 http://127.0.0.1:8000/api/v1/contact/{id}
```

### Profile

__All Devices__ `GET`

```
 http://127.0.0.1:8000/api/v1/devices
```

__Logout All Devices__ `POST`

```
 http://127.0.0.1:8000/api/v1/logout-all
```
### Search

__Search__ `GET`  

```
 http://127.0.0.1:8000/api/v1/contacts?keyword={keyword}
```
__Get Search Records__ `GET`  

```
 http://127.0.0.1:8000/api/v1/search-records
```
__Delete Search Record__ `DELETE`  

```
 http://127.0.0.1:8000/api/v1/search-records/{id}
```

  ### Favourites

__Get Favourites__ `GET`  

```
 http://127.0.0.1:8000/api/v1/favourites
```
__Add Favourite__ `POST`  

```
 http://127.0.0.1:8000/api/v1/favourites
```
__Delete Favourite__ `DELETE`  

```
 http://127.0.0.1:8000/api/v1/favourites/{id}
```
