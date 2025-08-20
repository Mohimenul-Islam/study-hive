# 🎓 StudyHive

**StudyHive** is a live, full-stack web application designed as a peer-to-peer academic resource hub for university students. Built with Laravel, it provides a secure and interactive platform for users to share, discover, and discuss study materials. The application features a clean user interface, a robust set of community features, and a comprehensive administrative backend for moderation.

**🌐 Live Application:** [https://study-hive.app](https://study-hive.app)

[![PHP Version](https://img.shields.io/badge/PHP-8.3-777BB4.svg?style=flat-square&logo=php)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20.svg?style=flat-square&logo=laravel)](https://laravel.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](https://opensource.org/licenses/MIT)

## ✨ Key Features

### � Secure, University-Verified Registration
- User registration is restricted to .edu emails and requires email verification to ensure a trusted community
- Complete authentication system handles user login, logout, and profile management

### � Comprehensive Resource Management
- Authenticated users can easily upload various file types (PDFs, images, etc.) with relevant metadata like course name and description
- Public-facing, paginated resource list allows anyone to browse and discover materials
- Powerful search and filtering system enables users to find specific resources quickly

### 👥 Community & Gamification
- **Voting System**: Users can upvote and downvote resources, with the list sortable by popularity
- **Commenting**: Each resource has a dedicated discussion section for user comments
- **Leaderboard**: A points-based leaderboard showcases and rewards top contributors

### 👨‍💼 Administrative Panel
- Secure admin dashboard built with Filament provides full control over the platform
- Administrators can perform complete CRUD (Create, Read, Update, Delete) operations on both users and resources, ensuring content quality and moderation

## 🛠️ Technical Stack

- **Backend**: PHP / Laravel
- **Frontend**: Blade templates with Tailwind CSS
- **Admin Panel**: Filament
- **Database**: MySQL
- **Deployment**: Heroku

## 🚀 Quick Start

### Prerequisites

- PHP 8.3 or higher
- Composer
- Node.js & npm
- MySQL database
- Git

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Mohimenul-Islam/study-hive.git
   cd study-hive
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your `.env` file**
   ```env
   APP_NAME=StudyHive
   APP_URL=http://localhost:8000
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=study_hive
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

### Development Mode

For active development with hot reloading:

```bash
composer run dev
```

This command will start:
- Laravel development server
- Queue worker
- Log viewer (Pail)
- Vite development server with HMR

## 🧪 Testing

Run the test suite using Pest:

```bash
composer test
```

For test coverage:
```bash
php artisan test --coverage
```

## 📁 Project Structure

```
app/
├── Filament/Resources/     # Admin panel resources
├── Http/
│   ├── Controllers/        # API & Web controllers
│   └── Requests/          # Form request validation
├── Models/                # Eloquent models
│   ├── User.php          # User model with contribution points
│   ├── Resource.php      # Educational resource model
│   ├── Vote.php          # Voting system model
│   └── Comment.php       # Comment system model
└── Providers/            # Service providers
```

## 👥 Contributing

We welcome contributions to StudyHive! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Guidelines

- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation as needed
- Use conventional commit messages

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Support

- **Issues**: [GitHub Issues](https://github.com/Mohimenul-Islam/study-hive/issues)
- **Discussions**: [GitHub Discussions](https://github.com/Mohimenul-Islam/study-hive/discussions)

## 🏗️ Roadmap

- [ ] Enhanced search capabilities
- [ ] Mobile-responsive improvements
- [ ] Advanced user analytics
- [ ] Bulk resource management tools
- [ ] Integration with university LMS platforms

---

<p align="center">Made with ❤️ for the educational community</p>
