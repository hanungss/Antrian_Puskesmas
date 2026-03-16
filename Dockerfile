# Menggunakan image PHP dengan Apache
FROM php:8.2-apache

# Salin semua file proyek ke dalam folder standar web server Apache
COPY . /var/www/html/

# Berikan izin akses (permission) agar PHP bisa menulis ke file .txt dan .json
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

# Jalankan Apache di port 80
EXPOSE 80