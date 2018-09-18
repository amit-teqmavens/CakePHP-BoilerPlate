<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'storage' => [
                 'className' => 'Session',
                 'key' => 'Auth.User',
            ],
             //use isAuthorized in Controllers
            'authorize' => ['Controller'],
             // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => $this->referer()
        ]);

        // Allow the display action so our PagesController continues to work. Also enable the read only actions.
        $this->Auth->allow(['display', 'view', 'index','add', 'edit']);


        //Get site url configured in bootstrap.
        $SITEURL = Configure::read('SITEURL');
        $this->siteUrl = $SITEURL;

        if($this->Cookie->read('rememberMe') != null){
            $remembered_data = $this->Cookie->read('rememberMe');
            $this->set(compact('remembered_data'));
        }

        
        if($this->Auth->user()){ 
            $user = $this->Auth->user();
            $this->set('loginuserdata', $user);
        }

        // set pagination limit
        $this->paginate['limit'] = 15; 
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }


    public function isAuthorized($user)
    {
        // By default deny access.
        return false;
    }


    /**
     * autoSave method
     * This is a common method used for adding/saving data into database, related to any form.
     * @param methodType| method type as add/edit
     * @param model| model name to be used
     * @param setVar| variable that has been set, on the ctp file.
     * @param redirectController| controller name to which redirection will be done
     * @param redirectAction| controller's action to which redirection will be done
     * @param successMsg| message that will be shown after succesfull save.
     * @param errorMsg| message that we will be shown in case of any error.
     * @param passLoggedinUserId| set to 'yes', if loggedin user's id need to be saved as foreign key.
     * @param sendEmail| set to 'yes', if an email need to be sent
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function autoSave($methodType, $model, $setVar, $redirectController, $redirectAction, $successMsg, $errorMsg, $passLoggedinUserId ='no', $sendEmail = 'no', $EmailCode = '', $EmailSubject='')
    {
        /*$$setVar = $this->$model->newEntity();
        if ($this->request->is('post')) {
            try {           
                    $$setVar = $this->$model->patchEntity($$setVar, $this->request->getData());

                    if($passLoggedinUserId=='yes') {
                        // Set the user_id from the session.
                        $$setVar->user_id = $this->Auth->user('id');    
                    }
                    
                    if ($this->$model->save($$setVar)) {
                        $this->Flash->success(__($successMsg));
                        return $this->redirect(['controller'=> $redirectController ,'action'=> $redirectAction]);  
                    } else {
                        $this->Flash->error(__($errorMsg));
                    }            
            } catch (Exception $e) {
                $message = $e->getMessage();
                $this->Flash->error($message);
            } // end catch        
        } //end if 
        $this->set(compact($setVar));*/


        $$setVar = $this->$model->newEntity();
        if ($this->request->is('post')) { // checking if request if of 'post' type
            try {   
                    // patchEntity() will only save the fields that actually changed, instead of sending all fields to the database to be persisted.  
                    // It also validates the data, before it is copied to the entity      
                    // If you wish to disable validation while patching an entity, pass the validate option as false // $user->patchEntity($user, $data, ['validate' => false]);
                    $$setVar = $this->$model->patchEntity($$setVar, $this->request->getData());

                    if($passLoggedinUserId=='yes') {
                        // Set the user_id from the session.
                        $$setVar->user_id = $this->Auth->user('id');    
                    }
                    
                    if ($result = $this->$model->save($$setVar)) {

                        // Code for sending email. Common function added in Common component.
                        if($sendEmail == 'yes') {
                            if($result->email!="") {
                                $EmailContent = array(
                                    '{SUBJECT}' => $EmailSubject,
                                    '{NAME}' => ucwords($result->name),
                                    '{USER_EMAIL}' => $result->email,
                                    '{USER_PASSWORD}' => $this->request->data['password'],
                                    '{ACTIVATION_LINK}' => ''
                                );
                                $toEmail = $result->email;
                                $this->Common->sendEmail($EmailCode, $toEmail, $EmailContent);        
                            }
                            
                        }
                       
                        // Show success message to user
                        //$this->Flash->success(__($successMsg));

                        return $result;

                        // Redirect user to required action
                      //  return $this->redirect(['controller'=> $redirectController ,'action'=> $redirectAction]);  
                    } else {
                        // If validation fails entity will contain errors and errors will be displayed
                        $this->Flash->error(__($errorMsg));
                    }            
            } catch (Exception $e) { 
                $message = $e->getMessage();
                $this->Flash->error($message);
            } // end catch        
        } //end if 
        $this->set(compact($setVar));
    }

}
