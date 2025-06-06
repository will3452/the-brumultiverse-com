# TheBrumultiverse - Educational Virtual World Platform

🏫 **An immersive virtual university platform for creative learning and social interaction**

> ⚠️ **Disclaimer**: This is not official code of Brumultiverse for their website.

## 📖 Overview

TheBrumultiverse is a comprehensive Laravel-based virtual university platform that creates an immersive educational experience combining social networking, digital publishing, virtual commerce, and creative collaboration. Students can attend virtual classes, create and publish books, interact with peers, customize avatars, and participate in a virtual economy.

## ✨ Key Features

### 🎓 **User Management & Roles**
- **Multi-role system**: Students, Authors, Artists, Scholars, Super Admins
- **Account types**: Free and Premium memberships
- **User profiles**: Complete profile management with avatars and personal information
- **Authentication**: Email verification, secure login/logout

### 📚 **Digital Publishing Platform**
- **Book Creation & Management**: Complete book authoring tools with chapters, covers, and metadata
- **Content Types**: Novels, Short Stories, Graphic Novels, Poetry, Children's Books, and more
- **Publishing System**: Approval workflow for book publication
- **Categorization**: Multiple genres (Romance, LGBTQIA+, Mystery, Historical, etc.)
- **Tagging System**: Flexible content tagging and discovery
- **Reading Experience**: Digital library with reading logs

### 🏠 **Virtual Campus Experience**
- **Dormitory System**: Personal dorm rooms for students
- **Tutorial System**: Guided onboarding for new users
- **Campus Map**: Interactive navigation through virtual spaces
- **Closet System**: Virtual wardrobe management
- **Avatar Customization**: Comprehensive avatar creation with gender-specific options

### 💬 **Social Features**
- **Chat System**: Real-time messaging between users
- **Friend System**: Add friends, send/accept friend requests
- **Groups**: Create and join study groups or communities
- **Notifications**: Real-time notification system

### 📱 **Student Devices**
- **Virtual Phone**: Photo gallery, contact list, friend management
- **Virtual Computer**: Dashboard, settings, homework management, "Write With Us" feature
- **Interactive UI**: Device-specific interfaces mimicking real devices

### 💎 **Virtual Economy**
- **Crystal System**: Multi-currency virtual economy
  - White Crystals
  - Purple Crystals
  - Hall Passes
  - Silver Tickets
- **Shop System**: Purchase virtual items and accessories
- **Payment Integration**: Real money to virtual currency conversion
- **Student Packages**: Bundled virtual currency packages

### 🎨 **Creative Tools**
- **Art Scenes**: Create and share artistic content
- **Quote Maker**: Design and share inspirational quotes
- **Content Collections**: Organize creative works
- **Museum Feature**: Display and browse creative works

### 📰 **Scholar Features**
- **Marketing Tools**: Promote books and content
- **Newspaper System**: Create and manage publications
- **Song Management**: Audio content creation and sharing
- **Analytics**: Track engagement and performance

### 🔧 **Technical Features**
- **Laravel Nova Admin Panel**: Comprehensive backend management
- **File Upload System**: Large file handling with FilePond
- **Real-time Features**: LiveWire integration for dynamic interfaces
- **API Support**: RESTful API for mobile/external integrations
- **Backup System**: Automated data backup (Spatie)
- **Permission System**: Role-based access control (Spatie)

## 🛠️ Installation

### Prerequisites
- PHP 7.3+ or 8.0+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Laravel requirements

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone [repository-url]
   cd the-brumultiverse-com
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   npm run dev
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan storage:link
   ```

5. **Database setup**
   ```bash
   # Configure your database in .env file
   php artisan migrate
   php artisan db:seed
   ```

6. **Initial data setup**
   > ⚠️ **Important**: After installation, log in as admin and populate the data section first for proper system functionality.

## 🏗️ Architecture

### Tech Stack
- **Backend**: Laravel 8.x
- **Frontend**: Blade Templates, Alpine.js, Tailwind CSS
- **Admin Panel**: Laravel Nova
- **Real-time**: LiveWire
- **Payment**: DragonPay integration
- **File Handling**: Intervention Image, FilePond
- **Permissions**: Spatie Laravel Permission
- **Backup**: Spatie Laravel Backup

### Key Models
- **User**: Central user management with multiple traits
- **Book**: Digital publishing with full metadata
- **Chat/Message**: Real-time communication system
- **Avatar**: Customizable user representations
- **Balance**: Virtual currency management
- **Shop Items**: Virtual marketplace
- **Payment Transactions**: Financial transaction tracking

## 🚀 Future Features & Roadmap

Based on the current codebase analysis and notes, here are the planned features:

### 📋 **Immediate Todos (From notes.txt)**
- [ ] **Content Setting System**: Enhanced content management tools
- [ ] **Continue Book Upload**: Improved book publishing workflow
- [ ] **Phone Enhancements**: Expanded mobile device simulation
- [ ] **Computer Improvements**: Additional desktop features
- [ ] **Bookshelves System**: Personal and public book organization

### 🎯 **Short-term Goals (3-6 months)**
- [ ] **Mobile App**: Native iOS/Android applications
- [ ] **Video Content**: Support for video lectures and tutorials
- [ ] **Assignment System**: Complete homework and project management
- [ ] **Grading System**: Academic performance tracking
- [ ] **Calendar Integration**: Class schedules and event management
- [ ] **Classroom Features**: Virtual classroom environments
- [ ] **Study Groups**: Enhanced collaborative learning tools

### 🌟 **Medium-term Goals (6-12 months)**
- [ ] **VR Integration**: Virtual Reality campus experience
- [ ] **AI-Powered Recommendations**: Personalized content suggestions
- [ ] **Multi-language Support**: International user base support
- [ ] **Advanced Analytics**: Detailed learning progress tracking
- [ ] **Marketplace Expansion**: User-generated content marketplace
- [ ] **Live Streaming**: Real-time lectures and events
- [ ] **Game Elements**: Gamification with achievements and leaderboards

### 🚀 **Long-term Vision (1+ years)**
- [ ] **Metaverse Integration**: Full 3D virtual world experience
- [ ] **Blockchain Features**: NFT integration for digital certificates
- [ ] **AI Teaching Assistants**: Automated student support
- [ ] **Global Campus Network**: Multi-university platform
- [ ] **Advanced Creator Tools**: Professional publishing suite
- [ ] **Corporate Partnerships**: Industry collaboration features
- [ ] **Research Platform**: Academic research and publication tools

### 💡 **Innovation Features**
- [ ] **AR Campus Tours**: Augmented reality exploration
- [ ] **Voice Chat Rooms**: Audio-based learning spaces
- [ ] **Smart Scheduling**: AI-optimized class scheduling
- [ ] **Peer-to-Peer Learning**: Student tutoring marketplace
- [ ] **Digital Credentials**: Blockchain-verified certificates
- [ ] **Adaptive Learning**: Personalized learning paths

## 📂 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Scholar/          # Author/Scholar features
│   │   └── Student/          # Student-specific controllers
│   ├── Models/               # Core application models
│   ├── Traits/              # Reusable model traits
│   └── Helpers/             # Utility classes
├── resources/
│   ├── views/
│   │   ├── scholar/         # Scholar interface views
│   │   ├── student/         # Student interface views
│   │   └── components/      # Reusable components
│   └── js/                  # JavaScript components
├── routes/
│   ├── web.php             # Main web routes
│   ├── student.php         # Student-specific routes
│   ├── ajax.php            # AJAX endpoints
│   └── api.php             # API routes
└── nova-components/         # Custom Nova components
```

## 🤝 Contributing

This project follows Laravel coding standards and best practices. When contributing:

1. Follow PSR-4 autoloading standards
2. Use meaningful commit messages
3. Write tests for new features
4. Update documentation
5. Follow the existing code style

## 📄 License

This project is licensed under the MIT License.

## 🔧 Development Notes

- **Cover Dimensions**: Books require covers of 512 x 800 pixels (PNG/JPG)
- **Virtual Currency**: Default cost type is Purple Crystal
- **Chat Retention**: Conversations auto-delete after 30 days
- **File Upload**: Supports large file uploads via FilePond
- **Payment Integration**: Uses DragonPay for Philippine market

## 📞 Support

For technical issues or questions about this implementation, please refer to the original Brumultiverse platform or create an issue in this repository.

---

**Built with ❤️ using Laravel, creating the future of virtual education**
