<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // Add the action to the allowed actions list.
        $this->Auth->allow();
        $this->loadComponent('Common');
    }

     /**
     * Index method
     * It fetches a paginated set of users from the database, using the Users Model
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function index()
    {
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));

        //check auth user or redirect to login
        if ($this->Auth->user()) {
            
        }else{
            $this->redirect("/");
        }   
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Articles']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add User method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Login method
     *
     * @return \Cake\Http\Response|null Redirects on login page.
     */
    public function login()
    {
        if ($this->request->is('post')) {
            try {
                $user = $this->Auth->identify();
                if ($user) {
                    if ($user['status']==2) { //check for inactive status
                        $this->Flash->error('Your account has been blocked. Please contact admin.');
                    } else {

                        // Code for Remember me option
                        if(isset($this->request->data['remember_me'])) {

                            if($this->request->data['remember_me'] == "1") {
                                $cookie = array();
                                $cookie['remember_me']  = $this->request->data['remember_me'];
                                $cookie['email']     = $this->request->data['username'];
                                $cookie['password']     = $this->request->data['password'];
                                $this->Cookie->write('rememberMe', $cookie, true, "1 week");
                                unset($this->request->data['remember_me']);
                            }else {
                                $this->Cookie->delete('rememberMe');
                            }

                        }else {
                            $this->Cookie->delete('rememberMe');
                        }


                        $this->Auth->setUser($user);
                        //return $this->redirect($this->Auth->redirectUrl());
                        $message = 'Logged in successfully.';
                        $this->Flash->success(__($message));  
                        return $this->redirect(['controller'=>'users']);  

                    }
                }
                else {
                    $this->Flash->error('Your email or password is incorrect.');
                }   

            } catch (Exception $e) {
                $message = $e->getMessage();
                $this->Flash->error($message);
            }  
                
        }
    }

    /**
     * Register method
     *
     * @return \Cake\Http\Response|null Redirects on register page.
     */
    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            //Generating a random token for security
            $random_token  = $this->Common->generateRandomString(4);
            $this->request->data['token'] = md5($this->request->data['email'].$random_token);
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            if($result = $this->Users->save($user)){
                                
                /******** Code for sending welcome email along with activation link*******/
                if(empty($this->request->data['id'])){
                    $activationlink  =  $this->siteUrl."users/activateaccount/".$result->token;
                    $contentArray = array(
                        '{SUBJECT}' =>"Welcome to Website",
                        '{NAME}' => ucwords($result->name),
                        '{USER_EMAIL}' => $result->email,
                        '{USER_PASSWORD}' => $this->request->data['password'],
                        '{ACTIVATION_LINK}' => $activationlink
                    );
                    $toEmail = $result->email;

                    $this->Common->sendEmail("REG002", $toEmail, $contentArray);    
                }   
                /******** Code for sending welcome email along with activation link*******/

                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['controller'=>'users','action'=>'login']);  
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
    * Function to activate account.
    * User will activate account using this function.
    */

    /**
     * Activate user's account
     *
     * @param string|null $token user token.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activateaccount($token = null){
        if(isset($token) && !empty($token)){ 
            $usersTable = TableRegistry::get('Users');
            
            $userId = $usersTable->getUserid($token);
            if(isset($userId) && !empty($userId)){
                $updateArraydata = array();
                $newArraydata = array();
                $updateArraydata = $usersTable->get($userId);    
              
                $newArraydata['status'] = 1; //setting user status to active => 1
                $newArraydata['token_status'] = 2; //setting token status to expired => 2
                $newArraydata['modified'] = date('Y-m-d H:i:s');

                $usersData = $usersTable->patchEntity($updateArraydata,$newArraydata);
                $errors = $usersData->errors();
              
                if(count($errors) <= 0){
                    if($usersTable->save($usersData)){
                        $message = 'Account activated successfully.';
                        $this->Flash->success(__($message));  
                        return $this->redirect(['controller'=>'users','action'=>'login']);          
                    }    
                }else{
                    $message = 'Problem while activating your account.';
                     $this->Flash->error(__($message));
                     return $this->redirect(['controller'=>'users','action'=>'login']);    
                }       
                
            }else{

                $message = 'Token has been expired.';  
                $this->Flash->error(__($message)); 
                return $this->redirect(['controller'=>'users','action'=>'login']);     
            }      
        }else{
            $message = 'Token key missing.';  
            $this->Flash->error(__($message));  
            return $this->redirect(['controller'=>'users','action'=>'login']);    

        }  

    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null Redirects on login page.
     */
    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }


}
