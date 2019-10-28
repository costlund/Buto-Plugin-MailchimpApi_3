<?php
class PluginMailchimpApi_3{
  private $settings = null;
  private $data = null;
  private $list_id = null;
  private $api_key = null;
  private $data_center = null;
  function __construct() {
    $this->settings = wfPlugin::getPluginSettings('mailchimp/api_3', true);
    $this->data = new PluginWfArray(wfSettings::getSettingsFromYmlString($this->settings->get('data')));
    $this->list_id = $this->data->get('list_id');
    $this->api_key = $this->data->get('api_key');
    $this->data_center = substr($this->data->get('api_key'), strpos($this->data->get('api_key'), '-')+1);
  }
  public function add($email){
    /**
     * Add email
     * Return 200 on success or 400 else.
     */
    $url = 'https://'. $this->data_center .'.api.mailchimp.com/3.0/lists/'. $this->list_id .'/members';
    $json = json_encode([
        'email_address' => $email,
        'status'        => 'subscribed', //pass 'subscribed' or 'pending'
    ]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $this->api_key);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    $result = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $status_code;    
  }
  public function delete($email){
    /**
     * Delete email
     */
    $url = 'https://'. $this->data_center .'.api.mailchimp.com/3.0/lists/'. $this->list_id .'/members/'. md5(strtolower($email));
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $this->api_key);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);    
    return $status_code;    
  }
}
