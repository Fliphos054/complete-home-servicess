-- Database creation
CREATE DATABASE IF NOT EXISTS service_company;
USE service_company;

-- Services table
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    icon VARCHAR(50),
    featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Service categories
CREATE TABLE service_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    service_id INT,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Gallery items
CREATE TABLE gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_id INT,
    image_path VARCHAR(255) NOT NULL,
    caption VARCHAR(255),
    is_before_after BOOLEAN DEFAULT FALSE,
    before_image VARCHAR(255),
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Testimonials
CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    rating INT(1),
    service_id INT,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
);

-- Contact submissions
CREATE TABLE contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    service_id INT,
    message TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
);

-- Insert initial services data
INSERT INTO services (name, description, icon, featured) VALUES
('Parging', 'Professional parging services for your home or business exterior walls.', 'fas fa-home',TRUE),
('Roof Cleaning', 'Expert roof cleaning to extend the life of your roofing materials.', 'fas fa-igloo',TRUE),
('Power Washing', 'High-pressure washing for driveways, siding, and more.', 'fas fa-spray-can',TRUE),
('Apartment/Plaza Cleaning', 'Comprehensive cleaning solutions for multi-unit properties.', 'fas fa-building',FALSE),
('Snow Removal', 'Reliable snow removal services for residential and commercial properties.', 'fas fa-snowplow',TRUE),
('Marble Installation', 'Beautiful marble installation with trending designs from TikTok.', 'fas fa-gem',TRUE),
('Smart Home Solutions', 'Modern smart home technology installation and integration.', 'fas fa-robot',TRUE);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (username, password_hash, full_name) 
VALUES ('admin1', 'Pvpkiller054$', 'Fliphos Kesete');

CREATE TABLE quote_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),	
    service_id INT,
    message TEXT NOT NULL,
    project_date DATE,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
);

SELECT * FROM admins;

UPDATE admins 
SET password_hash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE username = 'admin1';

-- First, remove any potential whitespace
UPDATE admins SET password_hash = TRIM(password_hash) WHERE username = 'admin1';

-- Then re-set the hash (copy this EXACTLY)
UPDATE admins 
SET password_hash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE username = 'admin1';

-- Completely recreate the table
DROP TABLE admins;
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert fresh user
INSERT INTO admins (username, password_hash, full_name) 
VALUES ('admin1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Fliphos Kesete');