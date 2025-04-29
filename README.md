# Accessible Educational Resource Library

A platform where teachers or admins can upload educational materials, and students can download them based on their accessibility needs.

## Features

- User authentication (login/signup)
- Resource upload with metadata
- Resource categorization
- Search and filter functionality
- Preview functionality
- Download management
- Accessibility-focused content organization

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Node.js and NPM (for frontend assets)

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd accessible-education-library
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install frontend dependencies:
```bash
npm install
```

4. Create a copy of the environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in the `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=accessible_education
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations and seeders:
```bash
php artisan migrate --seed
```

8. Start the development server:
```bash
php artisan serve
```

9. In a separate terminal, compile frontend assets:
```bash
npm run dev
```

## Usage

1. Register a new account or login with existing credentials
2. Browse available educational resources
3. Filter resources by category, type, or accessibility focus
4. Upload new resources with appropriate metadata
5. Download or preview resources as needed

## Resource Types

- Audio lectures
- Braille PDFs
- Sign language videos
- Large-text documents

## Accessibility Features

- Hearing-impaired support
- Visually-impaired support
- Learning disability support
- Physical disability support

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.
