# Crow Nation QR Generator

 A simple WordPress plugin that generates QR codes for posts and custom URLs using the bundled phpqrcode library.

 Summary
- Generates PNG QR codes for posts and custom URLs
- No external services — uses bundled `lib/phpqrcode`
- Lightweight and intended for easy integration into WordPress sites

 Installation
1. Copy the `crow-nation-qr-generator` folder into `wp-content/plugins/`.
2. Activate the plugin via the WordPress admin Plugins screen.

 Usage
- Use the plugin admin interface to generate and download QR codes.
- The plugin also exposes helper functions in the `includes/` folder for programmatic use.

 Development
- Follow coding standards compatible with WordPress (PHP 7.4+ recommended).
- Run static analysis and linters as needed; there are no automated tests included.

 Contributing
Read `CONTRIBUTING.md` for contribution and PR guidelines.

 License
This project is released under the MIT License - see `LICENSE`.
