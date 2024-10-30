<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//define vars
$cfa_option = get_option('cfa_option');

$to			=	$cfa_option['form']['email'];
$redirect_page_id  =	$cfa_option['form']['thanks'];
$email_subject  =	$cfa_option['form']['subject'];

$google_sitekey_local =	isset($cfa_option['go']['local_sitekey']) ? $cfa_option['go']['local_sitekey'] : '';
$google_secretkey_local =	isset($cfa_option['go']['local_secretkey']) ? $cfa_option['go']['local_secretkey'] : '';

$google_sitekey_live =	isset($cfa_option['go']['live_sitekey']) ? $cfa_option['go']['live_sitekey'] : '';
$google_secretkey_live =	isset($cfa_option['go']['live_secretkey']) ? $cfa_option['go']['live_secretkey'] : '';

if( (!isset($google_secretkey_live) &&  !isset($google_sitekey_live))
    || (!isset($google_secretkey_local) &&  !isset($google_sitekey_local) ) ){
        echo '<div style="color: red;font-size: 12px;">You have not added Google Recaptcha Keys to your shortcode. Check readme.txt file for more information.</div>';
    }

$whitelist = array( '127.0.0.1', '::1' );
if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ) {
    $server = 'local';
} else {
    $server = 'live';
}

?>

<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="contact_form_container">
    <div id="result"></div>
    <form name="contact_form" id="cfa_contact_form" method="post" action="<?php the_permalink(); ?>" >
        <h2 class="cwhite">Contact Form</h2>

        <div class="control_row col_parent">
            <div class="control_box w50">
                <input id="contact_form_fname" name="contact_form_fname" type="text" placeholder="First Name*" required />
            </div>
            <div class="control_box w50">
                <input id="contact_form_lname" name="contact_form_lname" type="text" placeholder="Last Name*" required />
            </div>
        </div>

        <div class="control_row col_parent">
            <div class="control_box w50">
                <input id="contact_form_email" type="email" name="contact_form_email" placeholder="Email Address*"  required />
            </div>
            <div class="control_box w50">
                <input id="contact_form_phone" type="text" name="contact_form_phone" placeholder="Phone"  />
            </div>
        </div>

        <div class="control_row col_parent">
            <div class="control_box w50 message_box">
                <textarea width="100%" name="contact_form_enquiry" id="contact_form_enquiry" class="inputText-enquiry enq-textarea" required  placeholder="Message*"></textarea>
            </div>
            <div class="control_box w50 captcha_submit_box">
                <div class="captcha_box">
                    <?php if($server == 'local') { ?>
                    <div class="g-recaptcha" data-sitekey="<?php echo $google_sitekey_local; ?>"></div> <!-- localhost -->

                    <?php } else { //if live?>
                        <div class="g-recaptcha" data-sitekey="<?php echo $google_sitekey_live; ?>"></div> <!-- Concept -->
                    <?php } ?>
                </div>
                <div class="contact_form_div submit_box">
                    <input type="submit" name="submit" value="Submit" id="contact_form_submit" class="btn_theme all_form_submit"/>
                    <input type="hidden" name="redirect_page_id" id="redirect_page_id" value="<?php if(isset($redirect_page_id)) echo esc_url(get_the_permalink($redirect_page_id)); ?>" >
                    <input type="hidden" name="google_secretkey_local" value="<?php echo $google_secretkey_local; ?>" >
                    <input type="hidden" name="google_secretkey_live" value="<?php echo $google_secretkey_live; ?>" >
                    <input type="hidden" name="to" value="<?php echo $to?>">
                    <input type="hidden" name="email_subject" value="<?php echo $email_subject?>">
                </div>
            </div>
        </div>
	    <?php wp_nonce_field('contact_nonce_action','contact_nonce_field'); ?>
    </form>
</div>