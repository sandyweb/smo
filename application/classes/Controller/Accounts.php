<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Accounts extends Controller_General {

    public function add($user_id, $type_id, $title, $description) {
        $model = new Model_Accounts();
        $model->title = $title;
        $model->description = $description;
        $model->accounts_types_id = $type_id;
        $model->users_id = $user_id;
        if ($model->save()) {
            return $model;
        } else {
            return FALSE;
        }
    }
    
    public function action_delete() {
        $id = $this->request->param('id');
        $model = new Model_Accounts($id);
        if (!$model->loaded()) {
            throw new HTTP_Exception_404("Page not found");
        }
        
        $model->delete();
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function edit() {
        
    }
    
    public function action_update() {
        
    }
    
    public function action_save() {
        if ($this->request->is_ajax()) {
            
        }
    }
    
    public function action_edit() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
            $account_id = $this->request->param('id');
            
            $model = new Model_Accounts($account_id);
            if (!$model->loaded()) {
                throw new HTTP_Exception_404("Not found page");
                exit;
            }
            
            try {
                if ($this->request->post()) {
                    $model->title = $this->request->post('title');
                    $model->description = $this->request->post('description');
                    $model->accounts_types_id = $this->request->post('type');

                    if ($model->save()) {
                        echo NULL;
                        exit;
                    }
                }
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
            
            $data['account'] = $model;
            $model = new Model_AccountsTypes();
            $data['networks_types'] = $model->find_all();
            echo view::factory('frontend/accounts/edit', $data)->set('form', $_POST)->bind('errors', $errors);
        }
    }
    
    public function action_add() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
            
            // If save
            if ($this->request->post()) {
                try {
                    $title = $this->request->post('title');
                    $description = $this->request->post('description');
                    $type_id = $this->request->post('type');
                    $user_id = $this->auth->get_user()->id;
                    $this->add($user_id, $type_id, $title, $description);
                    
                    echo NULL;
                    exit;
                } catch (ORM_Validation_Exception $e) {
                    $errors = $e->errors('validation');
                }
            }
            
            $model = new Model_AccountsTypes();
            $data['networks_types'] = $model->find_all();
            echo view::factory('frontend/accounts/add', $data)->set('form', $_POST)->bind('errors', $errors);
        }
    }
}
