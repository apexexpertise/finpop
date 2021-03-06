<?php
// Metadata
define('GOTEO_META_TITLE', 'Finpop');
define('GOTEO_META_DESCRIPTION', '--meta-description--');
define('GOTEO_META_KEYWORDS', '--keywords--');
define('GOTEO_META_AUTHOR', '--author--');
define('GOTEO_META_COPYRIGHT', '--copyright--');

//Amazon Web Services Credentials
define("AWS_KEY", "--------------");
define("AWS_SECRET", "--------------------------------------");
define("AWS_REGION", "-----------");

//Mail management: ses (amazon), phpmailer (php library)
define("MAIL_HANDLER", "phpmailer");

// Database
define('GOTEO_DB_DRIVER', 'mysql');
define('GOTEO_DB_HOST', 'localhost');
define('GOTEO_DB_PORT', 3306);
define('GOTEO_DB_CHARSET', 'UTF-8');
define('GOTEO_DB_SCHEMA', 'finpop');
define('GOTEO_DB_USERNAME', 'root');
define('GOTEO_DB_PASSWORD', '');

// Mail
define('GOTEO_MAIL_FROM', 'noreply@example.com');
define('GOTEO_MAIL_NAME', 'example.com');
define('GOTEO_MAIL_TYPE', 'smtp'); // mail, sendmail or smtp
define('GOTEO_MAIL_SMTP_AUTH', true);
define('GOTEO_MAIL_SMTP_SECURE', 'ssl');
define('GOTEO_MAIL_SMTP_HOST', 'smtp--host');
define('GOTEO_MAIL_SMTP_PORT', '--portnumber--');
define('GOTEO_MAIL_SMTP_USERNAME', 'smtp-usermail');
define('GOTEO_MAIL_SMTP_PASSWORD', 'smtp-password');

define('GOTEO_MAIL', 'info@example.com');
define('GOTEO_CONTACT_MAIL', 'info@example.com');
define('GOTEO_FAIL_MAIL', 'fail@example.com');
define('GOTEO_LOG_MAIL', 'sitelog@example.com');

/* This is to send mailing by Amazon SES*/
//Quota limit, 24 hours
define('GOTEO_MAIL_QUOTA', 50000);
//Quota limit for newsletters, 24 hours
define('GOTEO_MAIL_SENDER_QUOTA', round(GOTEO_MAIL_QUOTA * 0.8));
// Amazon SNS keys to get bounces automatically: 'arn:aws:sns:us-east-1:XXXXXXXXX:amazon-ses-bounces'
define('AWS_SNS_CLIENT_ID', 'XXXXXXXXX');
define('AWS_SNS_REGION', 'us-east-1');
define('AWS_SNS_BOUNCES_TOPIC', 'amazon-ses-bounces');
define('AWS_SNS_COMPLAINTS_TOPIC', 'amazon-ses-complaints');

/**
 * The locale options are used to define regional settings for
 * things such as language, local legal forms, etc.
 */
$config['locale'] = array(
    // default interface language
    'default_language' => 'fr',
    // root directory of language files (relative to root of Goteo install)
    'gettext_root' => 'locale',
    // name of the gettext .po file (used for admin only texts at the moment)
    'gettext_domain' => 'messages',
    // gettext files are cached, to reload a new one requires to restart Apache which is stupid (and annoying while
    //        developing) this setting tells the langueage code to bypass caching by using a clever file-renaming
    // mechanism described in http://blog.ghost3k.net/articles/php/11/gettext-caching-in-php
    'gettext_bypass_caching' => true,
    // use php implementation (true) or apache module (false)?
    // See this blogpost to understand why using the apache module is not a good idea
    // unles you really know what you are doing
    // http://blog.spinningkid.info/?p=2025
    'gettext_use_php_implementation' => true,

    // Social Security Number (or personal iscal number depending on country)
    'social_number_required' => false, // is this an absolute must?
    'function_validate_social_number' => 'Check::nif', // if it is, which function should we call to validate it? This may take into account local variations

    // VAT validation configuration
    'vat_required' => false, // is it an absolute must?
    'function_validate_vat' => 'Check::vat', // if it is, which function should we call to validate it? This may take into account local variations
);

/**
 * The options array contains configuration settings for optional features
 * such as enhanced privacy.
 */
$config['options'] = array(
    // avoid all trackers (e.g. facebook, google and all other JS based tracking APIs)
    'enhanced-privacy' => true
);
// Language
define('GOTEO_DEFAULT_LANG', $config['locale']['default_language']);

// url (this will change on Goteo v3)
define('SITE_URL', 'http://finpop.dev/'); // endpoint url
define('SRC_URL', 'http://finpop.dev/');  // host for statics
define('SEC_URL', 'http://finpop.dev/');  // with SSL certified

//Sessions
//session handler: php, dynamodb
define("SESSION_HANDLER", "php");

//Files management: s3, file
define("FILE_HANDLER", "file");

//Log file management: s3, file
define("LOG_HANDLER", "file");

// environment: local, beta, real
define("GOTEO_ENV", "local");

//S3 bucket (if you set FILE_HANDLER to s3)
define("AWS_S3_BUCKET", "static.example.com");
define("AWS_S3_PREFIX", "");

//bucket para logs (if you set LOG_HANDLER to s3)
define("AWS_S3_LOG_BUCKET", "bucket");
define("AWS_S3_LOG_PREFIX", "applogs/");

// Cron params (for cron processes using wget)
define('CRON_PARAM', '--------------');
define('CRON_VALUE', '--------------');


/****************************************************
Paypal constants (sandbox)
* Must set cretentials on library/paypal/paypal_config.php as well
****************************************************/
define('PAYPAL_REDIRECT_URL', '---Sandbox/Production-url-----https://www.sandbox.paypal.com/webscr&cmd=');
define('PAYPAL_DEVELOPER_PORTAL', '--developper-domain--');
define('PAYPAL_DEVICE_ID', '--domain--');
define('PAYPAL_APPLICATION_ID', '--PayPal-app-Id---');
define('PAYPAL_BUSINESS_ACCOUNT', '--mail-like-paypal-account--');
define('PAYPAL_IP_ADDRESS', '127.0.0.1');

/****************************************************
TPV [Bank Name] (depends on your bank)
****************************************************/
define('TPV_MERCHANT_CODE', 'xxxxxxxxx');
define('TPV_REDIRECT_URL', '--bank-rest-api-url--');
define('TPV_ENCRYPT_KEY', 'xxxxxxxxx');

/*
Any other payment system configuration should be setted here
*/

/****************************************************
Social Services constants  (needed to login-with on the controller/user and library/oauth)
****************************************************/
// Credentials Facebook app
define('OAUTH_FACEBOOK_ID', '-----------------------------------'); //
define('OAUTH_FACEBOOK_SECRET', '-----------------------------------'); //

// Credentials Twitter app
define('OAUTH_TWITTER_ID', '-----------------------------------'); //
define('OAUTH_TWITTER_SECRET', '-----------------------------------'); //

// Credentials Linkedin app
define('OAUTH_LINKEDIN_ID', '-----------------------------------'); //
define('OAUTH_LINKEDIN_SECRET', '-----------------------------------'); //

// Un secreto inventado cualquiera para encriptar los emails que sirven de secreto en openid
define('OAUTH_OPENID_SECRET','-----------------------------------');

// recaptcha ( to be used in /contact form )
define('RECAPTCHA_PUBLIC_KEY','-----------------------------------');
define('RECAPTCHA_PRIVATE_KEY','-----------------------------------');

/****************************************************
Google Analytics
****************************************************/
define('GOTEO_ANALYTICS_TRACKER', "
");
?>