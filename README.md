# Laravel x Magic : Demo Application

## Laravel API Authorization with Magic Link

A tutorial to demonstrate how to add authorization to a Laravel API with [Magic's Laravel Plugin](https://github.com/magiclabs/magic-laravel).

# Quickstart

```bash
$ git clone https://github.com/magiclabs/example-laravel-api.git
$ cd example-laravel-api
```

## Get your Magic Secret Key

Sign Up with [Magic](https://dashboard.magic.link/signup) and get your **`MAGIC_SECRET_KEY`**.

![Dashboard Image](https://dev-to-uploads.s3.amazonaws.com/i/fnjqvscslu11ih87p94t.png)

## Update .env

```text

MAGIC_SECRET_API_KEY=sk_test_123456789

```

## Obtain DID Token

### Fork the template code on Codesandbox

To get the DID Token for testing, fork our [Laravel API Authorization template](https://codesandbox.io/s/boring-fog-laravel-didt-x6b6x) in CodeSandBox.

### Update the MAGIC_PUBLISHABLE_KEY

![Dashboard Image](https://dev-to-uploads.s3.amazonaws.com/i/fnjqvscslu11ih87p94t.png)

Replace the `pk_test_5A2E52658C87281B` string with your `Publishable API Key` from the Magic Dashboard: on `line 46`

```javascript
/* 2️⃣ Initialize Magic Instance */
const magic = new Magic("Publishable API Key");
```

### Live Frontend Application

You now have a working Frontend Application.

Login and copy the `DID Token` for Testing the API with Postman.

# Protect API Endpoints

The routes shown below are available for the following requests:

-   `GET /api/public`: available for non-authenticated requests
-   `GET /api/private`: available for authenticated requests containing a DID Token

# Using API

The `/api/private` route is now only accessible if a valid DID Token is included in the `Authorization` header of the incoming request.

Now, let’s start the Laravel server locally:

```bash
php artisan serve --port=8001
```

Send a `GET` request to the public route - `http://localhost:8001/api/public` - and you should receive back:

```javascript
{
    "message": "Hello from a public endpoint! You don't need to be authenticated to see this."
}
```

![GET http://localhost:8001/api/public](https://dev-to-uploads.s3.amazonaws.com/i/hvoef2s6y09loe0dmdwc.png)

Now send a `GET` request to the private route - `http://localhost:8001/api/private` - and you should get a 401 status and the following message:

```javascript
{ "message": "Bearer token missing" }
```

![GET http://localhost:8001/api/private without Bearer Token](https://dev-to-uploads.s3.amazonaws.com/i/mv5euab219ql5g8z1xdl.png)

Add an `Authorization` header set to `Bearer DID_TOKEN` using the token generated above. Send the `GET` request to the private route again and you should see:

```javascript
{
    "message": "Hello from a private endpoint! You need to have a valid DID Token to see this.",
    "user": {
        "email": "your_email@provide.com",
        "issuer": "did:ethr:0xaa12b334C1f3d……….62367e5B8e",
        "public_address": "0xaa12b334C1f3d……….62367e5B8e"
    }
}
```

![GET http://localhost:8001/api/private with Bearer Token](https://dev-to-uploads.s3.amazonaws.com/i/vehxyrewsh22w5fasdan.png)

## License

The Laravel API Authorization with Magic Example is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
