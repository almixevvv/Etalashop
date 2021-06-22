<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'Home/index';

/* Search Product */
$route['search'] = "Home/search";

/* Account Registration & Login */
$route['login'] = 'General/Login';
$route['logout'] = 'General/Login/logout';
$route['register'] = 'General/Register';
$route['social'] = 'General/Login/social';
$route['account'] = 'General/account/view';
$route['register/verification'] = 'General/Register/input';
$route['verification'] = 'Home/index';

/* User Profile Part */
$route['profile/transaction'] = 'General/Profile/transaction';
$route['profile/myprofile'] = 'General/Profile/myprofile';
$route['profile/history/:any'] = 'General/Profile/history';

/* Reset Password Part */
$route['profile/forgot_password'] = 'General/Login/forgot_password';
$route['profile/forgot_password/completed'] = 'General/Login/completeResetPassword';
$route['profile/reset'] = 'General/ResetPassword';

$route['home'] = 'Home/index';
$route['about-us'] = 'Home/AboutUs';
$route['privacy'] = 'Home/privacy';
$route['contacts'] = 'Home/contactus';
$route['faq'] = 'Home/faq';
$route['terms'] = 'Home/terms';
$route['how-to'] = 'Home/howto';
$route['categories'] = 'Home/categories';

/* Shopping Cart Part */
$route['cart/checkout'] = 'General/Checkout/index';
$route['cart/addtocart'] = 'General/Cart/addtocart';
$route['order/success'] = 'General/Checkout/checkoutSuccess';
$route['order/payment'] = 'General/Profile/orderPayment';
$route['order/confirmation'] = 'General/Profile/manualVerification';
$route['payment/confirmation'] = 'General/PaymentProcess/confirmationPage';

/* CMS Part */
$route['cms'] = 'CMS/CMS';
$route['cms/login'] = 'CMS/CMS';
$route['cms/dashboard'] = 'CMS/CMS/dashboard';
$route['cms/banner'] = 'CMS/Banner_cms';
$route['cms/member'] = 'CMS/Member_cms';
$route['cms/about'] = 'CMS/About_cms';
$route['cms/contact'] = 'CMS/Contact_cms';
$route['cms/terms'] = 'CMS/Terms_cms';
$route['cms/faq'] = 'CMS/Faq_cms';
$route['cms/privacy'] = 'CMS/Privacy_cms';
$route['cms/orders'] = 'CMS/Orders_cms';
$route['cms/margin'] = 'CMS/Margin_cms';
$route['cms/howto'] = 'CMS/Howto_cms';
$route['cms/products'] = 'CMS/Product_cms';
$route['cms/orders/status'] = 'CMS/Orders_cms/status';

$route['API/completePayment'] = 'General/Checkout/postPaymentProcess';


/* ROUTES FOR PROCESS */
$route['addcart'] = 'Cart/addtocart';

/* Basic Part */
$route['change_pass'] = 'cpassword/view';
$route['product'] = 'General/Product/view';
$route['product_detail'] = 'General/Product_detail/view';
$route['mycart'] = 'General/Cart/mycart';
$route['register_success'] = 'General/page_success/register_success';
$route['preorder_success'] = 'General/page_success/preorder_success';
$route['forgot_pass_success'] = 'General/page_success/forgot_pass_success';
$route['verify'] = 'General/page_success/verify';
$route['history_order'] = 'General/history_order/view';
