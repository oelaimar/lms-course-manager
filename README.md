# LMS Course Manager

A modern, Docker-based Learning Management System for managing courses and sections. Built with PHP, MySQL, and a clean, responsive UI.

## Features

- **Course Management**
  - Create, edit, and delete courses
  - Organize courses by difficulty level (Beginner, Intermediate, Advanced)
  - Rich course descriptions
  - Automatic timestamp tracking

- **Section Management**
  - Add multiple sections to each course
  - Order sections by position
  - Edit and delete sections
  - View all sections for a specific course

- **User Interface**
  - Modern, responsive design
  - Toast notifications for user actions
  - Modal-based forms for creating and editing
  - Clean card-based layout
  - Mobile-friendly interface

- **Technical Features**
  - TypeScript support for type-safe JavaScript
  - Dockerized environment for easy deployment
  - MySQL database with automatic initialization
  - phpMyAdmin for database management
  - Nginx web server with PHP-FPM

## Technology Stack

- **Backend**: PHP 8.2
- **Database**: MySQL 8.0
- **Web Server**: Nginx
- **Frontend**: HTML5, CSS3, TypeScript/JavaScript
- **Containerization**: Docker & Docker Compose
- **Database Admin**: phpMyAdmin

## Prerequisites

- Docker Engine 20.10+
- Docker Compose 3.9+
- (Optional) Node.js with TypeScript for development

## Quick Start

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd oelaimar-lms-course-manager
   ```

2. **Start the application**
   ```bash
   docker-compose up -d
   ```

3. **Access the application**
   - LMS Application: http://localhost:8080
   - phpMyAdmin: http://localhost:8081

4. **Stop the application**
   ```bash
   docker-compose down
   ```

## Project Structure

```
oelaimar-lms-course-manager/
├── README.md                    # This file
├── Docker Setup README.md       # Detailed Docker setup guide
├── docker-compose.yml           # Docker services configuration
├── Dockerfile                   # PHP container configuration
├── tsconfig.json               # TypeScript configuration
├── database/
│   └── init.sql                # Database initialization script
├── nginx/
│   └── default.conf            # Nginx configuration
└── src/
    ├── index.php               # Main entry point
    ├── courses_*.php           # Course CRUD operations
    ├── sections_*.php          # Section CRUD operations
    └── assets/
        ├── css/
        │   └── style.css       # Application styles
        ├── includes/
        │   ├── config.php      # Database configuration
        │   ├── header.php      # Common header
        │   └── footer.php      # Common footer
        ├── js/
        │   └── script.js       # Compiled JavaScript
        └── ts/
            └── script.ts       # TypeScript source
```

## Database Schema

### Courses Table
- `id` - Auto-increment primary key
- `title` - Course title (VARCHAR 150)
- `descriptions` - Course description (TEXT)
- `levels` - Difficulty level (ENUM: Beginner, Intermediate, Advanced)
- `created_at` - Creation timestamp

### Sections Table
- `id` - Auto-increment primary key
- `course_id` - Foreign key to courses table
- `title` - Section title (VARCHAR 150)
- `content` - Section content (TEXT)
- `position` - Order position (INT)
- `created_at` - Creation timestamp

## Development

### Compiling TypeScript

If you make changes to `src/assets/ts/script.ts`, compile it:

```bash
# Install TypeScript (if not already installed)
npm install -g typescript

# Compile TypeScript
tsc
```

### Accessing Containers

```bash
# PHP container
docker exec -it php-app bash

# MySQL container
docker exec -it mysql-db bash

# Nginx container
docker exec -it nginx-server bash
```

### Viewing Logs

```bash
# All services
docker-compose logs -f

# Specific service
docker-compose logs -f php
docker-compose logs -f mysql
docker-compose logs -f nginx
```

## Database Access

### Via phpMyAdmin
- URL: http://localhost:8081
- Server: mysql
- Username: root
- Password: root

### Via MySQL Client
```bash
mysql -h localhost -P 3307 -u user -p
# Password: password
```

### From PHP
```php
$host = 'mysql';
$db = 'lms_courses';
$user = 'user';
$pass = 'password';

$conn = new mysqli($host, $user, $pass, $db);
```

## API Endpoints

### Courses
- `GET /` - List all courses
- `POST /courses_create.php` - Create new course
- `POST /courses_edit.php?id={id}` - Edit course
- `GET /courses_delete.php?id={id}` - Delete course

### Sections
- `GET /sections_by_course.php?course_id={id}` - List sections for a course
- `POST /sections_create.php` - Create new section
- `POST /sections_edit.php?id={id}` - Edit section
- `GET /sections_delete.php?id={id}` - Delete section

## Form Validation

Both frontend and backend validation are implemented:

- **Frontend**: JavaScript validation with error messages
- **Backend**: PHP validation with session-based error handling
- **Required Fields**: All form fields are validated for empty values
- **Level Validation**: Course level must be one of the predefined options

## Security Features

- Prepared SQL statements to prevent SQL injection
- CSRF protection through form methods
- Input validation on both client and server side
- Foreign key constraints for data integrity

## Troubleshooting

### Port Already in Use
If ports 8080, 8081, or 3307 are already in use, modify `docker-compose.yml`:
```yaml
ports:
  - "YOUR_PORT:80"  # Change YOUR_PORT
```

### Cannot Connect to Database
1. Ensure MySQL container is running: `docker-compose ps`
2. Wait for MySQL initialization (first run takes longer)
3. Check logs: `docker-compose logs mysql`

### Changes Not Reflecting
1. Clear browser cache
2. Restart containers: `docker-compose restart`
3. Rebuild if needed: `docker-compose up -d --build`

## Production Deployment

⚠️ **Important**: This setup is for development. For production:

1. Change all default passwords
2. Use environment variables for credentials
3. Enable HTTPS/SSL
4. Configure proper firewall rules
5. Remove or secure phpMyAdmin
6. Enable PHP opcache
7. Set up proper logging
8. Implement rate limiting
9. Add backup strategies
10. Use a reverse proxy

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Future Enhancements

- User authentication and authorization
- Student enrollment system
- Progress tracking
- Quiz and assessment features
- File upload for course materials
- Course categories and tags
- Search functionality
- Drag-and-drop section reordering
- Rich text editor for content
- Course preview feature

## License

MIT License - feel free to use this project for learning or commercial purposes.

## Support

For detailed Docker setup instructions, see [Docker Setup README.md](Docker%20Setup%20README.md)

For issues or questions, please open an issue in the repository.

---

**Built with ❤️ for education**