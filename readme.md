<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

![GitHub repo size](https://img.shields.io/github/repo-size/hikmetkutuk/laravel-jwt-auth?color=inactive&logo=github&style=for-the-badge)
![Php](https://img.shields.io/static/v1?&logo=php&label=php&message=8.2.12&color=7a86b8&style=for-the-badge)
![Laravel](https://img.shields.io/static/v1?&logo=laravel&label=laravel&message=11.7.0&color=ff2d20&style=for-the-badge)
![Postgres](https://img.shields.io/static/v1?&logo=postgresql&label=postgre%20sql&message=15.5&color=336791&style=for-the-badge)

---

- [x] Project setup
- [x] Db connection
- [x] Jwt install
- [ ] Register
- [ ] Login
- [ ] Refresh token
- [ ] Logout
- [ ] Swagger documentation

---

``composer create-project laravel/laravel jwt-auth``

``php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"``

``php artisan jwt:secret``

``php artisan make:controller AuthController``
