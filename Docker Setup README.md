# PHP MySQL Docker Environment

A Docker-based development environment for PHP applications with Nginx, MySQL, and phpMyAdmin.

## Stack Components

- **PHP 8.2-FPM** - PHP processor
- **Nginx** - Web server
- **MySQL 8.0** - Database server
- **phpMyAdmin** - Database management interface

## Prerequisites

- Docker Engine 20.10+
- Docker Compose 3.9+

## Project Structure

```
.
├── docker-compose.yml
├── Dockerfile
├── nginx/
│   └── default.conf
└── src/
    └── (your PHP application files)
```

## Installation & Setup

1. **Clone or create the project directory**
   ```bash
   mkdir my-php-project
   cd my-php-project
   ```

2. **Create the required directories**
   ```bash
   mkdir -p src nginx
   ```

3. **Place your configuration files**
   - `docker-compose.yml` in the root
   - `Dockerfile` in the root
   - `default.conf` in the `nginx/` directory

4. **Add your PHP application**
   - Place your PHP files in the `src/` directory

5. **Start the containers**
   ```bash
   docker-compose up -d
   ```

6. **Stop the containers**
   ```bash
   docker-compose down
   ```

## Access Points

| Service | URL | Purpose |
|---------|-----|---------|
| Web Application | http://localhost:8080 | Your PHP application |
| phpMyAdmin | http://localhost:8081 | Database management |
| MySQL | localhost:3307 | Direct database connection |

## Database Configuration

### Default Credentials

- **Root Password:** `root`
- **Database Name:** `mydb`
- **Username:** `user`
- **Password:** `password`

### Connecting from PHP

```php
<?php
$host = 'mysql';
$db = 'mydb';
$user = 'user';
$pass = 'password';

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
?>
```

### Connecting from External Tools

- **Host:** `localhost`
- **Port:** `3307`
- **Database:** `mydb`
- **Username:** `user`
- **Password:** `password`

## Docker Commands

### Start services
```bash
docker-compose up -d
```

### Stop services
```bash
docker-compose down
```

### Rebuild containers
```bash
docker-compose up -d --build
```

### View logs
```bash
docker-compose logs -f
```

### View specific service logs
```bash
docker-compose logs -f php
docker-compose logs -f nginx
docker-compose logs -f mysql
```

### Access container shell
```bash
docker exec -it php-app bash
docker exec -it nginx-server bash
docker exec -it mysql-db bash
```

### Restart a specific service
```bash
docker-compose restart php
docker-compose restart nginx
docker-compose restart mysql
```

## PHP Extensions Installed

- PDO
- PDO MySQL
- MySQLi

## Volume Persistence

- MySQL data is persisted in a Docker volume named `mysql_data`
- Application files are mounted from `./src` to `/var/www/html`

## Troubleshooting

### Port already in use
If ports 8080, 8081, or 3307 are already in use, modify the port mappings in `docker-compose.yml`:

```yaml
ports:
  - "YOUR_PORT:80"  # Change YOUR_PORT to an available port
```

### Permission issues
If you encounter permission errors:
```bash
sudo chown -R $USER:$USER src/
```

### Cannot connect to MySQL
- Ensure the MySQL container is running: `docker-compose ps`
- Check MySQL logs: `docker-compose logs mysql`
- Wait a few seconds after starting for MySQL to initialize

### Nginx 502 Bad Gateway
- Verify PHP-FPM is running: `docker-compose ps`
- Check PHP logs: `docker-compose logs php`
- Restart services: `docker-compose restart`

## Development Workflow

1. Place your PHP files in the `src/` directory
2. Changes are immediately reflected (no rebuild needed)
3. Access your application at http://localhost:8080
4. Use phpMyAdmin at http://localhost:8081 for database management

## Security Notes

⚠️ **Important:** This configuration is for development only. For production:
- Change all default passwords
- Use environment variables for credentials
- Enable SSL/TLS
- Configure proper firewall rules
- Remove phpMyAdmin or restrict access

## Customization

### Adding PHP Extensions
Edit the `Dockerfile` and add:
```dockerfile
RUN docker-php-ext-install extension_name
```

### Modifying Nginx Configuration
Edit `nginx/default.conf` and restart:
```bash
docker-compose restart nginx
```

### Changing MySQL Configuration
Add to the `mysql` service in `docker-compose.yml`:
```yaml
command: --default-authentication-plugin=mysql_native_password
```

## License

MIT License

## Contributing

Feel free to submit issues and enhancement requests!