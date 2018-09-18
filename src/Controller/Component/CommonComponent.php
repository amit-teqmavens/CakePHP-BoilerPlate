<?php
namespace App\Controller\Component;
use Cake\Core\Configure;

use Cake\Controller\Component;
use Cake\Mailer\Email;
use Cake\Network\Http\Client;

// In a controller or table method.
use Cake\ORM\TableRegistry;

class CommonComponent extends Component
{


    public function sendEmail($emailCode, $toEmail, $contentArray)
    {
        if ($emailCode != "" && $toEmail != "") {
            $email_template_obj = TableRegistry::get('EmailTemplates');
            $emailDetails = $email_template_obj->find('all')->where(['code' => $emailCode])->first();

            $content = "";
            $subject = "";

            if(isset($emailDetails)){
                $subject = $emailDetails->subject;

                $content = $emailDetails->content;

                if (is_array($contentArray) && !empty($contentArray)) {

                    foreach ($contentArray as $key => $value) {                        
                        $content = str_replace($key, $value, $content);
                        $subject = str_replace($key, $value, $subject);
                        
                    }
                } else {

                    $content = $contentArray;
                }
            } else {
                $content = $contentArray;
            }
            $email = new Email();
            $email->from(['tqminternal@gmail.com' => 'XYZ Team'])
                ->emailFormat('html')
                ->to($toEmail)
                ->subject($subject)
                ->send($content);
        
            return true;
               
        } else {
              
                return false;
            }
    }



    //Public function for Generate Randon string.
    public function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString; 
    }
    
   
    
}
