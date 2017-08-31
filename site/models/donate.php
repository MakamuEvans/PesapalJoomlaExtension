<?php
/**
 * Created by PhpStorm.
 * User: elm
 * Date: 8/31/17
 * Time: 10:40 AM
 */
defined('_JEXEC') or die('Restricted access');
include_once ('OAuth.php');
class DonateModelDonate extends JModelItem{
    /**
     *Model to process donation using Pesapal OAuth
     *
     * @since version
     */
    public function donate(){
        $token = $params = null;
        $key = '5Mpg2t/uDQqtrLJBfvRkVMaTjwmMZ4fP';
        $secret= '/44+Joj+qpbDia5weIyaUY16lxU=';
        $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
        $iframelink ="https://demo.pesapal.com/api/PostPesapalDirectOrderV4";
        $amount = $_POST['amount'];
        $desc = 'Test';
        $type = 'MERCHANT';
        $reference = uniqid();
        $first_name =  $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email =  $_POST['email'];
        $description =  "haa";
        $currency =  'KES';

        $donor = array();

        $callback_url =JURI::root().'index.php?option=com_donate';

        $post_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><PesapalDirectOrderInfo xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" Currency=\"".$currency."\" Amount=\"".$amount."\" Description=\"".$desc."\" Type=\"".$type."\" Reference=\"".$reference."\" FirstName=\"".$first_name."\" LastName=\"".$last_name."\" Email=\"".$email."\"  xmlns=\"http://www.pesapal.com\" />";
        $post_xml = htmlentities($post_xml);

        $consumer = new OAuthConsumer($key, $secret);


        $iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $iframelink, $params);
        $iframe_src->set_parameter("oauth_callback", $callback_url);
        $iframe_src->set_parameter("pesapal_request_data", $post_xml);
        $iframe_src->sign_request($signature_method, $consumer, $token);

        echo $iframe_src;
        JFactory::getApplication()->close();
    }
}