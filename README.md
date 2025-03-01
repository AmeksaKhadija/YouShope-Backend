# CoffeeWithDeveloper

## API Reference

#### Register 

```http
  POST /auth/register
  Default ROLE => ROLE_Admin
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `first_name` | `string` | **required_max:50**. |
| `last_name` | `string` | **required_max:50**. |
| `email` | `string` | **required_unique:users,email**. |
| `phone` | `string` | **sometimes_required_unique:users,phone_digits_between:10:20**. |
| `password` | `string` | **required_min:6**. |
| `gender` | `string` | **sometimes_max:20**. |

#### Login

```http
  POST /auth/login
  Desponse : SANCTUM_Token
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **required_email_exists:users,email**. |
| `password`      | `string` | **Required**. |


#### add Product
