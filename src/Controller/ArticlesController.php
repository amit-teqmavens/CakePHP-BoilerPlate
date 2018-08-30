<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

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
	    		->firstOrFail(); //uses firstOrFail() to either fetch the first record, or throw a NotFoundException.
	    $this->set(compact('article')); 
	}

    /**
     * Add Article method
     * If the HTTP method of the request was POST, it saves the data using the Articles model.
     * @return \Cake\Http\Response|null Redirects on successful add article, renders view otherwise with user validation errors or other warnings..
     */ 	
 	public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) { // check if the request is a HTTP POST request.
            $article = $this->Articles->patchEntity($article, $this->request->getData()); //POST data is available in $this->request->getData()

			// Set the user_id from the session.
	        $article->user_id = $this->Auth->user('id');

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.')); //Use FlashComponent’s success() method to set a message into the session.
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article);
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
	    $article = $this->Articles
	    		->findBySlug($slug)
	    		->firstOrFail();

	    if ($this->request->is(['post', 'put'])) {
	        $this->Articles->patchEntity($article, $this->request->getData(), [
            // Added: Disable modification of user_id.
            'accessibleFields' => ['user_id' => false]
        	]);

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
	public function delete($slug)
	{
	    $this->request->allowMethod(['post', 'delete']); //If the user attempts to delete an article using a GET request, allowMethod() will throw an exception. Allowing content to be deleted using GET requests is very dangerous,

	    $article = $this->Articles
	    		->findBySlug($slug)
	    		->firstOrFail();

	    if ($this->Articles->delete($article)) {
	        $this->Flash->success(__('The {0} article has been deleted.', $article->title));
	        return $this->redirect(['action' => 'index']);
	    }
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
	    if (in_array($action, ['index','add', 'tags'])) {
	        return true;
	    }

	    // All other actions require a slug.
	    $slug = $this->request->getParam('pass.0');
	    if (!$slug) {
	        return false;
	    }

	    // Check that the article belongs to the current user.
	    $article = $this->Articles
	    		->findBySlug($slug)
	    		->first();

	    return $article->user_id === $user['id'];
	}

}

