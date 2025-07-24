# StudyHive API Contract

This document serves as the single source of truth for the StudyHive API.

---

## Authentication

### 1. User Registration

Creates a new user account and returns the user object along with an API token.

- **Endpoint:** `POST /api/register`
- **Description:** Creates a new user account.
- **Request Body:**
  ```
  {
    "name": "String",
    "email": "String (must be a valid email)",
    "password": "String (min 8 characters)",
    "password_confirmation": "String (must match password)"
  }
  ```

**Success Response (Code 201 Created):**
```
{
  "message": "User registered successfully.",
  "user": {
    "id": 1,
    "name": "Masum Billah",
    "email": "masum@example.com"
  },
  "token": "xxxxxxxxxxxxx_some_api_token_xxxxxxxx"
}
```

**Error Response (Code 422 Unprocessable Content):**
```
{
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "The email has already been taken."
    ]
  }
}
```

### 2. User Login

Authenticates a user with their email and password, returning the user object and a new API token.

- **Endpoint:** `POST /api/login`
- **Description:** Authenticates a user and returns a session token.
- **Request Body:**
  ```
  {
    "email": "String",
    "password": "String"
  }
  ```

**Success Response (Code 200 OK):**
```
{
  "message": "Login successful.",
  "user": {
    "id": 1,
    "name": "Masum Billah",
    "email": "masum@example.com"
  },
  "token": "xxxxxxxxxxxxx_some_api_token_xxxxxxxx"
}
```

**Error Response (Code 401 Unauthorized):**
```
{
  "message": "Invalid credentials."
}
```