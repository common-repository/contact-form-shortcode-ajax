<?php
/*
Plugin Name: Contact Form with Ajax
Description: Contact Form, Use shortcode: [cfa_contact_form redirect_page_id=14 to="youremail@gmail.com"]
Author: Faisal Alvi
Author URL: https://profiles.wordpress.org/faisal03
Version: 3.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


add_action('admin_menu', 'add_cfa_menu');

function add_cfa_menu () {
    add_submenu_page('options-general.php', 'CFA', 'CFA', 'manage_options', 'cfa', 'cfa_menu_html');
}

add_action('admin_init', 'register_cfa_settings');

function register_cfa_settings() {
    register_setting('cfa_group', 'cfa_option');
}

function cfa_menu_html() {

    ?>
    <h1>Contact Form with Ajax Settings</h1>

    <form method="post" action="options.php">
        <?php
            settings_fields('cfa_group');
            $options = get_option('cfa_option');
        ?>
        <!-- GOOGLE CAPTCHA BLOCK -->
		<div class="google-captcha section-block">
			<h1>Google Captcha</h1>
			<div class="section-block-inner">
				<table>
                    <tr>
                        <td colspan="2"><h2>Live Site</h2></td>
                    </tr>
					<tr>
						<th>Site Key</th>
						<td>
							<input class="go_sitekey" type="text" name="cfa_option[go][live_sitekey]" size="60" value="<?php echo $options['go']['live_sitekey']; ?>">
						</td>
					</tr>
					<tr>
						<th>Secret Key</th>
						<td>
							<input class="go_secretkey" type="text" name="cfa_option[go][live_secretkey]" size="60" value="<?php echo $options['go']['live_secretkey']; ?>">
						</td>
					</tr>
                    <tr>
                        <th></th>
                        <td><input type="submit" class="button-primary" value="Save"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><h2>Local Site</h2></td>
                    </tr>
					<tr>
						<th>Site Key</th>
						<td>
							<input class="go_sitekey" type="text" name="cfa_option[go][local_sitekey]" size="60" value="<?php echo $options['go']['local_sitekey']; ?>">
						</td>
					</tr>
					<tr>
						<th>Secret Key</th>
						<td>
							<input class="go_secretkey" type="text" name="cfa_option[go][local_secretkey]" size="60" value="<?php echo $options['go']['local_secretkey']; ?>">
						</td>
					</tr>
						<tr>
						<th></th>
						<td><input type="submit" class="button-primary" value="Save"></td>
					</tr>
				</table>
                <div style="margin: 10px 0 0;text-align:right;font-size: 12px;">Note: Don't worry! Server will be auto detected and respected keys will be applied.</div>
			</div>
		</div>
		<!-- END GOOGLE CAPTCHA BLOCK -->

        <!-- Contact Form Details BLOCK -->
        <div class="google-captcha section-block">
            <h1>Contact Form</h1>
            <div class="section-block-inner">
                <table>
                    <tr>
                        <th>To Email</th>
                        <td>
                            <input type="text" name="cfa_option[form][email]" size="60" value="<?php echo $options['form']['email']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Email Subject</th>
                        <td>
                            <input type="text" name="cfa_option[form][subject]" size="60" value="<?php echo $options['form']['subject']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Thank you Page</th>
                        <td>
                            <select name="cfa_option[form][thanks]">
                                <option value=""> -- Select Page -- </option>
                                <?php
                                $children = get_pages(
                                    array(
                                        'sort_column' => 'menu_order',
                                        'sort_order' => 'ASC',
                                        'hierarchical' => 0,
                                        'post_type' => 'page',
                                        'post_status' => 'publish'
                                    ));

                                foreach( $children as $post ) {
                                    if($options['form']['thanks'] == $post->ID) {
                                        echo "<option value='$post->ID' selected=selected>$post->post_title</option>";
                                    } else {
                                        echo "<option value='$post->ID'>$post->post_title</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><input type="submit" class="button-primary" value="Save"></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- END GOOGLE CAPTCHA BLOCK -->

    </form>
    <style>
        .info_span{
            font-size: 14px;margin-top: -5px;display: block;
        }
        .section-block input[type="text"], .section-block textarea, .section-block select {
            min-width: 500px;
            margin: 0 0 10px;
        }
        .section-block textarea {
            min-height: 100px;
        }
        .section-block table {
            border-collapse: collapse;
            width: 100%;
        }
        .section-block tr {
            border-bottom: 0px solid transparent;
        }
        .section-block td, .section-block th {
            padding-right: 30px;
        }
        .section-block td h2 {
            font-weight: 700;
            font-weight: 700;
            font-size: 16px;
            line-height: 20px;
            border-bottom: 1px solid;
            padding-bottom: 5px;
        }
        .section-block th {
            text-align: right;
            /*min-width: 130px;*/
            max-width: 50px;
            vertical-align: top;
            padding-top: 5px;
        }
        .section-block-inner{
            padding: 20px;
        }
        .section-block {
            background: rgb(223, 235, 239);
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            width: 95%;
            margin: 30px 0;
            -webkit-box-shadow: 0 0 3px rgba(35, 40, 45, 0.5);
            -moz-box-shadow: 0 0 3px rgba(35, 40, 45, 0.5);
            box-shadow: 0 0 3px rgba(35, 40, 45, 0.5);
        }
        .section-block h1 {
            margin: 0 0 0;
            background: #23282d;
            color: #FFF;
            line-height: 50px;
            padding-left: 20px;
            text-transform: uppercase;
            font-size: 20px;
        }
        .section-block h3 {
            margin-top: 0;
        }
    </style>
<?php
}

function cfa_contact_form_shortcode($attr) {

	if( file_exists(plugin_dir_path( __FILE__ ).'/form.php' )) {
			ob_start();
			include(plugin_dir_path( __FILE__ ).'form.php');
			return ob_get_clean();
	}
}
// Register the shortcode to the function ec_shortcode()
add_shortcode( 'cfa_contact_form', 'cfa_contact_form_shortcode' );

add_action( 'wp_enqueue_scripts', 'cfa_ajax_contact_scripts' );
function cfa_ajax_contact_scripts() {
	//css
    wp_enqueue_style( 'cfa_style', plugins_url( '/css/contact_style.css', __FILE__ ));

    //js
    wp_enqueue_script( 'cfa_contact_form', plugins_url( '/js/contact_script.js', __FILE__ ), array('jquery'), '1.0', true );
    wp_localize_script( 'cfa_contact_form', 'contact', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}

add_action( 'wp_ajax_nopriv_cfa_form_data_process', 'cfa_form_data_process_callback' );
add_action( 'wp_ajax_cfa_form_data_process', 'cfa_form_data_process_callback' );

//After submission process starts
function cfa_form_data_process_callback() {

	ob_clean();

	$data = $_POST['form_data'];
	parse_str($_POST['form_data'], $data);

	if($data['contact_form_email']){
		if ( $data['contact_nonce_field'] == '' ){
			echo ('Security check fail.');
			wp_die();
		}
	}

	//define vars
	$website            = get_bloginfo( 'name' );

    $to			        = $data['to'] != ''  ? sanitize_email($data['to']) : sanitize_email(get_option('admin_email'));
	$redirect_page_id   = esc_url($data['redirect_page_id']);
	$email_subject      = sanitize_text_field($data['email_subject']);
	$google_secretkey_local = sanitize_text_field($data['google_secretkey_local']);
	$google_secretkey_live  = sanitize_text_field($data['google_secretkey_live']);
	$type = 'contact enquiry';
	$recaptcha = $data['g-recaptcha-response'];

	if (!empty($recaptcha)) {

		$google_url = esc_url("https://www.google.com/recaptcha/api/siteverify");

        $whitelist = array( '127.0.0.1', '::1' );
        if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ) {
            $server = 'local';
        } else {
            $server = 'live';
        }

		if($server == 'local') {
			$secret = $google_secretkey_local;    //localhost

		} else { //if live
			$secret = $google_secretkey_live;
		}

		$ip=$_SERVER['REMOTE_ADDR'];
		$url = esc_url($google_url . "?secret=" . $secret . "&response=" . $recaptcha . "&remoteip=".$ip);
		$response = file_get_contents($url);
		$success =  $response.success;

		if($success == true)
		{
			// sanitize form values
			$fname   = sanitize_text_field( $data["contact_form_fname"] );
			$lname   = sanitize_text_field( $data["contact_form_lname"] );
			$email   = sanitize_email( $data["contact_form_email"] );
			$phone   = intval( $data["contact_form_phone"] );
			$enquiry = sanitize_text_field( $data["contact_form_enquiry"] );

			//Email Body Starts
			$body	=	"Hi $website<br><br>";

			$body	.=	"The following $type was submitted via the $website website. <br><br>";

			$body	.=	"<span>First Name</span>:	".$fname. " <br>";
			$body	.=	"<span>Last Name</span>:	".$lname. " <br>";
			$body	.=	"<span>Email</span>:	".$email. "<br>";

			if($phone)
				$body	.=	"<span>Phone</span>:	".$phone. "<br>";

			if($enquiry)
				$body	.=	"<span>Message</span>:	".$enquiry. "<br>";

			$body	.=	"<br>Please action this at your earliest convenience. <br><br>";

			$body	.=	"Thank you. <br><br>";

			$body	.=	"
					<style>
						body{
							font-size:12px;font-family: Arial;
						}
						span{
							width:80px;
						}
						</style>
					";

			$subject	=	"A $website $type was received via the website";
			$subject    = isset($email_subject) ? $email_subject : $subject;

			$headers = "From: $fname <$email>" . "\r\n";
			$headers .= "Content-type: text/html\r\n";
			$headers .= "Reply-To: $fname <$email>\r\n";

			// If email has been process for sending, display a success message
			if ( wp_mail( $to, $subject, $body, $headers ) ) {

				if(!$redirect_page_id) {
					echo '<div style="color:green;"><strong>Thank you.</strong></div>';
					echo "<script>jQuery('#cfa_contact_form').fadeOut(500);</script>";
				} else {
					echo 'redirect_please';
				}

			} else {
				echo 'An unexpected error occurred';
				echo "<script>jQuery('#contact_form_submit').removeClass('loading');</script>";
				echo "<script>jQuery('.contact_form_div').removeClass('loading_container');</script>";
			}

		}
		else{
			echo '<div style="color:#FF0000;"><strong>You have answered wrong to captcha.</strong></div>';
		}
	}
	else
	{
		echo '<div style="color:#FF0000;"><strong>Please answer the captcha.</strong></div>';
		echo "<script>jQuery('#contact_form_submit').removeClass('loading');</script>";
		echo "<script>jQuery('.contact_form_div').removeClass('loading_container');</script>";
	}
	wp_die();

}
?>