<?php
/**
 * Created by PhpStorm.
 * User: elm
 * Date: 8/31/17
 * Time: 10:43 AM
 */
class DonateController extends JControllerLegacy{
    /**
     *controller method to process donation details and call Pesapal API
     *
     * @since version
     */
    public function donate(){
        $model = $this->getModel('donate');
        $model->donate();
    }

    /**
     *Controller method to check status of a payment from Pesapal Servers
     *
     * @since version
     */
    public function status(){
        $reference_no = $_POST['pesapal_merchant_reference'];
        $tracking_id = $_POST['pesapal_transaction_tracking_id'];
        $model= $this->getModel('donate');
        $status= $model->viewProgress($tracking_id,$reference_no);
        $status = explode(',', $status);

        //print_r($status);
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $fields = array($db->quoteName('status').'='.$db->quote($status[2]),
            $db->quoteName('method').'='.$db->quote($status[1]),
            $db->quoteName('tracking_id').'='.$db->quote($tracking_id),
        );

        $conditions = array($db->quoteName('reference').'='.$db->quote($reference_no));

        $query->update($db->quoteName('#__donation'))
            ->set($fields)
            ->where($conditions);
        $db->setQuery($query)->execute();

        echo json_encode($status);
        JFactory::getApplication()->close();
    }
}