### Create a New Person

**Endpoint**: `PUT /api`

**Request Format**:
```json
{
    "name": "John Wanjiku",
    "phone": "123456789",
    "email": "johnwan@example.com"
}
```

**Response Format (Success)**:
```json
{
    "message": "Person created successfully"
}
```

**Response Format (Error)**:
```json
{
    "message": "Failed to create person"
}
```

### Update Person Information

**Endpoint**: `PATCH /api/{id}`

**Request Format**:
```json
{
    "name": "Updated Name",
    "phone": "987-654-3210",
    "email": "updatedemail@example.com"
}
```

**Response Format (Success)**:
```json
{
    "message": "Person updated successfully"
}
```

**Response Format (Error)**:
```json
{
    "message": "Failed to update person"
}
```

### Retrieve Person Information

**Endpoint**: `GET /api/{id}`

**Response Format (Success)**:
```json
{
    "person": {
        "id": 1,
        "name": "John Wanjiku",
        "phone": "254123456789",
        "email": "johndoe@example.com"
    }
}
```

**Response Format (Error)**:
```json
{
    "message": "Failed to get person"
}
```

### Delete Person

**Endpoint**: `DELETE /api/{id}`

**Response Format (Success)**:
```json
{
    "message": "Person Deleted"
}
```

**Response Format (Error)**:
```json
{
    "message": "Failed to delete person"
}
```

#### Sample Usage

Here are some sample API requests and their expected responses:

### Create a New Person

**Request**:
```http
PUT /api
Content-Type: application/json

{
    "name": "Jane Smith",
    "phone": "712345678",
    "email": "janesmith@example.com"
}
```

**Response (HTTP 201 Created)**:
```json
{
    "message": "Person created successfully"
}
```

### Update Person Information

**Request**:
```http
PATCH /api/1
Content-Type: application/json

{
    "name": "Updated Name",
    "phone": "712345679",
    "email": "updated@example.com"
}
```

**Response (HTTP 200 OK)**:
```json
{
    "message": "Person updated successfully"
}
```

### Retrieve Person Information

**Request**:
```http
GET /api/1
```

**Response (HTTP 200 OK)**:
```json
{
    "person": {
        "id": 1,
        "name": "John Wanjiku",
        "phone": "254712345679",
        "email": "updated@example.com"
    }
}
```

### Delete Person

**Request**:
```http
DELETE /api/1
```

**Response (HTTP 200 OK)**:
```json
{
    "message": "Person Deleted"
}
```

#### Known Limitations and Assumptions

- This API assumes that the incoming data is in JSON format.
- It assumes that phone numbers provided in requests are formatted as "123456789".
- Error responses are in JSON format and include a "message" field to provide information about the error.
- OpenLItespeed webserver will required .htaccess configuring to treat parameters after api/ as query parameters and not folders.
- Assumes the user will always make the specified request types.