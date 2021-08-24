<?php


namespace app\controllers;

use app\models\RepoList;
use Yii;
use yii\web\Controller;

class RepoListController extends Controller
{
    public function actionCreate()
    {
        $model = new RepoList;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $arrData = Yii::$app->request->post();
            $model->saveRepoUser($arrData);
            $cache = Yii::$app->cache;
            $cache->delete('user_list');
            $this->refresh();
        }

        return $this->render('/repo_list/create', [
            'model' => $model,
        ]);
    }

    public function actionShow()
    {
        $cache = Yii::$app->cache;
        $key = 'user_list';
        $dataCache = $cache->getOrSet($key, function () {
            $model = new RepoList;
            return $model->getUsers();
        }, 600);

        return $this->render('/repo_list/show', [
            'userList' => $dataCache,
        ]);
    }

    public function actionDelete(int $id)
    {
        $model = new RepoList;
        $model->deleteRepoUser($id);
        $cache = Yii::$app->cache;
        $cache->delete('user_list');

        Yii::$app->response->redirect('/repo-list/show');
    }
}