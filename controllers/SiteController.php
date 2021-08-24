<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RepoList;

class SiteController extends Controller
{
     /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $cache = Yii::$app->cache;
        if(!empty($_GET['update']) && $_GET['update'] == 1) {
            $cache->delete('result_list');

            Yii::$app->response->redirect('/');
        }
        $key = 'result_list';
        $dataCache = $cache->getOrSet($key, function () {
            return RepoList::getRepoList();
        }, 600);

        return $this->render('index', ['resultList' => $dataCache]);
    }
}
