FROM php:8.2-cli

# Install dependencies yang dibutuhkan sistem
RUN apt-get update -y && apt-get install -y libsqlite3-dev unzip

# Panggil Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Atur folder kerja di dalam server
WORKDIR /app
COPY . .

# Install dependensi Laravel (tanpa paket dev)
RUN composer install --optimize-autoloader --no-dev

# Bikin file database SQLite kosong
RUN touch database/database.sqlite

# Berikan izin akses folder
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache /app/database

# Buka port 8000
EXPOSE 8000

# Mantra pamungkas saat server nyala: Link Storage, Migrasi DB, dan Jalankan Server
CMD php artisan storage:link && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000