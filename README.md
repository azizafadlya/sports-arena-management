
# Sports Arena Time Slot Management

A Laravel-based API for managing sports arena bookings with concurrency handling.

## Features
- Arena owners can create arenas.
- Each arena has multiple configurable time slots.
- Customers can book time slots.
- Unconfirmed bookings are released after 10 minutes.
- Concurrency handling to prevent double bookings.

## Technologies Used
- **Laravel 11**
- **MySQL** for database storage
- **Repository Pattern** for clean architecture
- **Database Transactions & Locking** for concurrency control
- **Laravel Sanctum** for authentication

## Installation
```bash
# Clone the repository
git clone https://github.com/azizafadlya/sports-arena-management.git
cd sports-arena-management

# Install dependencies
composer install

# Set up environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations & seed database
php artisan migrate --seed

# Start the application
php artisan serve
```

## API Endpoints
### Authentication
| Method | Endpoint       | Description         |
|--------|--------------|---------------------|
| POST   | /api/register | Register new user  |
| POST   | /api/login    | Authenticate user  |

### Arena Management
| Method | Endpoint       | Description       |
|--------|--------------|-------------------|
| GET    | /api/arenas  | List all arenas  |
| POST   | /api/arenas  | Create new arena |

### Time Slot Management
| Method | Endpoint         | Description       |
|--------|----------------|-------------------|
| GET    | /api/time-slots | List time slots  |
| POST   | /api/time-slots | Create time slot |

### Booking System
| Method | Endpoint          | Description             |
|--------|-----------------|-------------------------|
| POST   | /api/bookings    | Create a booking       |
| POST   | /api/bookings/{id}/confirm | Confirm a booking |

## Running Tests
```bash
php artisan test
```
