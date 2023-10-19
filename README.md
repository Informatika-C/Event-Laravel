# Event Kampus

## Installation
```bash
git clone https://github.com/Informatika-C/Event-Laravel
cd Event-Laravel
```
## Set Up
```bash
composer install
```
copy file .env.exemple dan paste menjadi .env dan sesuaikan data di dalam .env

## Set Up Database
```bash
php artisan migrate:refresh --seed
```
## Run Development
```bash
php artisan serve
```
jalankan 127.0.0.1:8000    
lalu generate key

## Informasi Akun
## Admin
```
nama = Admin
email = admin@gmail.com
password = katasandi
```
## User
```
nama = User
email = user@gmail.com
password = user
```
