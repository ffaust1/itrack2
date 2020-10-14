<?php


namespace app\controllers;


use app\models\CommentSearch;
use app\models\Contact;
use app\models\Comment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;

class ItrackController extends Controller
{
    public function actionList()
    {
        //выборка данных (с условиями если есть) для грида
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        //список колонок для грида
        $gridColumns = [
            'id',
            [
                'attribute' => 'email',
                'value' => function ($data) {
                    return $data->contact->email;
                },
            ],
            'text',
        ];

        $arr = [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'gridColumns' => $gridColumns,
        ];

        return $this->render('list', $arr);
    }

    public function actionCreate()
    {
        $mess = '';
        $sess = Yii::$app->session;
        $modelContact = new Contact();
        $modelComment = new Comment();

        //загружаем данные из формы в модели
        if ($modelContact->load(Yii::$app->request->post()) && $modelComment->load(Yii::$app->request->post())) {

            //валидация
            if ($modelContact->validate() && $modelComment->validate()) {
                //ищем контакт в таблице
                $z = Contact::findOne(['email' => $modelContact->email]);

                //если контакт не найден, то добавляем его
                if (!isset($z->id)) {
                    $modelContact->save();
                    $z = $modelContact;
                }

                //сохраняем комментарий
                $modelComment->link('contact', $z);
                $sess->setFlash('mess', 'Данные сохранены');
                return $this->refresh();
            } else {
                $sess->setFlash('mess', 'Ошибка валидации');
            }
        }

        $arr = [
            'contact' => $modelContact,
            'comment' => $modelComment,
        ];

        return $this->render('create', $arr);
    }

}