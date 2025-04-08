# Multi-Factor Authentication (MFA) Configuration with TextMagic SMS Gateway

This guide explains how to set up Multi-Factor Authentication using the TextMagic SMS Gateway in Moodle.

## Prerequisites

- TextMagic SMS Gateway plugin must be installed and configured
- A valid phone number for receiving SMS messages
- Administrator access to Moodle
- TextMagic account with sufficient credits

## Configuration Steps

### 1. Enable MFA in Moodle
1. Log in as an administrator
2. Go to Site administration > Security > Multi-factor authentication
3. Enable MFA if not already enabled
4. Configure the general MFA settings according to your security requirements

### 2. Configure TextMagic for MFA
1. Go to Site administration > Plugins > Message outputs > Manage SMS gateways
2. Ensure TextMagic is configured with:
   - Valid Username
   - API Key
   - Sender ID
   - Test phone number for verification

### 3. User Setup
1. Users should go to their profile page
2. Click "Edit profile"
3. Navigate to "Preferences"
4. Under "Multi-factor authentication":
   - Click "Manage"
   - Select "SMS" as the authentication method
   - Enter and verify their phone number
   - Complete the setup wizard

## Testing MFA

1. Log out of Moodle
2. Attempt to log in with a user account that has MFA enabled
3. You should receive an SMS with a verification code
4. Enter the code to complete the login process

## Troubleshooting

### Common Issues

1. **No SMS Received**
   - Verify the phone number is correct and in international format
   - Check TextMagic account balance
   - Ensure the Sender ID is approved
   - Check server logs for errors
   - Verify API connectivity to TextMagic servers

2. **Invalid Verification Code**
   - Codes expire after a short time
   - Request a new code if needed
   - Ensure you're entering the correct code
   - Check if the code was delayed (TextMagic provides delivery status)

3. **Configuration Issues**
   - Verify TextMagic API credentials are correct
   - Check if the gateway is enabled
   - Ensure proper permissions are set
   - Verify your TextMagic account is active

## Security Considerations

- SMS-based MFA is more secure than single-factor authentication
- Consider implementing additional security measures:
  - Rate limiting for login attempts
  - IP-based restrictions
  - Session timeout settings
  - Monitoring of TextMagic delivery reports
  - Geographic restrictions where applicable

## Support

For additional support:
- Check the [Moodle MFA documentation](https://docs.moodle.org/)
- Visit the [TextMagic API documentation](https://www.textmagic.com/docs/api/)
- Contact your system administrator
- Visit our [donation page](https://customerpanel.sebsoft.nl/sebsoft/donate/intro.php) for premium support options 