<?php namespace core;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/core/lang/en.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
use core\view as View,
 	\helpers\session as Session,
 	\helpers\url as Url;

/*
 *---------------------------------------------------------------
 * ENGLISH LANGUAGE DATA SOURCE
 *---------------------------------------------------------------
 * NOTE: If you change these, make sure you check how to type code below
 *
 * EXAMPLE: 
 *	if (!defined('_WELCOME_LANG_')) 
 *		define('_WELCOME_LANG_', 'Change this to your needs')
 *
 */

/*
 *---------------------------------------------------------------
 * GENERAL
 *---------------------------------------------------------------
 */

if (!defined('_PRINT_LANG_')) 
	define('_PRINT_LANG_', 'Print');

if (!defined('_ERROR_LANG_')) 
	define('_ERROR_LANG_', 'Error');

if (!defined('_IMPORTANT_LANG_')) 
	define('_IMPORTANT_LANG_', 'Important !');

if (!defined('_NOTIFICATION_LANG_')) 
	define('_NOTIFICATION_LANG_', 'Notification !');

if (!defined('_INVOICE_LANG_')) 
	define('_INVOICE_LANG_', 'INVOICE');

if (!defined('_PAID_LANG_')) 
	define('_PAID_LANG_', 'PAID !');

if (!defined('_NEED_GENERATE_LANG_')) 
	define('_NEED_GENERATE_LANG_', 'NEED GENERATE PDF !');

if (!defined('_NEED_SYNC_LANG_')) 
	define('_NEED_SYNC_LANG_', 'NEED SYNC CALCULATION !');

if (!defined('_UNPAID_LANG_')) 
	define('_UNPAID_LANG_', 'UNPAID !');

if (!defined('_ALERT_LANG_')) 
	define('_ALERT_LANG_', 'Alert !');

if (!defined('_SUCCESS_LANG_')) 
	define('_SUCCESS_LANG_', 'Success !');

if (!defined('_INVALID_LANG_')) 
	define('_INVALID_LANG_', 'Invalid !');

if (!defined('_EMAIL_UPDATE_')) 
	define('_EMAIL_UPDATE_', 'Update Email Address Data');

if (!defined('_USERNAME_UPDATE_')) 
	define('_USERNAME_UPDATE_', 'Update Username Data');

if (!defined('_BACK_LANG_')) 
	define('_BACK_LANG_', 'Back');

if (!defined('_CANNOT_ACCESS_PAGE_LANG_')) 
	define('_CANNOT_ACCESS_PAGE_LANG_', 'You cannot Access this Page');

if (!defined('_ONLINE_STATUS_LANG_')) 
	define('_ONLINE_STATUS_LANG_', 'Online');

if (!defined('_OFFLINE_STATUS_LANG_')) 
	define('_OFFLINE_STATUS_LANG_', 'Offline');

if (!defined('_YOU_HAVE_LANG_')) 
	define('_YOU_HAVE_LANG_', 'You Have');

if (!defined('_TASK_LANG_')) 
	define('_TASK_LANG_', 'Task');

if (!defined('_PROFILE_LANG_')) 
	define('_PROFILE_LANG_', 'Profile');

if (!defined('_SIGN_OUT_LANG_')) 
	define('_SIGN_OUT_LANG_', 'Sign Out');

if (!defined('_CONFIRM_SIGN_OUT_LANG_')) 
	define('_CONFIRM_SIGN_OUT_LANG_', 'Are you sure want to logout ?');

/*
 *---------------------------------------------------------------
 * DASHBOARD
 *---------------------------------------------------------------
 */

if (!defined('_WELCOME_LANG_')) 
	define('_WELCOME_LANG_', 'Welcome to');

if (!defined('_WELCOME_MESSAGE_LANG_')) 
	define('_WELCOME_MESSAGE_LANG_', 'Welcome to Advanced Work Order Tracking System v.1.0');

if (!defined('_DASHBOARD_LANG_')) 
	define('_DASHBOARD_LANG_', 'Dashboard');

if (!defined('_MORE_INFO_LANG_')) 
	define('_MORE_INFO_LANG_', 'More Info');

if (!defined('_ACTIVE_WORK_ORDER_LANG_')) 
	define('_ACTIVE_WORK_ORDER_LANG_', 'Active Work Orders');

if (!defined('_ACTIVE_REQUEST_LANG_')) 
	define('_ACTIVE_REQUEST_LANG_', 'Request Orders');

if (!defined('_ACTIVE_ORDER_LANG_')) 
	define('_ACTIVE_ORDER_LANG_', 'Active Orders');

if (!defined('_ACTIVE_INVOICE_LANG_')) 
	define('_ACTIVE_INVOICE_LANG_', 'Invoices');

if (!defined('_ACTIVE_CLIENT_LANG_')) 
	define('_ACTIVE_CLIENT_LANG_', 'Active Clients');

if (!defined('_ACTIVE_INVOICE_LANG_')) 
	define('_ACTIVE_INVOICE_LANG_', 'Active Invoices');

if (!defined('_UNREAD_MESSAGE_LANG_')) 
	define('_UNREAD_MESSAGE_LANG_', 'Unread Messages');

if (!defined('_STATISTICS_LANG_')) 
	define('_STATISTICS_LANG_', 'Work Order Statistics');

if (!defined('_EMPLOYEE_WO_TITLE_LANG_')) 
	define('_EMPLOYEE_WO_TITLE_LANG_', 'Your Active Work Orders');

if (!defined('_CLIENT_WO_TITLE_LANG_')) 
	define('_CLIENT_WO_TITLE_LANG_', 'Your Active Orders');

if (!defined('_WO_REQUEST_TITLE_LANG_')) 
	define('_WO_REQUEST_TITLE_LANG_', 'Client Request Orders');

if (!defined('_CLIENT_REQUEST_TITLE_LANG_')) 
	define('_CLIENT_REQUEST_TITLE_LANG_', 'Your Request Orders');

if (!defined('_CLIENT_INVOICE_TITLE_LANG_')) 
	define('_CLIENT_INVOICE_TITLE_LANG_', 'Your Invoices');

if (!defined('_NO_ACTIVE_WORK_ORDER_LANG_')) 
	define('_NO_ACTIVE_WORK_ORDER_LANG_', 'There is currently no Active Work Order Data !');

if (!defined('_NO_ACTIVE_WORK_ORDER_REQUEST_LANG_')) 
	define('_NO_ACTIVE_WORK_ORDER_REQUEST_LANG_', 'There is currently no Order Request Data !');

if (!defined('_NO_INVOICE_LANG_')) 
	define('_NO_INVOICE_LANG_', 'There is currently no Invoice Data !');

if (!defined('_SUBMIT_REQUEST_LANG_')) 
	define('_SUBMIT_REQUEST_LANG_', 'Submit Order Requests');

if (!defined('_REQUEST_ADD_LANG_')) 
	define('_REQUEST_ADD_LANG_', 'Add New Order Requests');

if (!defined('_SUCCESS_RESPONSE_REQUEST_LANG_')) 
	define('_SUCCESS_RESPONSE_REQUEST_LANG_', 'Order Request have been response !');

if (!defined('_SUCCESS_ADD_REQUEST_LANG_')) 
	define('_SUCCESS_ADD_REQUEST_LANG_', 'New Order Request have been added. !');

if (!defined('_SUCCESS_UPDATE_REQUEST_LANG_')) 
	define('_SUCCESS_UPDATE_REQUEST_LANG_', 'Order Request have been updated. !');

if (!defined('_SUCCESS_DELETE_REQUEST_LANG_')) 
	define('_SUCCESS_DELETE_REQUEST_LANG_', 'Order Request have been deleted. !');

if (!defined('_DELETE_WORK_ORDER_REQUEST_LANG_')) 
	define('_DELETE_WORK_ORDER_REQUEST_LANG_', 'Work Order Request');

if (!defined('_RESPONSE_WORK_ORDER_REQUEST_LANG_')) 
	define('_RESPONSE_WORK_ORDER_REQUEST_LANG_', 'Response Work Order Request');

/*
 *---------------------------------------------------------------
 * CALENDAR
 *---------------------------------------------------------------
 */

if (!defined('_CALENDAR_LANG_')) 
	define('_CALENDAR_LANG_', 'Work Order Calendar');

/*
 *---------------------------------------------------------------
 * ABOUT
 *---------------------------------------------------------------
 */

if (!defined('_ABOUT_LANG_')) 
	define('_ABOUT_LANG_', 'About Application');

/*
 *---------------------------------------------------------------
 * LOGIN & FORGOT
 *---------------------------------------------------------------
 */

if (!defined('_LOGIN_LANG_')) 
	define('_LOGIN_LANG_', 'Secure Login');

if (!defined('_CLIENT_LOGIN_LANG_')) 
	define('_CLIENT_LOGIN_LANG_', 'Client Area');

if (!defined('_IP_LANG_')) 
	define('_IP_LANG_', 'Your IP Address');

if (!defined('_FORGOT_LANG_')) 
	define('_FORGOT_LANG_', 'I forgot my password');

if (!defined('_FORGOT_HEADER_LANG_')) 
	define('_FORGOT_HEADER_LANG_', 'Forgot password ?');

if (!defined('_FORGOT_BACK_LANG_')) 
	define('_FORGOT_BACK_LANG_', 'Back to Secure Login');

if (!defined('_ERROR_USERNAME_LANG_')) 
	define('_ERROR_USERNAME_LANG_', 'Username field can not be empty. !');

if (!defined('_ERROR_PASSWORD_LANG_')) 
	define('_ERROR_PASSWORD_LANG_', 'Password field can not be empty. !');

if (!defined('_ERROR_USERNAME_PASSWORD_LANG_')) 
	define('_ERROR_USERNAME_PASSWORD_LANG_', 'Sorry, Wrong username and password !');

if (!defined('_ERROR_USERNAME_FORMAT_LANG_')) 
	define('_ERROR_USERNAME_FORMAT_LANG_', 'Hey, What are you doing !<br />Username must be Alphanumerics only !');

if (!defined('_ERROR_RESET_LANG_')) 
	define('_ERROR_RESET_LANG_', 'Reset Password failed, Please check your E-mail and try again.!');

if (!defined('_EMPTY_EMAIL_LANG_')) 
	define('_EMPTY_EMAIL_LANG_', 'Please type your valid Email Address !');

if (!defined('_INVALID_EMAIL_LANG_')) 
	define('_INVALID_EMAIL_LANG_', 'Please enter a valid email address');

if (!defined('_SUCCESS_RESET_LANG_')) 
	define('_SUCCESS_RESET_LANG_', 'Success, Please Check your Email.!');

/*
 *---------------------------------------------------------------
 * USER
 *---------------------------------------------------------------
 */

if (!defined('_ALL_USER_LANG_')) 
	define('_ALL_USER_LANG_', 'All Users');

if (!defined('_ADD_NEW_USER_LANG_')) 
	define('_ADD_NEW_USER_LANG_', 'Add New User');

if (!defined('_EMAIL_ALL_USER_LANG_')) 
	define('_EMAIL_ALL_USER_LANG_', 'Email All Users');

if (!defined('_SUCCESS_ADD_USER_LANG_')) 
	define('_SUCCESS_ADD_USER_LANG_', 'User have been added. !');

if (!defined('_SUCCESS_UPDATE_USER_LANG_')) 
	define('_SUCCESS_UPDATE_USER_LANG_', 'User have been updated. !');

if (!defined('_SUCCESS_DELETE_USER_LANG_')) 
	define('_SUCCESS_DELETE_USER_LANG_', 'User have been deleted. !');

if (!defined('_SUCCESS_EMAIL_ALL_USER_LANG_')) 
	define('_SUCCESS_EMAIL_ALL_USER_LANG_', 'Send Email to All Users. !');

if (!defined('_NO_USER_LANG_')) 
	define('_NO_USER_LANG_', 'There is currently no Administrator Data !');

if (!defined('_SEND_EMAIL_ALL_USER_LANG_')) 
	define('_SEND_EMAIL_ALL_USER_LANG_', 'Send Email to All Active Users');

if (!defined('_FORM_ADD_NEW_USER_LANG_')) 
	define('_FORM_ADD_NEW_USER_LANG_', 'Form Add New Users');

if (!defined('_ERROR_FULLNAME_LANG_')) 
	define('_ERROR_FULLNAME_LANG_', 'Please enter your full name. !');

if (!defined('_ERROR_MAILING_ADDRESS_LANG_')) 
	define('_ERROR_MAILING_ADDRESS_LANG_', 'Please enter your mailing address. !');

if (!defined('_ERROR_PHONE_NUMBER_LANG_')) 
	define('_ERROR_PHONE_NUMBER_LANG_', 'Please enter your primary phone number. !');

if (!defined('_ERROR_PHONE_FORMAT_LANG_')) 
	define('_ERROR_PHONE_FORMAT_LANG_', 'Primary phone Must be a Number. !');

if (!defined('_ERROR_EMAIL_LANG_')) 
	define('_ERROR_EMAIL_LANG_', 'Please enter your email. !');

if (!defined('_ERROR_EMAIL_FORMAT_LANG_')) 
	define('_ERROR_EMAIL_FORMAT_LANG_', 'Please enter a valid email address');

if (!defined('_ERROR_USERNAME_LANG_')) 
	define('_ERROR_USERNAME_LANG_', 'Please enter your Username. !');

if (!defined('_ERROR_PASSWORD_LANG_')) 
	define('_ERROR_PASSWORD_LANG_', 'Please enter your Password. !');

if (!defined('_ERROR_USERNAME_EXIST_LANG_')) 
	define('_ERROR_USERNAME_EXIST_LANG_', 'Sorry, Username Exist. !');

if (!defined('_ERROR_EMAIL_EXIST_LANG_')) 
	define('_ERROR_EMAIL_EXIST_LANG_', 'Sorry, Email Address already Exist. !');

if (!defined('_ERROR_UPLOAD_FAILED_LANG_')) 
	define('_ERROR_UPLOAD_FAILED_LANG_', 'Upload Failed, Make sure your photo *.JPG');

if (!defined('_VIEW_USER_DATA_LANG_')) 
	define('_VIEW_USER_DATA_LANG_', 'View Users Data');

if (!defined('_ERROR_INVALID_USER_DATA_LANG_')) 
	define('_ERROR_INVALID_USER_DATA_LANG_', 'Invalid User. !');

if (!defined('_USER_WORK_ORDER_MEMBER_LANG_')) 
	define('_USER_WORK_ORDER_MEMBER_LANG_', 'Work Order Members');

if (!defined('_NO_ASSOCIATE_WORK_ORDER_MEMBER_LANG_')) 
	define('_NO_ASSOCIATE_WORK_ORDER_MEMBER_LANG_', 'There is currently no associated Work Order members !');

if (!defined('_STATISTIC_USER_LANG_')) 
	define('_STATISTIC_USER_LANG_', 'Statistics for');

/*
 *---------------------------------------------------------------
 * CLIENT
 *---------------------------------------------------------------
 */

if (!defined('_ALL_CLIENT_LANG_')) 
	define('_ALL_CLIENT_LANG_', 'All Clients');

if (!defined('_ALL_ACTIVE_CLIENT_LANG_')) 
	define('_ALL_ACTIVE_CLIENT_LANG_', 'All Active Clients');

if (!defined('_ALL_ARCHIVE_CLIENT_LANG_')) 
	define('_ALL_ARCHIVE_CLIENT_LANG_', 'All Archived Clients');

if (!defined('_ADD_NEW_CLIENT_LANG_')) 
	define('_ADD_NEW_CLIENT_LANG_', 'Add New Client');

if (!defined('_EMAIL_ALL_CLIENT_LANG_')) 
	define('_EMAIL_ALL_CLIENT_LANG_', 'Email All Clients');

if (!defined('_SUCCESS_ADD_CLIENT_LANG_')) 
	define('_SUCCESS_ADD_CLIENT_LANG_', 'Client have been added. !');

if (!defined('_SUCCESS_UPDATE_CLIENT_LANG_')) 
	define('_SUCCESS_UPDATE_CLIENT_LANG_', 'Client have been updated. !');

if (!defined('_SUCCESS_ARCHIVE_CLIENT_LANG_')) 
	define('_SUCCESS_ARCHIVE_CLIENT_LANG_', 'Client have been Archived !');

if (!defined('_SUCCESS_UNARCHIVE_CLIENT_LANG_')) 
	define('_SUCCESS_UNARCHIVE_CLIENT_LANG_', 'Client have been Unarchived !');

if (!defined('_SUCCESS_DELETE_CLIENT_LANG_')) 
	define('_SUCCESS_DELETE_CLIENT_LANG_', 'Client have been deleted. !');

if (!defined('_SUCCESS_EMAIL_ALL_CLIENT_LANG_')) 
	define('_SUCCESS_EMAIL_ALL_CLIENT_LANG_', 'Send Email to All Clients. !');

if (!defined('_NO_CLIENT_LANG_')) 
	define('_NO_CLIENT_LANG_', 'There is currently no Client Data !');

if (!defined('_NO_ARCHIVE_CLIENT_LANG_')) 
	define('_NO_ARCHIVE_CLIENT_LANG_', 'There is currently no Archived Client Data !');

if (!defined('_SEND_EMAIL_ALL_CLIENT_LANG_')) 
	define('_SEND_EMAIL_ALL_CLIENT_LANG_', 'Send Email to All Active Clients');

if (!defined('_FORM_ADD_NEW_CLIENT_LANG_')) 
	define('_FORM_ADD_NEW_CLIENT_LANG_', 'Form Add New Clients');

if (!defined('_ERROR_SUBJECT_LANG_')) 
	define('_ERROR_SUBJECT_LANG_', 'Please enter Email Subject. !');

if (!defined('_ERROR_BODY_LANG_')) 
	define('_ERROR_BODY_LANG_', 'Please enter Email body / content. !');

if (!defined('_ERROR_FULLNAME_LANG_')) 
	define('_ERROR_FULLNAME_LANG_', 'Please enter your full name. !');

if (!defined('_ERROR_MAILING_ADDRESS_LANG_')) 
	define('_ERROR_MAILING_ADDRESS_LANG_', 'Please enter your mailing address. !');

if (!defined('_ERROR_PHONE_NUMBER_LANG_')) 
	define('_ERROR_PHONE_NUMBER_LANG_', 'Please enter your primary phone number. !');

if (!defined('_ERROR_PHONE_FORMAT_LANG_')) 
	define('_ERROR_PHONE_FORMAT_LANG_', 'Primary phone Must be a Number. !');

if (!defined('_ERROR_EMAIL_LANG_')) 
	define('_ERROR_EMAIL_LANG_', 'Please enter your email. !');

if (!defined('_ERROR_EMAIL_FORMAT_LANG_')) 
	define('_ERROR_EMAIL_FORMAT_LANG_', 'Please enter a valid email address');

if (!defined('_ERROR_USERNAME_LANG_')) 
	define('_ERROR_USERNAME_LANG_', 'Please enter your username. !');

if (!defined('_ERROR_PASSWORD_LANG_')) 
	define('_ERROR_PASSWORD_LANG_', 'Please enter your Password. !');

if (!defined('_ERROR_USERNAME_EXIST_LANG_')) 
	define('_ERROR_USERNAME_EXIST_LANG_', 'Sorry, username Exist. !');

if (!defined('_ERROR_EMAIL_EXIST_LANG_')) 
	define('_ERROR_EMAIL_EXIST_LANG_', 'Sorry, Email Address already Exist. !');

if (!defined('_ERROR_UPLOAD_FAILED_LANG_')) 
	define('_ERROR_UPLOAD_FAILED_LANG_', 'Upload Failed, Make sure your photo *.JPG');

if (!defined('_ERROR_ARCHIVE_LANG_')) 
	define('_ERROR_ARCHIVE_LANG_', 'Sorry, This client have active Work Order, cannot Archived. !');

if (!defined('_VIEW_CLIENT_DATA_LANG_')) 
	define('_VIEW_CLIENT_DATA_LANG_', 'View Client Data');

if (!defined('_ERROR_INVALID_CLIENT_DATA_LANG_')) 
	define('_ERROR_INVALID_CLIENT_DATA_LANG_', 'Invalid Client. !');

if (!defined('_CLIENT_WORK_ORDER_LANG_')) 
	define('_CLIENT_WORK_ORDER_LANG_', 'Work Orders');

if (!defined('_CLIENT_INVOICE_LANG_')) 
	define('_CLIENT_INVOICE_LANG_', 'Invoices');

if (!defined('_CLIENT_PAYMENT_LANG_')) 
	define('_CLIENT_PAYMENT_LANG_', 'Payment');

if (!defined('_NO_CLIENT_WORK_ORDER_LANG_')) 
	define('_NO_CLIENT_WORK_ORDER_LANG_', 'There is currently no Work Orders data !');

if (!defined('_NO_CLIENT_INVOICE_LANG_')) 
	define('_NO_CLIENT_INVOICE_LANG_', 'There is currently no Invoices data !');

if (!defined('_NO_CLIENT_PAYMENT_LANG_')) 
	define('_NO_CLIENT_PAYMENT_LANG_', 'There is currently no Payment data !');

if (!defined('_STATISTIC_CLIENT_LANG_')) 
	define('_STATISTIC_CLIENT_LANG_', 'Statistics for');

/*
 *---------------------------------------------------------------
 * PROFILE
 *---------------------------------------------------------------
 */

if (!defined('_MY_PROFILE_LANG_')) 
	define('_MY_PROFILE_LANG_', 'My Profile');

if (!defined('_SUCCESS_UPDATE_PROFILE_LANG_')) 
	define('_SUCCESS_UPDATE_PROFILE_LANG_', 'Your Profile have been updated. !');

if (!defined('_ERROR_FULLNAME_LANG_')) 
	define('_ERROR_FULLNAME_LANG_', 'Please enter your full name. !');

if (!defined('_ERROR_MAILING_ADDRESS_LANG_')) 
	define('_ERROR_MAILING_ADDRESS_LANG_', 'Please enter your mailing address. !');

if (!defined('_ERROR_PHONE_NUMBER_LANG_')) 
	define('_ERROR_PHONE_NUMBER_LANG_', 'Please enter your primary phone number. !');

if (!defined('_ERROR_PHONE_FORMAT_LANG_')) 
	define('_ERROR_PHONE_FORMAT_LANG_', 'Primary phone Must be a Number. !');

if (!defined('_ERROR_EMAIL_LANG_')) 
	define('_ERROR_EMAIL_LANG_', 'Please enter your email. !');

if (!defined('_ERROR_EMAIL_FORMAT_LANG_')) 
	define('_ERROR_EMAIL_FORMAT_LANG_', 'Please enter a valid email address');

if (!defined('_ERROR_USERNAME_LANG_')) 
	define('_ERROR_USERNAME_LANG_', 'Please enter your username. !');

if (!defined('_ERROR_PASSWORD_LANG_')) 
	define('_ERROR_PASSWORD_LANG_', 'Please enter your Password. !');

if (!defined('_ERROR_USERNAME_EXIST_LANG_')) 
	define('_ERROR_USERNAME_EXIST_LANG_', 'Sorry, username Exist. !');

if (!defined('_ERROR_EMAIL_EXIST_LANG_')) 
	define('_ERROR_EMAIL_EXIST_LANG_', 'Sorry, Email Address already Exist. !');

if (!defined('_ERROR_UPLOAD_FAILED_LANG_')) 
	define('_ERROR_UPLOAD_FAILED_LANG_', 'Upload Failed, Make sure your photo *.JPG');

if (!defined('_ERROR_INVALID_PROFILE_DATA_LANG_')) 
	define('_ERROR_INVALID_PROFILE_DATA_LANG_', 'Invalid Profile');

if (!defined('_VIEW_PROFILE_DATA_LANG_')) 
	define('_VIEW_PROFILE_DATA_LANG_', 'View Profile Data');

if (!defined('_PROFILE_WORK_ORDER_MEMBER_LANG_')) 
	define('_PROFILE_WORK_ORDER_MEMBER_LANG_', 'Work Order Members');

if (!defined('_PROFILE_WORK_ORDER_LANG_')) 
	define('_PROFILE_WORK_ORDER_LANG_', 'Work Orders');

if (!defined('_NO_ASSOCIATE_WORK_ORDER_MEMBER_LANG_')) 
	define('_NO_ASSOCIATE_WORK_ORDER_MEMBER_LANG_', 'There is currently no associated Work Order members !');

if (!defined('_STATISTIC_PROFILE_LANG_')) 
	define('_STATISTIC_PROFILE_LANG_', 'Your Statistics');

/*
 *---------------------------------------------------------------
 * WORK ORDER TYPE
 *---------------------------------------------------------------
 */

if (!defined('_ALL_SERVICE_LANG_'))  
	define('_ALL_SERVICE_LANG_', 'All Work Order Type');

if (!defined('_ALL_ACTIVE_SERVICE_LANG_'))  
	define('_ALL_ACTIVE_SERVICE_LANG_', 'All Active Work Order Type');

if (!defined('_ADD_NEW_SERVICE_LANG_'))  
	define('_ADD_NEW_SERVICE_LANG_', 'Add New Work Order Type');

if (!defined('_SUCCESS_ADD_SERVICE_LANG_'))  
	define('_SUCCESS_ADD_SERVICE_LANG_', 'Work Order Type have been added !');

if (!defined('_SUCCESS_UPDATE_SERVICE_LANG_'))  
	define('_SUCCESS_UPDATE_SERVICE_LANG_', 'Work Order Type have been updated !');

if (!defined('_SUCCESS_DELETE_SERVICE_LANG_'))  
	define('_SUCCESS_DELETE_SERVICE_LANG_', 'Work Order Type have been deleted. !');

if (!defined('_ERROR_CODE_LANG_'))  
	define('_ERROR_CODE_LANG_', 'Please enter work order code. !');

if (!defined('_ERROR_TITLE_LANG_'))  
	define('_ERROR_TITLE_LANG_', 'Please enter work order title. !');

if (!defined('_ERROR_DESC_LANG_'))  
	define('_ERROR_DESC_LANG_', 'Please enter work order description. !');

if (!defined('_ERROR_EXIST_CODE_LANG_'))  
	define('_ERROR_EXIST_CODE_LANG_', 'Sorry, Work order Code Exist. !');

if (!defined('_ERROR_EXIST_TITLE_LANG_'))  
	define('_ERROR_EXIST_TITLE_LANG_', 'Sorry, Work order Title already Exist. !');

if (!defined('_ERROR_INVALID_SERVICE_DATA_LANG_'))  
	define('_ERROR_INVALID_SERVICE_DATA_LANG_', 'Invalid Work Order Type');

if (!defined('_SERVICE_WORK_ORDER_ASSOCIATION_LANG_'))  
	define('_SERVICE_WORK_ORDER_ASSOCIATION_LANG_', 'Work Order Association');

if (!defined('_VIEW_SERVICE_DATA_LANG_'))  
	define('_VIEW_SERVICE_DATA_LANG_', 'View Work Order Type Data');

if (!defined('_PROFILE_WORK_ORDER_MEMBER_LANG_'))  
	define('_PROFILE_WORK_ORDER_MEMBER_LANG_', 'Work Order Members');

if (!defined('_NO_SERVICE_DATA_LANG_'))  
	define('_NO_SERVICE_DATA_LANG_', 'There is currently no Work Order Type Data !');

if (!defined('_NO_ASSOCIATE_WORK_ORDER_DATA_LANG_'))  
	define('_NO_ASSOCIATE_WORK_ORDER_DATA_LANG_', 'Sorry, This Service have Work Order Association, cannot Deleted. !');

if (!defined('_STATISTIC_SERVICE_LANG_'))  
	define('_STATISTIC_SERVICE_LANG_', 'Statistics for');

/*
 *---------------------------------------------------------------
 * MAIL BOX
 *---------------------------------------------------------------
 */

if (!defined('_MAILBOX_LANG_')) 
	define('_MAILBOX_LANG_', 'Mailbox');

if (!defined('_COMPOSE_MESSAGE_LANG_')) 
	define('_COMPOSE_MESSAGE_LANG_', 'Compose Message');

if (!defined('_SUCCESS_READ_MAIL_LANG_')) 
	define('_SUCCESS_READ_MAIL_LANG_', 'Mail have been read. !');

if (!defined('_SUCCESS_UNREAD_MAIL_LANG_')) 
	define('_SUCCESS_UNREAD_MAIL_LANG_', 'Mail have been Unread. !');

if (!defined('_SUCCESS_ARCHIVE_MAIL_LANG_')) 
	define('_SUCCESS_ARCHIVE_MAIL_LANG_', 'Mail have been archived. !');

if (!defined('_SUCCESS_UNARCHIVE_MAIL_LANG_')) 
	define('_SUCCESS_UNARCHIVE_MAIL_LANG_', 'Mail have been Unarchived. !');

if (!defined('_SUCCESS_COMPOSE_MAIL_LANG_')) 
	define('_SUCCESS_COMPOSE_MAIL_LANG_', 'Mail have been composed. !');

if (!defined('_SUCCESS_DELETE_MAIL_LANG_')) 
	define('_SUCCESS_DELETE_MAIL_LANG_', 'Mail have been deleted !');

if (!defined('_ERROR_RECIPIENT_LANG_')) 
	define('_ERROR_RECIPIENT_LANG_', 'Please select user recipient. !');

if (!defined('_ERROR_SUBJECT_LANG_')) 
	define('_ERROR_SUBJECT_LANG_', 'Please enter your mail subject. !');

if (!defined('_ERROR_BODY_LANG_')) 
	define('_ERROR_BODY_LANG_', 'Please enter your mail content. !');

if (!defined('_INBOX_LANG_')) 
	define('_INBOX_LANG_', 'Inbox');

if (!defined('_OUTBOX_LANG_')) 
	define('_OUTBOX_LANG_', 'Oubox');

if (!defined('_ARCHIVE_LANG_')) 
	define('_ARCHIVE_LANG_', 'Archived');

if (!defined('_COMPOSE_TITLE_LANG_')) 
	define('_COMPOSE_TITLE_LANG_', 'Compose New Mail');

if (!defined('_VIEW_TITLE_LANG_')) 
	define('_VIEW_TITLE_LANG_', 'View Mail');

if (!defined('_NO_INBOX_DATA_LANG_')) 
	define('_NO_INBOX_DATA_LANG_', 'There is currently no Inbox Mail Data !');

if (!defined('_NO_OUTBOX_DATA_LANG_')) 
	define('_NO_OUTBOX_DATA_LANG_', 'There is currently no Outbox Mail Data !');

if (!defined('_NO_ARCHIVE_DATA_LANG_')) 
	define('_NO_ARCHIVE_DATA_LANG_', 'There is currently no Archived Mail Data !');

/*
 *---------------------------------------------------------------
 * APP CONFIGURATIONS : GENERAL | PHASE | CURRENCY | ROLE
 *---------------------------------------------------------------
 */

if (!defined('_SETTING_LANG_')) 
	define('_SETTING_LANG_', 'App Configurations');

if (!defined('_GENERAL_SETTING_LANG_')) 
	define('_GENERAL_SETTING_LANG_', 'General Configurations');

if (!defined('_PHASE_SETTING_LANG_')) 
	define('_PHASE_SETTING_LANG_', 'Phase Configurations');

if (!defined('_CURRENCY_SETTING_LANG_')) 
	define('_CURRENCY_SETTING_LANG_', 'Currency Configurations');

if (!defined('_ROLE_SETTING_LANG_')) 
	define('_ROLE_SETTING_LANG_', 'Role Configurations');

if (!defined('_STATISTIC_SETTING_LANG_')) 
	define('_STATISTIC_SETTING_LANG_', 'Statistics');

if (!defined('_ADD_NEW_PHASE_LANG_')) 
	define('_ADD_NEW_PHASE_LANG_', 'Add New Phase');

if (!defined('_VIEW_PHASE_LANG_')) 
	define('_VIEW_PHASE_LANG_', 'View Phase');

if (!defined('_NO_PHASE_DATA_LANG_')) 
	define('_NO_PHASE_DATA_LANG_', 'There is currently no Phase Data !');

if (!defined('_ADD_NEW_CURRENCY_LANG_')) 
	define('_ADD_NEW_CURRENCY_LANG_', 'Add New Currency');

if (!defined('_VIEW_CURRENCY_LANG_')) 
	define('_VIEW_CURRENCY_LANG_', 'View Currency');

if (!defined('_NO_CURRENCY_DATA_LANG_')) 
	define('_NO_CURRENCY_DATA_LANG_', 'There is currently no Currency Data !');

if (!defined('_ADD_NEW_ROLE_LANG_')) 
	define('_ADD_NEW_ROLE_LANG_', 'Add New Role');

if (!defined('_VIEW_ROLE_LANG_')) 
	define('_VIEW_ROLE_LANG_', 'View Role');

if (!defined('_NO_ROLE_DATA_LANG_')) 
	define('_NO_ROLE_DATA_LANG_', 'There is currently no Role Data !');

if (!defined('_FORM_ADD_NEW_PHASE_LANG_')) 
	define('_FORM_ADD_NEW_PHASE_LANG_', 'Form Add New Phase');

if (!defined('_FORM_UPDATE_PHASE_LANG_')) 
	define('_FORM_UPDATE_PHASE_LANG_', 'Form Update Phase');

if (!defined('_FORM_ADD_NEW_CURRENCY_LANG_')) 
	define('_FORM_ADD_NEW_CURRENCY_LANG_', 'Form Add New Currency');

if (!defined('_FORM_UPDATE_CURRENCY_LANG_')) 
	define('_FORM_UPDATE_CURRENCY_LANG_', 'Form Update Currency');

if (!defined('_FORM_ADD_NEW_ROLE_LANG_')) 
	define('_FORM_ADD_NEW_ROLE_LANG_', 'Form Add New Role');

if (!defined('_FORM_UPDATE_ROLE_LANG_')) 
	define('_FORM_UPDATE_ROLE_LANG_', 'Form Update Role');

if (!defined('_ERROR_APP_URL_LANG_')) 
	define('_ERROR_APP_URL_LANG_', 'Please enter application URL. !');

if (!defined('_ERROR_APP_NAME_LANG_')) 
	define('_ERROR_APP_NAME_LANG_', 'Please enter application name. !');

if (!defined('_ERROR_BUSINESS_NAME_LANG_')) 
	define('_ERROR_BUSINESS_NAME_LANG_', 'Please enter Business Name. !');

if (!defined('_ERROR_BUSINESS_ADDRESS_LANG_')) 
	define('_ERROR_BUSINESS_ADDRESS_LANG_', 'Please enter Business Address. !');

if (!defined('_ERROR_BUSINESS_EMAIL_LANG_')) 
	define('_ERROR_BUSINESS_EMAIL_LANG_', 'Please enter Business Email. !');

if (!defined('_ERROR_BUSINESS_PHONE_LANG_')) 
	define('_ERROR_BUSINESS_PHONE_LANG_', 'Please enter Business Phone. !');

if (!defined('_ERROR_PHONE_FORMAT_LANG_')) 
	define('_ERROR_PHONE_FORMAT_LANG_', 'Business phone Must be a Number. !');

if (!defined('_ERROR_EMAIL_FORMAT_LANG_')) 
	define('_ERROR_EMAIL_FORMAT_LANG_', 'Please enter a valid email address');

if (!defined('_ERROR_UPLOAD_PATH_LANG_')) 
	define('_ERROR_UPLOAD_PATH_LANG_', 'Please enter upload path. !');

if (!defined('_ERROR_EXT_LANG_')) 
	define('_ERROR_EXT_LANG_', 'Please enter allowed file extensions. !');

if (!defined('_ERROR_UPLOAD_FAILED_LANG_')) 
	define('_ERROR_UPLOAD_FAILED_LANG_', 'Upload Failed, Make sure your photo *.JPG');

if (!defined('_ERROR_INVALID_PHASE_DATA_LANG_')) 
	define('_ERROR_INVALID_PHASE_DATA_LANG_', 'Invalid Phase.');

if (!defined('_ERROR_INVALID_CURRENCY_DATA_LANG_')) 
	define('_ERROR_INVALID_CURRENCY_DATA_LANG_', 'Invalid Currency');

if (!defined('_ERROR_INVALID_ROLE_DATA_LANG_')) 
	define('_ERROR_INVALID_ROLE_DATA_LANG_', 'Invalid Role');

if (!defined('_ERROR_PHASE_NAME_LANG_')) 
	define('_ERROR_PHASE_NAME_LANG_', 'Please enter phase name. !');

if (!defined('_ERROR_PHASE_ORDER_LANG_')) 
	define('_ERROR_PHASE_ORDER_LANG_', 'Please enter phase order. !');

if (!defined('_ERROR_EXIST_PHASE_COLOR_LANG_')) 
	define('_ERROR_EXIST_PHASE_COLOR_LANG_', 'Sorry, Phase color already exists. !');

if (!defined('_ERROR_EXIST_PHASE_ORDER_LANG_')) 
	define('_ERROR_EXIST_PHASE_ORDER_LANG_', 'Sorry, Phase order already exists. !');

if (!defined('_ERROR_PHASE_COUNT_ASSOCIATION_LANG_')) 
	define('_ERROR_PHASE_COUNT_ASSOCIATION_LANG_', 'Sorry, This Phase have Work Order Association, cannot Deleted. !');

if (!defined('_ERROR_CURRENCY_NAME_LANG_')) 
	define('_ERROR_CURRENCY_NAME_LANG_', 'Please enter currency name. !');

if (!defined('_ERROR_CURRENCY_SYMBOL_LANG_')) 
	define('_ERROR_CURRENCY_SYMBOL_LANG_', 'Please enter currency symbol. !');

if (!defined('_ERROR_EXIST_CURRENCY_NAME_LANG_')) 
	define('_ERROR_EXIST_CURRENCY_NAME_LANG_', 'Sorry, Currency name already exists. !');

if (!defined('_ERROR_EXIST_CURRENCY_SYMBOL_LANG_')) 
	define('_ERROR_EXIST_CURRENCY_SYMBOL_LANG_', 'Sorry, Currency symbol already exists. !');

if (!defined('_ERROR_CURRENCY_COUNT_ASSOCIATION_LANG_')) 
	define('_ERROR_CURRENCY_COUNT_ASSOCIATION_LANG_', 'Sorry, This Currency have Work Order Association, cannot Deleted. !');

if (!defined('_ERROR_ROLE_NAME_LANG_')) 
	define('_ERROR_ROLE_NAME_LANG_', 'Please enter role name. !');

if (!defined('_ERROR_ROLE_DESC_LANG_')) 
	define('_ERROR_ROLE_DESC_LANG_', 'Please enter role description. !');

if (!defined('_ERROR_EXIST_ROLE_NAME_LANG_')) 
	define('_ERROR_EXIST_ROLE_NAME_LANG_', 'Sorry, Role name already exists. !');

if (!defined('_ERROR_ROLE_COUNT_ASSOCIATION_LANG_')) 
	define('_ERROR_ROLE_COUNT_ASSOCIATION_LANG_', 'Sorry, This Role have Work Order Member Association, cannot Deleted. !');

if (!defined('_SUCCESS_UPDATE_SETTING_LANG_')) 
	define('_SUCCESS_UPDATE_SETTING_LANG_', 'General Configurations have been updated. !');

if (!defined('_SUCCESS_ADD_PHASE_LANG_')) 
	define('_SUCCESS_ADD_PHASE_LANG_', 'New Phase have been added.');

if (!defined('_SUCCESS_UPDATE_PHASE_LANG_')) 
	define('_SUCCESS_UPDATE_PHASE_LANG_', 'Phase have been updated.');

if (!defined('_SUCCESS_DELETE_PHASE_LANG_')) 
	define('_SUCCESS_DELETE_PHASE_LANG_', 'Phase have been deleted.');

if (!defined('_SUCCESS_ADD_CURRENCY_LANG_')) 
	define('_SUCCESS_ADD_CURRENCY_LANG_', 'New Currency have been added.');

if (!defined('_SUCCESS_UPDATE_CURRENCY_LANG_')) 
	define('_SUCCESS_UPDATE_CURRENCY_LANG_', 'Currency have been updated.');

if (!defined('_SUCCESS_DELETE_CURRENCY_LANG_')) 
	define('_SUCCESS_DELETE_CURRENCY_LANG_', 'Currency have been deleted.');

if (!defined('_SUCCESS_ADD_ROLE_LANG_')) 
	define('_SUCCESS_ADD_ROLE_LANG_', 'New Role have been added.');

if (!defined('_SUCCESS_UPDATE_ROLE_LANG_')) 
	define('_SUCCESS_UPDATE_ROLE_LANG_', 'Role have been updated.');

if (!defined('_SUCCESS_DELETE_ROLE_LANG_')) 
	define('_SUCCESS_DELETE_ROLE_LANG_', 'Role have been deleted.');

/*
 *---------------------------------------------------------------
 * REPORT
 *---------------------------------------------------------------
 */

if (!defined('_GENERATE_LANG_'))  
	define('_GENERATE_LANG_', 'Generate');

if (!defined('_ALL_REPORT_LANG_'))  
	define('_ALL_REPORT_LANG_', 'All Reports');

if (!defined('_REPORT_LANG_'))  
	define('_REPORT_LANG_', 'Reports');

if (!defined('_WORK_ORDER_REPORT_LANG_'))  
	define('_WORK_ORDER_REPORT_LANG_', 'Work Order Reports');

if (!defined('_TASK_REPORT_LANG_'))  
	define('_TASK_REPORT_LANG_', 'Task Reports');

if (!defined('_INVOICE_REPORT_LANG_'))  
	define('_INVOICE_REPORT_LANG_', 'Invoice Reports');

if (!defined('_PAYMENT_REPORT_LANG_'))  
	define('_PAYMENT_REPORT_LANG_', 'Invoice Payment Reports');

if (!defined('_FINANCE_REPORT_LANG_'))  
	define('_FINANCE_REPORT_LANG_', 'Finance Reports');

if (!defined('_CLIENT_REPORT_LANG_'))  
	define('_CLIENT_REPORT_LANG_', 'Client Reports');

if (!defined('_USER_REPORT_LANG_'))  
	define('_USER_REPORT_LANG_', 'User Reports');

if (!defined('_AUDIT_REPORT_LANG_'))  
	define('_AUDIT_REPORT_LANG_', 'Simple Audit Reports');

if (!defined('_NO_WORK_ORDER_DATA_LANG_'))  
	define('_NO_WORK_ORDER_DATA_LANG_', 'There is currently no Work Order Data !');

if (!defined('_NO_TASK_DATA_LANG_'))  
	define('_NO_TASK_DATA_LANG_', 'There is currently no Work Order Task Data !');

if (!defined('_NO_INVOICE_DATA_LANG_'))  
	define('_NO_INVOICE_DATA_LANG_', 'There is currently no Work Order Invoice Data !');

if (!defined('_NO_PAYMENT_DATA_LANG_'))  
	define('_NO_PAYMENT_DATA_LANG_', 'There is currently no Work Order Invoice Payment Data !');

if (!defined('_NO_CLIENT_DATA_LANG_'))  
	define('_NO_CLIENT_DATA_LANG_', 'There is currently no Client Data !');

if (!defined('_NO_USER_DATA_LANG_'))  
	define('_NO_USER_DATA_LANG_', 'There is currently no User Data !');

if (!defined('_NO_FINANCE_DATA_LANG_'))  
	define('_NO_FINANCE_DATA_LANG_', 'There is currently no Work Order Finance Data !');

if (!defined('_NO_AUDIT_DATA_LANG_'))  
	define('_NO_AUDIT_DATA_LANG_', 'There is currently no Audit Data !');

/*
 *---------------------------------------------------------------
 * INVOICE
 *---------------------------------------------------------------
 */

if (!defined('_INVOICE_LANG_')) 
	define('_INVOICE_LANG_', 'Invoices');

if (!defined('_INVALID_INVOICE_LANG_')) 
	define('_INVALID_INVOICE_LANG_', 'Invalid Invoice. !');

if (!defined('_ALL_INVOICE_LANG_')) 
	define('_ALL_INVOICE_LANG_', 'All Invoices');

if (!defined('_SUCCESS_ADD_INVOICE_LANG_')) 
	define('_SUCCESS_ADD_INVOICE_LANG_', 'Work Order Invoice have been added. !');

if (!defined('_SUCCESS_UPDATE_INVOICE_LANG_')) 
	define('_SUCCESS_UPDATE_INVOICE_LANG_', 'Work Order Invoice have been updated. !');

if (!defined('_SUCCESS_DELETE_INVOICE_LANG_')) 
	define('_SUCCESS_DELETE_INVOICE_LANG_', 'Work Order Invoice have been deleted. !');

if (!defined('_SUCCESS_CALCULATE_INVOICE_LANG_')) 
	define('_SUCCESS_CALCULATE_INVOICE_LANG_', 'Invoice Calculation have been saved and updated. !');

if (!defined('_SUCCESS_GENERATE_UPDATE_INVOICE_LANG_')) 
	define('_SUCCESS_GENERATE_UPDATE_INVOICE_LANG_', 'Work Order Invoice have been generated and updated. !');

if (!defined('_SUCCESS_SENT_INVOICE_LANG_')) 
	define('_SUCCESS_SENT_INVOICE_LANG_', 'Invoice have been sent. !');

if (!defined('_SUCCESSFULLY_SENT_INVOICE_LANG_')) 
	define('_SUCCESSFULLY_SENT_INVOICE_LANG_', 'This Invoice has been Successfully sent. !');

if (!defined('_SUCCESSFULLY_PAID_INVOICE_LANG_')) 
	define('_SUCCESSFULLY_PAID_INVOICE_LANG_', 'This Invoice has been Successfully PAID. !');

if (!defined('_NOTIFICATION_UNPAID_INVOICE_LANG_')) 
	define('_NOTIFICATION_UNPAID_INVOICE_LANG_', 'This Invoice was UNPAID. !');

if (!defined('_NO_INVOICE_DATA_LANG_')) 
	define('_NO_INVOICE_DATA_LANG_', 'There is currently no Invoice Data !');

if (!defined('_NO_INVOICE_ITEM_DATA_LANG_')) 
	define('_NO_INVOICE_ITEM_DATA_LANG_', 'There is currently no Invoice Item Data !');

if (!defined('_NO_INVOICE_PAYMENT_DATA_LANG_')) 
	define('_NO_INVOICE_PAYMENT_DATA_LANG_', 'There is currently no Invoice Payment Data !');

if (!defined('_INVOICE_ADD_ITEM_LANG_')) 
	define('_INVOICE_ADD_ITEM_LANG_', 'Add Invoice Item');

if (!defined('_INVOICE_EDIT_ITEM_LANG_')) 
	define('_INVOICE_EDIT_ITEM_LANG_', 'Edit Invoice Item');

if (!defined('_INVOICE_ADD_PAYMENT_LANG_')) 
	define('_INVOICE_ADD_PAYMENT_LANG_', 'Add Invoice Payment');

if (!defined('_INVOICE_EDIT_PAYMENT_LANG_')) 
	define('_INVOICE_EDIT_PAYMENT_LANG_', 'Edit Invoice Payment');

if (!defined('_INVOICE_TITLE_PAYMENT_LANG_')) 
	define('_INVOICE_TITLE_PAYMENT_LANG_', 'Invoice Payment Data');

if (!defined('_INVOICE_UPDATE_LANG_')) 
	define('_INVOICE_UPDATE_LANG_', 'Update Work Order Invoice');

if (!defined('_INVOICE_SEND_MAIL_LANG_')) 
	define('_INVOICE_SEND_MAIL_LANG_', 'Send Work Order Invoice');

if (!defined('_INVOICE_TO_LANG_')) 
	define('_INVOICE_TO_LANG_', 'To:');

if (!defined('_INVOICE_BILL_NO_LANG_')) 
	define('_INVOICE_BILL_NO_LANG_', 'BILL NO. :');

if (!defined('_INVOICE_DATE_LANG_')) 
	define('_INVOICE_DATE_LANG_', 'Date :');

if (!defined('_INVOICE_DUE_DATE_LANG_')) 
	define('_INVOICE_DUE_DATE_LANG_', 'Due Date :');

if (!defined('_INVOICE_CLIENT_REFERENCE_LANG_')) 
	define('_INVOICE_CLIENT_REFERENCE_LANG_', 'Client Reference');

if (!defined('_INVOICE_COMPANY_REFERENCE_LANG_')) 
	define('_INVOICE_COMPANY_REFERENCE_LANG_', 'Our Company Reference');

if (!defined('_INVOICE_CURRENCY_LANG_')) 
	define('_INVOICE_CURRENCY_LANG_', 'Currency');

if (!defined('_INVOICE_TOTAL_DUE_LANG_')) 
	define('_INVOICE_TOTAL_DUE_LANG_', 'Total Due');

if (!defined('_INVOICE_NO_LANG_')) 
	define('_INVOICE_NO_LANG_', 'No.');

if (!defined('_INVOICE_DESC_LANG_')) 
	define('_INVOICE_DESC_LANG_', 'Description');

if (!defined('_INVOICE_QTY_LANG_')) 
	define('_INVOICE_QTY_LANG_', 'Qty');

if (!defined('_INVOICE_AMOUNT_LANG_')) 
	define('_INVOICE_AMOUNT_LANG_', 'Amount');

if (!defined('_INVOICE_TOTAL_AMOUNT_LANG_')) 
	define('_INVOICE_TOTAL_AMOUNT_LANG_', 'Total Amount');

if (!defined('_INVOICE_TOTAL_PAYMENT_LANG_')) 
	define('_INVOICE_TOTAL_PAYMENT_LANG_', 'Total Payment');

if (!defined('_INVOICE_TAX_LANG_')) 
	define('_INVOICE_TAX_LANG_', 'TAX');

if (!defined('_INVOICE_BALANCE_DUE_LANG_')) 
	define('_INVOICE_BALANCE_DUE_LANG_', 'Balance Due');

if (!defined('_ERROR_ITEM_TITLE_LANG_')) 
	define('_ERROR_ITEM_TITLE_LANG_', 'Please enter item title. !');

if (!defined('_ERROR_ITEM_DESC_LANG_')) 
	define('_ERROR_ITEM_DESC_LANG_', 'Please enter item description. !');

if (!defined('_ERROR_FORMAT_QTY_LANG_'))
 	define('_ERROR_FORMAT_QTY_LANG_', 'Item Qty Must be a Number. !');

if (!defined('_ERROR_QTY_LANG_')) 
	define('_ERROR_QTY_LANG_', 'Please enter item Qty. !');

if (!defined('_ERROR_FORMAT_ITEM_AMOUT_LANG_')) 
	define('_ERROR_FORMAT_ITEM_AMOUT_LANG_', 'Item Amount Must be a Number. !');

if (!defined('_ERROR_ITEM_AMOUT_LANG_')) 
	define('_ERROR_ITEM_AMOUT_LANG_', 'Please enter item Amount. !');

if (!defined('_ERROR_NEGATIVE_AMOUT_LANG_')) 
	define('_ERROR_NEGATIVE_AMOUT_LANG_', 'Item Qty should not be negative value . !');

if (!defined('_ERROR_PAYMENT_DATE_LANG_')) 
	define('_ERROR_PAYMENT_DATE_LANG_', 'Please enter payment date. !');

if (!defined('_ERROR_PAYMENT_TYPE_LANG_')) 
	define('_ERROR_PAYMENT_TYPE_LANG_', 'Please enter payment Type. !');

if (!defined('_ERROR_FORMAT_PAYMENT_AMOUT_LANG_')) 
	define('_ERROR_FORMAT_PAYMENT_AMOUT_LANG_', 'Payment Amount Must be a Number. !');

if (!defined('_ERROR_PAYMENT_AMOUT_LANG_')) 
	define('_ERROR_PAYMENT_AMOUT_LANG_', 'Please enter payment Amount. !');

if (!defined('_ERROR_INVOICE_DATE_LANG_')) 
	define('_ERROR_INVOICE_DATE_LANG_', 'Please enter Work Order Invoice Date. !');

if (!defined('_ERROR_INVOICE_DUE_DATE_LANG_')) 
	define('_ERROR_INVOICE_DUE_DATE_LANG_', 'Please enter Work Order Invoice Due Date. !');

if (!defined('_ERROR_INVOICE_TAX_RATE_LANG_')) 
	define('_ERROR_INVOICE_TAX_RATE_LANG_', 'Please enter Work Order Invoice Tax Rate. !');

if (!defined('_ERROR_FORMAT_INVOICE_TAX_RATE_LANG_')) 
	define('_ERROR_FORMAT_INVOICE_TAX_RATE_LANG_', 'Invoice Tax Rate Must be a Number. !');

if (!defined('_ERROR_EXIST_INVOICE_NUMBER_LANG_')) 
	define('_ERROR_EXIST_INVOICE_NUMBER_LANG_', 'Sorry, Invoice Number already Exist. !');

if (!defined('_ERROR_EMAIL_SUBJECT_LANG_')) 
	define('_ERROR_EMAIL_SUBJECT_LANG_', 'Please enter Email subject. !');

if (!defined('_ERROR_EMAIL_TARGET_LANG_')) 
	define('_ERROR_EMAIL_TARGET_LANG_', 'Please enter Email Address. !');

if (!defined('_ERROR_FORMAT_EMAIL_TARGET_LANG_')) 
	define('_ERROR_FORMAT_EMAIL_TARGET_LANG_', 'Please enter a valid email address');

if (!defined('_ERROR_EMAIL_TEXT_LANG_')) 
	define('_ERROR_EMAIL_TEXT_LANG_', 'Please enter Email body / content. !');

/*
 *---------------------------------------------------------------
 * PROJECT
 *---------------------------------------------------------------
 */

if (!defined('_ALL_PROJECT_LANG_'))  
	define('_ALL_PROJECT_LANG_', 'All Work Orders');

if (!defined('_ALL_ACTIVE_PROJECT_LANG_'))  
	define('_ALL_ACTIVE_PROJECT_LANG_', 'All Active Work Order');

if (!defined('_ALL_ARCHIVE_PROJECT_LANG_'))  
	define('_ALL_ARCHIVE_PROJECT_LANG_', 'All Archived Work Order');

if (!defined('_ADD_NEW_PROJECT_LANG_'))  
	define('_ADD_NEW_PROJECT_LANG_', 'Add New Work Order');

if (!defined('_SUCCESS_ADD_PROJECT_LANG_'))  
	define('_SUCCESS_ADD_PROJECT_LANG_', 'New Work Order have been added. !');

if (!defined('_SUCCESS_DELETE_PROJECT_LANG_'))  
	define('_SUCCESS_DELETE_PROJECT_LANG_', 'Work Order have been deleted !');

if (!defined('_NO_ACTIVE_PROJECT_DATA_LANG_'))  
	define('_NO_ACTIVE_PROJECT_DATA_LANG_', 'There is currently no Active Work Order Data !');

if (!defined('_NO_ARCHIVE_PROJECT_DATA_LANG_'))  
	define('_NO_ARCHIVE_PROJECT_DATA_LANG_', 'There is currently no Archived Work Order Data !');

if (!defined('_FORM_ADD_NEW_PROJECT_LANG_'))  
	define('_FORM_ADD_NEW_PROJECT_LANG_', 'Form Add New Work Order');

if (!defined('_INVALID_PROJECT_LANG_'))  
	define('_INVALID_PROJECT_LANG_', 'Invalid Work Order. !');

if (!defined('_OVERVIEW_PROJECT_LANG_'))  
	define('_OVERVIEW_PROJECT_LANG_', 'Work Order Overview');

if (!defined('_DATE_ARCHIVE_PROJECT_LANG_'))  
	define('_DATE_ARCHIVE_PROJECT_LANG_', 'This Work Order is Archived at');

if (!defined('_INFORMATION_PROJECT_LANG_'))  
	define('_INFORMATION_PROJECT_LANG_', 'Work Order Information for :');

if (!defined('_MEMBER_PROJECT_LANG_')) 
 	define('_MEMBER_PROJECT_LANG_', 'Members');

if (!defined('_INVOICE_PROJECT_LANG_'))  
	define('_INVOICE_PROJECT_LANG_', 'Invoices');

if (!defined('_TASK_PROJECT_LANG_'))  
	define('_TASK_PROJECT_LANG_', 'Tasks');

if (!defined('_WORK_ORDER_TASK_LANG_'))  
	define('_WORK_ORDER_TASK_LANG_', 'Work Order Task');

if (!defined('_WORK_ORDER_SCHEDULE_LANG_'))  
	define('_WORK_ORDER_SCHEDULE_LANG_', 'Work Order Schedule');

if (!defined('_UPDATE_WORK_ORDER_LANG_'))  
	define('_UPDATE_WORK_ORDER_LANG_', 'Update Work Order');

if (!defined('_ADD_NEW_WORK_ORDER_TASK_LANG_'))  
	define('_ADD_NEW_WORK_ORDER_TASK_LANG_', 'Add New Work Order Task');

if (!defined('_ADD_NEW_WORK_ORDER_SCHEDULE_LANG_'))  
	define('_ADD_NEW_WORK_ORDER_SCHEDULE_LANG_', 'Add New Work Order Schedule');

if (!defined('_UPDATE_WORK_ORDER_TASK_LANG_'))  
	define('_UPDATE_WORK_ORDER_TASK_LANG_', 'Update Work Order Task');

if (!defined('_UPDATE_WORK_ORDER_SCHEDULE_LANG_'))  
	define('_UPDATE_WORK_ORDER_SCHEDULE_LANG_', 'Update Work Order Schedule');

if (!defined('_ADD_NEW_WORK_ORDER_MEMBER_LANG_'))  
	define('_ADD_NEW_WORK_ORDER_MEMBER_LANG_', 'Add New Work Order Member');

if (!defined('_DELETE_WORK_ORDER_MEMBER_LANG_')) 
 	define('_DELETE_WORK_ORDER_MEMBER_LANG_', 'Delete Work Order Member');

if (!defined('_ADD_NEW_WORK_ORDER_INCOME_LANG_'))  
	define('_ADD_NEW_WORK_ORDER_INCOME_LANG_', 'Add Work Order Income');

if (!defined('_UPDATE_WORK_ORDER_INCOME_LANG_'))  
	define('_UPDATE_WORK_ORDER_INCOME_LANG_', 'Update Work Order Income');

if (!defined('_ADD_NEW_WORK_ORDER_EXPENSE_LANG_'))  
	define('_ADD_NEW_WORK_ORDER_EXPENSE_LANG_', 'Add Work Order Expense');

if (!defined('_UPDATE_WORK_ORDER_EXPENSE_LANG_'))  
	define('_UPDATE_WORK_ORDER_EXPENSE_LANG_', 'Update Work Order Expense');

if (!defined('_ADD_NEW_WORK_ORDER_ATTACHMENT_LANG_'))  
	define('_ADD_NEW_WORK_ORDER_ATTACHMENT_LANG_', 'Add Work Order Attachment');

if (!defined('_WORK_ORDER_ATTACHMENT_LANG_'))  
	define('_WORK_ORDER_ATTACHMENT_LANG_', 'Work Order Attachment');

if (!defined('_ALL_WORK_ORDER_MEMBER_LANG_'))  
	define('_ALL_WORK_ORDER_MEMBER_LANG_', 'All Work Order members');

if (!defined('_ALL_WORK_ORDER_INVOICE_LANG_'))  
	define('_ALL_WORK_ORDER_INVOICE_LANG_', 'All Work Order Invoices');

if (!defined('_ALL_WORK_ORDER_FINANCE_LANG_'))  
	define('_ALL_WORK_ORDER_FINANCE_LANG_', 'All Work Order Finance');

if (!defined('_ALL_WORK_ORDER_ATTACHMENT_LANG_'))  
	define('_ALL_WORK_ORDER_ATTACHMENT_LANG_', 'All Work Order Attachment');

if (!defined('_ADD_NEW_WORK_ORDER_INVOICE_LANG_'))  
	define('_ADD_NEW_WORK_ORDER_INVOICE_LANG_', 'Add New Work Order Invoice');

if (!defined('_ERROR_PROJECT_STATUS_LANG_'))  
	define('_ERROR_PROJECT_STATUS_LANG_', 'Please check Work Order Status. !');

if (!defined('_ERROR_PROJECT_START_LANG_'))  
	define('_ERROR_PROJECT_START_LANG_', 'Please enter Work Order Start Date. !');

if (!defined('_ERROR_PROJECT_DEADLINE_LANG_'))  
	define('_ERROR_PROJECT_DEADLINE_LANG_', 'Please enter Work Order Deadline Date. !');

if (!defined('_ERROR_PROJECT_CLIENT_LANG_'))  
	define('_ERROR_PROJECT_CLIENT_LANG_', 'Please select Work Order Client. !');

if (!defined('_ERROR_PROJECT_TYPE_LANG_'))  
	define('_ERROR_PROJECT_TYPE_LANG_', 'Please select work order type. !');

if (!defined('_ERROR_PROJECT_CURRENCY_LANG_'))  
	define('_ERROR_PROJECT_CURRENCY_LANG_', 'Please select work order currency. !');

if (!defined('_ERROR_PROJECT_START_DEADLINE_LANG_'))  
	define('_ERROR_PROJECT_START_DEADLINE_LANG_', 'Work Order Start Date should not be less than Work Order Deadline Date. !');

if (!defined('_SUCCESS_UPDATE_PROJECT_LANG_'))  
	define('_SUCCESS_UPDATE_PROJECT_LANG_', 'Work Order have been updated. !');

if (!defined('_SUCCESS_ARCHIVE_PROJECT_LANG_'))  
	define('_SUCCESS_ARCHIVE_PROJECT_LANG_', 'Work Order have been Archived. !');

if (!defined('_SUCCESS_UNARCHIVE_PROJECT_LANG_'))  
	define('_SUCCESS_UNARCHIVE_PROJECT_LANG_', 'Work Order have been Unarchived. !');

if (!defined('_SUCCESS_ADD_TASK_LANG_'))  
	define('_SUCCESS_ADD_TASK_LANG_', 'Work Order Task have been Added. !');

if (!defined('_SUCCESS_UPDATE_TASK_LANG_'))  
	define('_SUCCESS_UPDATE_TASK_LANG_', 'Work Order Task have been Updated !');

if (!defined('_SUCCESS_DELETE_TASK_LANG_'))  
	define('_SUCCESS_DELETE_TASK_LANG_', 'Work Order Task have been Deleted !');

if (!defined('_SUCCESS_ADD_SCHEDULE_LANG_'))  
	define('_SUCCESS_ADD_SCHEDULE_LANG_', 'Work Order Schedule have been Added. !');

if (!defined('_SUCCESS_UPDATE_SCHEDULE_LANG_'))  
	define('_SUCCESS_UPDATE_SCHEDULE_LANG_', 'Work Order Schedule have been Updated. !');

if (!defined('_SUCCESS_DELETE_SCHEDULE_LANG_'))  
	define('_SUCCESS_DELETE_SCHEDULE_LANG_', 'Work Order Schedule have been Deleted. !');

if (!defined('_SUCCESS_ADD_MEMBER_LANG_'))  
	define('_SUCCESS_ADD_MEMBER_LANG_', 'Work Order Member have been Added and have been Notified by Email. !');

if (!defined('_SUCCESS_DELETE_MEMBER_LANG_'))  
	define('_SUCCESS_DELETE_MEMBER_LANG_', 'Work Order Member have been Deleted. !');

if (!defined('_SUCCESS_ADD_INCOME_LANG_'))  
	define('_SUCCESS_ADD_INCOME_LANG_', 'Work Order Income have been Added. !');

if (!defined('_SUCCESS_UPDATE_INCOME_LANG_'))  
	define('_SUCCESS_UPDATE_INCOME_LANG_', 'Work Order Income have been Updated !');

if (!defined('_SUCCESS_DELETE_INCOME_LANG_'))  
	define('_SUCCESS_DELETE_INCOME_LANG_', 'Work Order Income have been Deleted !');

if (!defined('_SUCCESS_ADD_EXPENSE_LANG_'))  
	define('_SUCCESS_ADD_EXPENSE_LANG_', 'Work Order Expense have been Added. !');

if (!defined('_SUCCESS_UPDATE_EXPENSE_LANG_'))  
	define('_SUCCESS_UPDATE_EXPENSE_LANG_', 'Work Order Expense have been Updated !');

if (!defined('_SUCCESS_DELETE_EXPENSE_LANG_'))  
	define('_SUCCESS_DELETE_EXPENSE_LANG_', 'Work Order Expense have been Deleted !');

if (!defined('_SUCCESS_ADD_FOLDER_LANG_'))  
	define('_SUCCESS_ADD_FOLDER_LANG_', 'Work Order Folder have been Added. !');

if (!defined('_SUCCESS_ADD_ATTACHMENT_LANG_'))  
	define('_SUCCESS_ADD_ATTACHMENT_LANG_', 'Work Order Attachment have been Added. !');

if (!defined('_SUCCESS_UPDATE_ATTACHMENT_LANG_'))  
	define('_SUCCESS_UPDATE_ATTACHMENT_LANG_', 'Work Order Attachment have been Updated !');

if (!defined('_SUCCESS_DELETE_ATTACHMENT_LANG_'))  
	define('_SUCCESS_DELETE_ATTACHMENT_LANG_', 'Work Order Attachment have been Deleted !');

if (!defined('_CLIENT_HAVE_QUESTION_LANG_'))  
	define('_CLIENT_HAVE_QUESTION_LANG_', 'Have a Questions ?');

if (!defined('_CLIENT_QUESTION_INSTRUCTION_LANG_'))  
	define('_CLIENT_QUESTION_INSTRUCTION_LANG_', 'Please contact list of members who have assigned for your order. Thanks !');

/*
 *---------------------------------------------------------------
 * AUDIT TRAILS
 *---------------------------------------------------------------
 */

if (!defined('_SUCCESS_LOGIN_LANG_'))  
	define('_SUCCESS_LOGIN_LANG_', 'was Successfully Login from IP : ');

if (!defined('_SUCCESS_ADD_USER_AUDIT_LANG_'))  
	define('_SUCCESS_ADD_USER_AUDIT_LANG_', 'was Successfully added new user');

if (!defined('_SUCCESS_UPDATE_USER_AUDIT_LANG_'))  
	define('_SUCCESS_UPDATE_USER_AUDIT_LANG_', 'was Successfully updated user');

if (!defined('_SUCCESS_UPDATE_EMAIL_USER_AUDIT_LANG_'))  
	define('_SUCCESS_UPDATE_EMAIL_USER_AUDIT_LANG_', 'was Successfully updated user Email Address');

if (!defined('_SUCCESS_UPDATE_USERNAME_USER_AUDIT_LANG_'))  
	define('_SUCCESS_UPDATE_USERNAME_USER_AUDIT_LANG_', 'was Successfully updated user Username');

if (!defined('_SUCCESS_DELETE_USER_AUDIT_LANG_'))  
	define('_SUCCESS_DELETE_USER_AUDIT_LANG_', 'was Successfully deleted user');

if (!defined('_SUCCESS_ADD_CLIENT_AUDIT_LANG_'))  
	define('_SUCCESS_ADD_CLIENT_AUDIT_LANG_', 'was Successfully added new client');

if (!defined('_SUCCESS_UPDATE_CLIENT_AUDIT_LANG_'))  
	define('_SUCCESS_UPDATE_CLIENT_AUDIT_LANG_', 'was Successfully updated client');

if (!defined('_SUCCESS_UPDATE_EMAIL_CLIENT_AUDIT_LANG_'))  
	define('_SUCCESS_UPDATE_EMAIL_CLIENT_AUDIT_LANG_', 'was Successfully updated client Email Address');

if (!defined('_SUCCESS_UPDATE_USERNAME_CLIENT_AUDIT_LANG_'))  
	define('_SUCCESS_UPDATE_USERNAME_CLIENT_AUDIT_LANG_', 'was Successfully updated client Username');

if (!defined('_SUCCESS_DELETE_CLIENT_AUDIT_LANG_'))  
	define('_SUCCESS_DELETE_CLIENT_AUDIT_LANG_', 'was Successfully deleted client');

if (!defined('_SUCCESS_ARCHIVE_CLIENT_AUDIT_LANG_'))  
	define('_SUCCESS_ARCHIVE_CLIENT_AUDIT_LANG_', 'was Successfully archived client');

if (!defined('_SUCCESS_UNARCHIVE_CLIENT_AUDIT_LANG_'))  
	define('_SUCCESS_UNARCHIVE_CLIENT_AUDIT_LANG_', 'was Successfully Unarchived client');

if (!defined('_SUCCESS_ADD_INVOICE_ITEM_AUDIT_LANG_'))  
	define('_SUCCESS_ADD_INVOICE_ITEM_AUDIT_LANG_', 'was Successfully added invoice item for invoice : #');

if (!defined('_SUCCESS_UPDATE_INVOICE_ITEM_AUDIT_LANG_'))  
	define('_SUCCESS_UPDATE_INVOICE_ITEM_AUDIT_LANG_', 'was Successfully updated invoice item for invoice : #');

if (!defined('_SUCCESS_DELETE_INVOICE_ITEM_AUDIT_LANG_'))  
	define('_SUCCESS_DELETE_INVOICE_ITEM_AUDIT_LANG_', 'was Successfully deleted invoice item for invoice : #');

if (!defined('_SUCCESS_ADD_INVOICE_PAYMENT_AUDIT_LANG_'))  
	define('_SUCCESS_ADD_INVOICE_PAYMENT_AUDIT_LANG_', 'was Successfully added invoice payment for invoice : #');

if (!defined('_SUCCESS_UPDATE_INVOICE_PAYMENT_AUDIT_LANG_'))  
	define('_SUCCESS_UPDATE_INVOICE_PAYMENT_AUDIT_LANG_', 'was Successfully updated invoice payment for invoice : #');

if (!defined('_SUCCESS_DELETE_INVOICE_PAYMENT_AUDIT_LANG_'))  
	define('_SUCCESS_DELETE_INVOICE_PAYMENT_AUDIT_LANG_', 'was Successfully deleted invoice payment for invoice : #');

if (!defined('_SUCCESS_SYNC_INVOICE_CALCULATION_AUDIT_LANG_'))  
	define('_SUCCESS_SYNC_INVOICE_CALCULATION_AUDIT_LANG_', 'was Successfully sync new calculation for invoice : #');

if (!defined('_SUCCESS_UPDATE_INVOICE_AUDIT_LANG_'))  
	define('_SUCCESS_UPDATE_INVOICE_AUDIT_LANG_', 'was Successfully updated invoice : #');

if (!defined('_SUCCESS_COMPLETE_INVOICE_AUDIT_LANG_'))  
	define('_SUCCESS_COMPLETE_INVOICE_AUDIT_LANG_', 'was Successfully completed invoice : #');

if (!defined('_SUCCESS_INCOMPLETE_INVOICE_AUDIT_LANG_'))  
	define('_SUCCESS_INCOMPLETE_INVOICE_AUDIT_LANG_', 'was Successfully roll back invoice : #');

if (!defined('_SUCCESS_DELETE_INVOICE_AUDIT_LANG_'))  
	define('_SUCCESS_DELETE_INVOICE_AUDIT_LANG_', 'was Successfully deleted invoice : #');

if (!defined('_SUCCESS_GENERATE_PDF_INVOICE_AUDIT_LANG_'))  
	define('_SUCCESS_GENERATE_PDF_INVOICE_AUDIT_LANG_', 'was Successfully generated pdf invoice : #');

if (!defined('_SUCCESS_DOWNLOAD_PDF_INVOICE_AUDIT_LANG_'))  
	define('_SUCCESS_DOWNLOAD_PDF_INVOICE_AUDIT_LANG_', 'was Successfully downloaded pdf invoice : #');

if (!defined('_SUCCESS_SEND_PDF_INVOICE_EMAIL_AUDIT_LANG_'))  
	define('_SUCCESS_SEND_PDF_INVOICE_EMAIL_AUDIT_LANG_', 'was Successfully send by email pdf invoice : #');

if (!defined('_SUCCESS_COMPOSE_MESSAGE_AUDIT_LANG_'))  
	define('_SUCCESS_COMPOSE_MESSAGE_AUDIT_LANG_', 'was Successfully composed message');

if (!defined('_SUCCESS_UPDATE_PROFILE_'))  
	define('_SUCCESS_UPDATE_PROFILE_', 'was Successfully updated profile');

if (!defined('_SUCCESS_UPDATE_EMAIL_'))  
	define('_SUCCESS_UPDATE_EMAIL_', 'was Successfully updated Email Address on profile page');

if (!defined('_SUCCESS_UPDATE_USERNAME_'))  
	define('_SUCCESS_UPDATE_USERNAME_', 'was Successfully updated username on profile page');

if (!defined('_SUCCESS_ADD_REQUEST_'))  
	define('_SUCCESS_ADD_REQUEST_', 'was Successfully added new work order request');

if (!defined('_SUCCESS_DELETE_REQUEST_'))  
	define('_SUCCESS_DELETE_REQUEST_', 'was Successfully deleted work order request');

if (!defined('_SUCCESS_REPSONSE_ORDER_'))  
	define('_SUCCESS_REPSONSE_ORDER_', 'was Successfully response work order request');

if (!defined('_SUCCESS_CONVERT_ORDER_'))  
	define('_SUCCESS_CONVERT_ORDER_', 'was Successfully convert / activate work order request');

if (!defined('_SUCCESS_ADD_PROJECT_')) 
 	define('_SUCCESS_ADD_PROJECT_', 'was Successfully added new work order');

if (!defined('_SUCCESS_UPDATE_PROJECT_'))  
	define('_SUCCESS_UPDATE_PROJECT_', 'was Successfully updated work order : #');

if (!defined('_SUCCESS_DELETE_PROJECT_'))  
	define('_SUCCESS_DELETE_PROJECT_', 'was Successfully deleted work order : #');

if (!defined('_SUCCESS_ARCHIVE_PROJECT_'))  
	define('_SUCCESS_ARCHIVE_PROJECT_', 'was Successfully archived work order : #');

if (!defined('_SUCCESS_UNARCHIVE_PROJECT_'))  
	define('_SUCCESS_UNARCHIVE_PROJECT_', 'was Successfully Unarchived work order : #');

if (!defined('_SUCCESS_ADD_TASK_PROJECT_'))  
	define('_SUCCESS_ADD_TASK_PROJECT_', 'was Successfully Added new task for work order : #');

if (!defined('_SUCCESS_UPDATE_TASK_PROJECT_'))  
	define('_SUCCESS_UPDATE_TASK_PROJECT_', 'was Successfully Updated task for work order : #');

if (!defined('_SUCCESS_DELETE_TASK_PROJECT_'))  
	define('_SUCCESS_DELETE_TASK_PROJECT_', 'was Successfully Deleted task for work order : #');

if (!defined('_SUCCESS_ADD_SCHEDULE_PROJECT_'))  
	define('_SUCCESS_ADD_SCHEDULE_PROJECT_', 'was Successfully Added new schedule for work order : #');

if (!defined('_SUCCESS_UPDATE_SCHEDULE_PROJECT_'))  
	define('_SUCCESS_UPDATE_SCHEDULE_PROJECT_', 'was Successfully Updated schedule for work order : #');

if (!defined('_SUCCESS_DELETE_SCHEDULE_PROJECT_'))  
	define('_SUCCESS_DELETE_SCHEDULE_PROJECT_', 'was Successfully Deleted schedule for work order : #');

if (!defined('_SUCCESS_ADD_MEMBER_PROJECT_'))  
	define('_SUCCESS_ADD_MEMBER_PROJECT_', 'was Successfully Added new member for work order : #');

if (!defined('_SUCCESS_DELETE_MEMBER_PROJECT_'))  
	define('_SUCCESS_DELETE_MEMBER_PROJECT_', 'was Successfully Deleted member for work order : #');

if (!defined('_SUCCESS_ADD_INCOME_PROJECT_'))  
	define('_SUCCESS_ADD_INCOME_PROJECT_', 'was Successfully Added new income for work order : #');

if (!defined('_SUCCESS_UPDATE_INCOME_PROJECT_'))  
	define('_SUCCESS_UPDATE_INCOME_PROJECT_', 'was Successfully Updated income for work order : #');

if (!defined('_SUCCESS_DELETE_INCOME_PROJECT_'))  
	define('_SUCCESS_DELETE_INCOME_PROJECT_', 'was Successfully Deleted income for work order : #');

if (!defined('_SUCCESS_ADD_EXPENSE_PROJECT_'))  
	define('_SUCCESS_ADD_EXPENSE_PROJECT_', 'was Successfully Added new expense for work order : #');

if (!defined('_SUCCESS_UPDATE_EXPENSE_PROJECT_'))  
	define('_SUCCESS_UPDATE_EXPENSE_PROJECT_', 'was Successfully Updated expense for work order : #');

if (!defined('_SUCCESS_DELETE_EXPENSE_PROJECT_'))  
	define('_SUCCESS_DELETE_EXPENSE_PROJECT_', 'was Successfully Deleted expense for work order : #');

if (!defined('_SUCCESS_ADD_ATTACHMENT_PROJECT_'))  
	define('_SUCCESS_ADD_ATTACHMENT_PROJECT_', 'was Successfully Added new attachment for work order : #');

if (!defined('_SUCCESS_UPDATE_ATTACHMENT_PROJECT_'))  
	define('_SUCCESS_UPDATE_ATTACHMENT_PROJECT_', 'was Successfully Updated attachment for work order : #');

if (!defined('_SUCCESS_DELETE_ATTACHMENT_PROJECT_'))  
	define('_SUCCESS_DELETE_ATTACHMENT_PROJECT_', 'was Successfully Deleted attachment for work order : #');

if (!defined('_SUCCESS_ADD_INVOICE_PROJECT_'))  
	define('_SUCCESS_ADD_INVOICE_PROJECT_', 'was Successfully Added new invoice for work order : #');

if (!defined('_SEND_EMAIL_USER_AUDIT_LANG_'))  
	define('_SEND_EMAIL_USER_AUDIT_LANG_', 'Send Email to All Active Users');

if (!defined('_SEND_EMAIL_CLIENT_AUDIT_LANG_'))  
	define('_SEND_EMAIL_CLIENT_AUDIT_LANG_', 'Send Email to All Active Clients');

if (!defined('_SUCCESS_ADD_SERVICE_'))  
	define('_SUCCESS_ADD_SERVICE_', 'was Successfully Added new Work Order Type');

if (!defined('_SUCCESS_UPDATE_SERVICE_'))  
	define('_SUCCESS_UPDATE_SERVICE_', 'was Successfully Updated Work Order Type');

if (!defined('_SUCCESS_DELETE_SERVICE_'))  
	define('_SUCCESS_DELETE_SERVICE_', 'was Successfully Deleted Work Order Type');

if (!defined('_SUCCESS_UPDATE_GENERAL_SETTING_'))  
	define('_SUCCESS_UPDATE_GENERAL_SETTING_', 'was Successfully updated general setting');

if (!defined('_SUCCESS_ADD_PHASE_'))  
	define('_SUCCESS_ADD_PHASE_', 'was Successfully Added new Phase');

if (!defined('_SUCCESS_UPDATE_PHASE_'))  
	define('_SUCCESS_UPDATE_PHASE_', 'was Successfully Updated Phase');

if (!defined('_SUCCESS_DELETE_PHASE_'))  
	define('_SUCCESS_DELETE_PHASE_', 'was Successfully Deleted Phase');

if (!defined('_SUCCESS_ADD_CURRENCY_'))  
	define('_SUCCESS_ADD_CURRENCY_', 'was Successfully Added new Currency');

if (!defined('_SUCCESS_UPDATE_CURRENCY_'))  
	define('_SUCCESS_UPDATE_CURRENCY_', 'was Successfully Updated Currency');

if (!defined('_SUCCESS_DELETE_CURRENCY_'))  
	define('_SUCCESS_DELETE_CURRENCY_', 'was Successfully Deleted Currency');

if (!defined('_SUCCESS_ADD_ROLE_'))  
	define('_SUCCESS_ADD_ROLE_', 'was Successfully Added new Role');

if (!defined('_SUCCESS_UPDATE_ROLE_'))  
	define('_SUCCESS_UPDATE_ROLE_', 'was Successfully Updated Role');

if (!defined('_SUCCESS_DELETE_ROLE_'))  
	define('_SUCCESS_DELETE_ROLE_', 'was Successfully Deleted Role');