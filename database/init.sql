CREATE DATABASE IF NOT EXISTS lms_courses;

use lms_courses;

CREATE TABLE IF NOT EXISTS courses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    descriptions text,
    levels VARCHAR(150) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
    );

CREATE TABLE IF NOT EXISTS sections(
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    title VARCHAR(150) NOT NULL,
    content text NOT NULL,
    position INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses (id)
);