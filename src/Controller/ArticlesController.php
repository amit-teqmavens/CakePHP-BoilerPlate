<?php
// src/Controller/ArticlesController.php

namespace App\Controller;
use Cake\Http\Exception\NotFoundException;

class ArticlesController extends AppController
{
     /**
     * Index method
     * It fetches a paginated set of articles from the database, using the Articles Model
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));//uses set() to pass the articles into its template 

        //check auth user or redirect to login
        if ($this->Auth->user()) {
            
        }else{
            $this->redirect("/");
        } 
    }

    /**
     * View method
     * This method show the article view specified by $slug
     * @param slug|null $slug post-name.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	public function view($slug = null)
	{
		//findBySlug() method allows us to create a basic query that finds articles by a given slug
	    $article = $this->Articles
	    		->findBySlug($slug)
	    		->first(); 
        
        //if page not found, redirect back to list view
        if(empty($article)) {
            $this->Flash->error(__('Article not found'));
            return $this->redirect(['action' => 'index']);
        }             
	    $this->set(compact('article')); 
	}

    /**
     * Add Article method
     * If the HTTP method of the request was POST, it saves the data using the Articles model.
     * @return \Cake\Http\Response|null Redirects on successful add article, renders view otherwise with user validation errors or other warnings..
     */ 	
 	public function add()
    {
            $methodType = 'add';
            $model = 'Articles';
            $redirectController = 'Articles';
            $redirectAction = 'index';
            $successMsg = 'You article has been saved.';
            $errorMsg = 'Unable to add your article. Please, try again.';
            $setVar = 'article';
            $passLoggedinUserId = 'yes';
            $sendEmail = 'no';
            
            // This is a common method add in AppController, used for adding/saving data into database, related to any form.
            $this->autoSave($methodType, $model, $setVar, $redirectController, $redirectAction, $successMsg, $errorMsg, $passLoggedinUserId, $sendEmail);

    }

    /**
     * Edit method
     * This method edit the article specified by $slug
     * @param string|null $slug post-name.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug)
	{
        //findBySlug() method allows us to create a basic query that finds articles by a given slug
        $article = $this->Articles
                ->findBySlug($slug)
                ->first(); 
        
        //if page not found, redirect back to list view
        if(empty($article)) {
            $this->Flash->error(__('Article not found'));
            return $this->redirect(['action' => 'index']);
        }

	    if ($this->request->is(['post', 'put'])) {
	        $this->Articles->patchEntity($article, $this->request->getData());

	        if ($this->Articles->save($article)) {
	            $this->Flash->success(__('Your article has been updated.'));
	            return $this->redirect(['action' => 'index']);
	        }
	        $this->Flash->error(__('Unable to update your article.'));
	    }

	    $this->set('article', $article);
	}

    /**
     * Delete method
     * This method deletes the article specified by $slug
     * @param string|null $slug post-name.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	public function delete($id = null)
	{
	    $this->request->allowMethod(['post', 'delete']); 

        $article = $this->Articles->get($id);
        pr($article); die;

        //if page not found, redirect back to list view
        if(empty($article)) {
            $this->Flash->error(__('Article not found'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Articles->delete($article)) {
            return $this->response->withType("application/json")->withStringBody(json_encode(array('status' => 'deleted'))); die;
        } else {
            return $this->response->withType("application/json")->withStringBody(json_encode(array('status' => 'error'))); die;
        }
                    
        return $this->redirect(['controller' => 'articles','action' => 'index']);        
	}


    /**
     * isAuthorized method
     * Adding authorization logic for articles
     * @return \Cake\Http\Response| redirects back to the referer.
     */
	public function isAuthorized($user)
	{
	    $action = $this->request->getParam('action');
	    // The add and tags actions are always allowed to logged in users.
	    if (in_array($action, ['index','add', 'tags','delete'])) {
	        return true;
	    }

	    // All other actions require a slug.
	    /*$slug = $this->request->getParam('pass.0');
	    if (!$slug) {
	        return false;
	    }*/
	}

}

