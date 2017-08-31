<?php
/**
 * Created by PhpStorm.
 * User: elm
 * Date: 8/31/17
 * Time: 10:40 AM
 */
defined('_JEXEC') or die('Restricted access');
include_once ('OAuth.php');
include_once ('xmlhttprequest.php');
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
        $period =  $_POST['period'];
        $currency =  'KES';

        $callback_url =JURI::root().'index.php?option=com_donate&view=completed';

        $post_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><PesapalDirectOrderInfo xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" Currency=\"".$currency."\" Amount=\"".$amount."\" Description=\"".$desc."\" Type=\"".$type."\" Reference=\"".$reference."\" FirstName=\"".$first_name."\" LastName=\"".$last_name."\" Email=\"".$email."\"  xmlns=\"http://www.pesapal.com\" />";
        $post_xml = htmlentities($post_xml);

        $consumer = new OAuthConsumer($key, $secret);


        $iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $iframelink, $params);
        $iframe_src->set_parameter("oauth_callback", $callback_url);
        $iframe_src->set_parameter("pesapal_request_data", $post_xml);
        $iframe_src->sign_request($signature_method, $consumer, $token);

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $columns = array('first_name', 'last_name', 'email','amount','period',
            'reference');
        $values = array($db->quote($first_name),$db->quote($last_name),
            $db->quote($email),$db->quote($amount),$db->quote($period),
            $db->quote($reference));
        $query->insert($db->quoteName('#__donation'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values ));
        $db->setQuery($query);
        $db->execute();

        echo $iframe_src;
        JFactory::getApplication()->close();
    }
    public function viewProgress($trackingId, $referenceNo){
        $token = $params = null;
        $requestUrl = "https://demo.pesapal.com/api/querypaymentstatusbymerchantref";
        if(!empty(trim($trackingId))){
            $requestUrl ="https://demo.pesapal.com/api/querypaymentdetails";
        }
        //$dconfig = JComponentHelper::getParams('com_pesapal');
        $key = '5Mpg2t/uDQqtrLJBfvRkVMaTjwmMZ4fP';
        $secret= '/44+Joj+qpbDia5weIyaUY16lxU=';
        $consumer = new OAuthConsumer($key,$secret);
        $signature_method = new OAuthSignatureMethod_HMAC_SHA1();


        $request_status = OAuthRequest::from_consumer_and_token($consumer, $token,"GET", $requestUrl, $params);
        $request_status->set_parameter("pesapal_merchant_reference", $referenceNo);
        if(!empty(trim($trackingId))) {
            $request_status->set_parameter("pesapal_transaction_tracking_id", $trackingId);
        }
        $request_status->sign_request($signature_method, $consumer, $token);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_status);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        if(defined('CURL_PROXY_REQUIRED')) if (CURL_PROXY_REQUIRED == 'True')
        {
            $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
            curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
            curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
        }

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $raw_header  = substr($response, 0, $header_size - 4);
        $headerArray = explode("\r\n\r\n", $raw_header);
        $header      = $headerArray[count($headerArray) - 1];

        //transaction status
        $elements = preg_split("/=/",substr($response, $header_size));
        //print_r($elements);
        $status = $elements[1];

        curl_close ($ch);
        return $status;
    }
}