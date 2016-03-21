<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['facebook_app_id']              = '771935089604040';
$config['facebook_app_secret']          = '015d6182dc44a69d43e2fa62bf0d6e01';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = site_url('social/register_facebook');
$config['facebook_logout_redirect_url'] = site_url('example/logout');
$config['facebook_permissions']         = array('email', 'public_profile', 'publish_actions');
$config['facebook_graph_version']       = 'v2.5';