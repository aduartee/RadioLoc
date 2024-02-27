# Using php with Apache
FROM php:7.1-apache

# Update packages and install PHP extensions (PDO and PDO MySQL)
RUN apt-get update && apt-get install -y \
    && docker-php-ext-install pdo pdo_mysql

# Update packages and install Mysql on image
RUN apt-get update && apt-get install -y \
    default-mysql-server \
    && rm -rf /var/lib/apt/lists/*

# Copy the project to the working directory
COPY . /var/www/html/radioloc

# Copy the contents of the public directory to the working directory of Apache
COPY public/ /var/www/html/radioloc/public/

# Configure ServerName for Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure Apache to use the public directory as DocumentRoot
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/radioloc/public|g' /etc/apache2/sites-available/000-default.conf

# Enable Apache rewrite module
RUN a2enmod rewrite

# Define the build port
ARG PORT_BUILD=8081
# Set the environment variable for the port
ENV PORT=$PORT_BUILD
# Expose the project on the specified port
EXPOSE $PORT_BUILD

# Run the command to start Apache server
ENTRYPOINT ["apache2-foreground"]
