# Login with Microsoft Azure

This project provides a simple authentication system using Microsoft Azure OAuth2.0 for user login. It integrates Microsoft Graph API to fetch user details after authentication.

## Features

- Secure login via Microsoft Azure
- Uses OAuth 2.0 authentication
- Fetches user details (name, email, profile picture) via Microsoft Graph API
- Secure session handling with PHP

## Requirements

Before running this project, ensure you have the following:

- PHP 7.4 or higher
- Composer
- Microsoft Azure App Registration (for obtaining credentials)
- `.env` file with necessary environment variables

## Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/GhostersH/Microsoft-Auth-PHP
   cd your-repository
   ```

2. **Install dependencies:**
   ```sh
   composer install
   ```

3. **Create a `.env` file:**
   Copy the example environment file and set up your credentials:
   ```sh
   cp .env.example .env
   ```
   Edit the `.env` file with your Azure credentials:
   ```env
   APP_URL=https://your-app-url.com
   APP_ID=your-azure-app-id
   TENANT_ID=your-tenant-id
   SECRET=your-client-secret
   ```

4. **Run the project:**
   You can start a local PHP server using:
   ```sh
   php -S localhost:8000
   ```
   Open `http://localhost:8000` in your browser.

## Usage

- **Login:** Click on the Microsoft login button to authenticate.
- **Logout:** Click on the logout link to end the session.
- **Session Handling:** The application securely manages user sessions and redirects based on authentication status.

## File Structure

```
project-root/
├── controllers/
│   ├── auth.php         # Handles authentication
├── images/
│   ├── ms-symbollockup_signin_light.svg  # Microsoft sign-in button
├── vendor/              # Dependencies installed via Composer
├── index.php            # Main login page
├── auth_page.php        # Redirects authenticated users
├── .env                 # Environment variables
├── .gitignore           # Git ignore file
├── composer.json        # Composer dependencies
└── README.md            # Project documentation
```

## Environment Variables

The `.env` file contains sensitive configuration settings:

| Variable    | Description |
|------------|------------|
| `APP_URL`  | The base URL of the application |
| `APP_ID`   | Microsoft Azure application ID |
| `TENANT_ID` | Azure Tenant ID |
| `SECRET`   | Application secret |

Ensure you do not expose these credentials publicly.

## Security Considerations

- **Session Security:**
  - Sessions use `session_regenerate_id(true)` to prevent session fixation attacks.
  - Cookies are set with a 1-day expiration time.
- **OAuth2 Security:**
  - Uses `state` parameter to prevent CSRF attacks.
  - Tokens are stored securely in the session.

## License

This project is licensed under the MIT License.

---

For further information, refer to the [Microsoft Authentication Documentation](https://docs.microsoft.com/en-us/azure/active-directory/develop/).

