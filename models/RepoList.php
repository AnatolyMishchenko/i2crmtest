<?php


namespace app\models;


use yii\base\Model;

class RepoList extends Model
{
    public $login;

    public function rules()
    {
        $array_rule = [
            ['login', 'string'],
            ['login', 'required'],
        ];
        return $array_rule;
    }

    /**
     * @return array profile form labels
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
        ];
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'repo_user';
    }

    public function getUsers() :array
    {
        $sql = 'SELECT * FROM repo_user';
        $logins = \Yii::$app->getDb()->createCommand($sql)->queryAll();

        return $logins;
    }

    public static function getRepoList() :array
    {
        $arrUsers = self::getUsers();
        $resultList = array();
        foreach($arrUsers as $userItem) {
            $curl_url = 'https://api.github.com/users/' . $userItem['login'] . '/repos';
            $ch = curl_init($curl_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Awesome-Octocat-App'));
            $output = curl_exec($ch);
            curl_close($ch);
            $output = json_decode($output);
            if(is_array($output)) {
                $resultList = array_merge($resultList, $output);
            }
        }
        usort($resultList, function($first, $second){
            $firstConvertToTime = strtotime($first->pushed_at);
            $secondConvertToTime = strtotime($second->pushed_at);

            return ($secondConvertToTime - $firstConvertToTime);
        });

        return $resultList;
    }

    public function saveRepoUser(array $arrData)
    {
        $login = $arrData['RepoList']['login'];
        $sql = "INSERT INTO repo_user(login) VALUE(:login)";
        \Yii::$app->getDb()->createCommand($sql, [':login' => $login])->execute();
    }

    public function deleteRepoUser(int $id)
    {
        $sql = "DELETE FROM repo_user WHERE id =".$id." ";
        \Yii::$app->getDb()->createCommand($sql)->execute();
    }
}