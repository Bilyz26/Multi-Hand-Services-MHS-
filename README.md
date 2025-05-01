# Multiservice Website with Email Request System

A professional website for a service company that allows customers to request various services through a form system. The website includes a responsive design, multiple language support, and email notifications.

## Features

- Responsive design that works on all devices
- Service request form with validation
- Email notifications for both admin and customers
- Multiple language support (English, German, Arabic)
- WhatsApp integration
- Modern and clean UI

## Requirements

- PHP 7.4 or higher
- Web server (Apache/Nginx)
- Mail server configuration for PHP

## Setup Instructions

1. Clone this repository to your web server directory
2. Configure your email settings in `process_form.php`:
   - Replace `your-email@example.com` with your actual email address
3. Ensure PHP mail function is properly configured on your server
4. (Optional) Add your own logo and hero background image in the `images` directory
5. Test the form submission and email functionality

## File Structure

```
.
├── index.php          # Main website file
├── process_form.php   # Form processing script
├── css/
│   └── style.css     # Stylesheet
├── js/
│   └── main.js       # JavaScript functions
└── images/           # Directory for website images
```

## Customization

### Changing Contact Information

1. Open `index.php`
2. Locate the footer section
3. Update phone number, email, and WhatsApp number

### Modifying Services

1. Open `index.php`
2. Find the services section
3. Add or modify service cards as needed

### Email Templates

1. Open `process_form.php`
2. Modify the email templates in the script to match your brand voice

## Security Features

- Input sanitization
- Form validation
- CSRF protection (session-based)
- Secure email handling

## Support

For any issues or questions, please create an issue in this repository.

## License

This project is licensed under the MIT License - see the LICENSE file for details.
