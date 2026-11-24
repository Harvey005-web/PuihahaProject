# Email, Maps and Weather setup

The integration adds a location selector to Transactions > Create/Edit. Applications and renewals queue an acknowledgement email to the selected member. It is an acknowledgement, not proof of email ownership.

1. Use PHP compatible with composer.lock (the supplied dependencies require PHP 8.4.1 or newer).
2. In the project directory run:
   php artisan migrate
   php artisan config:clear
3. Set these existing .env values:
   QUEUE_CONNECTION=database
   MAIL_MAILER=smtp
   MAIL_HOST=your-smtp-host
   MAIL_PORT=587
   MAIL_USERNAME=your-smtp-username
   MAIL_PASSWORD=your-smtp-password
   MAIL_FROM_ADDRESS=your-sender-address
   MAIL_FROM_NAME="MemberFlow"
   Configure MAIL_SCHEME according to your SMTP provider and config/mail.php.
4. Fill the blank GOOGLE_MAPS_KEY and OPENWEATHER_KEY entries.
   Restrict the Maps browser key to Maps JavaScript API and your actual browser origins (localhost and 127.0.0.1 are different). Enable the API and billing in Google Cloud. The map uses DEMO_MAP_ID; replace this with your own map ID for production.
   OpenWeather credentials are used only on the server.
5. Run php artisan config:clear after configuration edits.
6. Run php artisan queue:work in a second terminal. Restart workers after code/configuration changes with php artisan queue:restart.

Verification:
- Sign in and create an Application or Renewal under Transactions.
- Choose a point or type both coordinates. The stored coordinates are displayed when you reopen Edit.
- Confirm the email contains the transaction reference in your configured inbox.
- Check php artisan queue:failed for delivery failures.
- Confirm weather changes with location; requests are cached for ten minutes and limited to thirty per minute.
- Blank keys allow saving transactions and manual coordinates; map/weather show unavailable/setup messages.
- Existing records are preserved by the additive migration.

Do not reimport the older database SQL or use migrate:fresh: those can erase existing records.
If your database was created from the older SQL export, Laravel's migrations table may be absent even though application tables exist. Reconcile the existing schema and migration history before running migrate; do not rerun table-creation migrations against existing tables.
No live mail, Maps, or weather calls were verified because credentials are blank. PHP syntax was checked; Laravel execution requires the newer PHP runtime.

