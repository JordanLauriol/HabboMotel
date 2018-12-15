<?php
namespace App\Controller;

use Cake\Event\Event;

class CatalogController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->viewBuilder()->setLayout('catalog');

        $this->loadModel('CatalogPages');
        $this->loadModel('CatalogItems');
        //$this->Auth->allow();

        if($this->Auth->user('rank') < 9) {
            return $this->redirect(['controller' => 'Avatars', 'action' => 'index']);
        }
    }

    public function beforeFilter(Event $event) {
        $this->Security->setConfig('unlockedActions', [
            'editCategoryById',
            'editFurnitureById'
        ]);

        $this->eventManager()->off($this->Csrf);
    }

    public function index() {
        $navigations = $this->CatalogPages->findByParentId('-1')
        ->order(['order_num' => 'ASC'])
        ->where(['visible' => '1'])
        ->all();
        $this->set(compact('navigations'));
    }

    public function getAllCategoriesById() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax')) {
            $navigationId = $this->request->getQuery('id');

            $categories = $this->CatalogPages->findByParentId($navigationId)
            ->order(['order_num' => 'ASC'])
            ->all();
        
            $this->set(compact('categories'));
        }
    }

    public function getAllSubCategoriesById() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax')) {
            $categoryId = $this->request->getQuery('id');

            $subCategories = $this->CatalogPages->findByParentId($categoryId)
            ->order(['order_num' => 'ASC'])
            ->all();
        
            if($subCategories->count() == 0) {
                die('null');
            }

            $this->set(compact('subCategories', 'categoryId'));
        }
    }

    public function getAllFurnituresById() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax')) {
            $subCategoryId = $this->request->getQuery('id');
            $caption = $this->request->getQuery('caption');

            $furnitures = $this->CatalogItems->findByPageId($subCategoryId)
            ->contain([
                'Furniture' => function($q) {
                    return $q->order(['sprite_id' => 'ASC']);
                }
            ])
            ->all();
        
            $this->set(compact('furnitures', 'subCategoryId', 'caption'));
        }
    }

    public function setOrderSubCategoryById() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax')) {
            $subCategories = $this->request->getQuery('subCategories');
            
            foreach($subCategories as $index => $subCategoryId) {
                $this->CatalogPages->updateAll([
                    'order_num' => $index += 1
                ], [
                    'id' => $subCategoryId
                ]);
            }
        }
    }

    public function setOrderCategoryById() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax')) {
            $categories = $this->request->getQuery('categories');
            
            foreach($categories as $index => $categoryId) {
                $this->CatalogPages->updateAll([
                    'order_num' => $index += 1
                ], [
                    'id' => $categoryId
                ]);
            }
        }
    }

    public function saveFurnitureToCategoryId() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax')) {
            $items = $this->request->getQuery('items');
            
            foreach($items as $item => $subCategoryId) {
                $this->CatalogItems->updateAll([
                    'page_id' => $subCategoryId
                ], [
                    'item_ids' => $item
                ]);
            }
        }
    }

    public function getCategoryById() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax')) {
            $id = $this->request->getQuery('id');
            $catalogPage = $this->CatalogPages->findById($id)->first();
            $this->set(compact('catalogPage'));
        }
    }

    public function editCategoryById() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax') && $this->request->is('post')) {
            $catalog = $this->CatalogPages->newEntity();
            $catalog = $this->CatalogPages->patchEntity($catalog, $this->request->getData('data'));
            $this->CatalogPages->save($catalog);
        }
    }

    public function getFurnitureById() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax')) {
            $id = $this->request->getQuery('id');
            $furniture = $this->CatalogItems->find()
            ->where(['item_ids' => $id])
            ->contain('Furniture')
            ->first();

            $this->set(compact('furniture'));
        }
    }

    public function editFurnitureById() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax') && $this->request->is('post')) {
            $furniture = $this->CatalogItems->newEntity();
            $furniture = $this->CatalogItems->patchEntity($furniture, $this->request->getData('data'), ['associated' => 'Furniture']);
            $this->CatalogItems->save($furniture, [
                'associated' => ['Furniture']
            ]);
        }
    }

    public function addCategory() {
        $this->viewBuilder()->setLayout('');

        if($this->request->is('ajax')) {
            $catalogPage = $this->CatalogPages->newEntity();         
            $this->set(compact('catalogPage'));
        }

        if($this->request->is('post')) {
            $catalogPage = $this->CatalogPages->newEntity();
            $catalogPage = $this->CatalogPages->patchEntity($catalogPage, $this->request->getData());
            $this->CatalogPages->save($catalogPage);

            return $this->redirect(['action' => 'index']);
        }
    }

    public function removeCategoryById($categoryId = null) {
        $this->viewBuilder()->setLayout('');

        if($categoryId != null) {
            $catalogPage = $this->CatalogPages->get($categoryId);
            $this->CatalogPages->delete($catalogPage);
            $this->CatalogItems->updateAll([
                'page_id' => 9895653
            ],[
                'page_id' => $categoryId
            ]);

            return $this->redirect(['action' => 'index']);
        }
    }
}