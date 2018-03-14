<?php

namespace app\controllers;

use app\models\Authors;
use app\models\Languages;
use DateTime;
use Yii;
use app\models\Posts;
use app\models\PostsSearch;
use yii\base\Object;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    public static $titles = [
        'Русский' => [
            'жесть', 'удивительно', 'снова', 'совсем', 'шок', 'случай', 'сразу', 'событие', 'начало', 'вирус'
        ],
        'English' => [
            'currency', 'amazing', 'again', 'absolutely', 'shocking', 'case', 'immediately', 'event', 'beginning', 'virus'
        ],
    ];

    public static $texts = [
        'Русский' => [
            'один', 'еще', 'бы', 'такой', 'только', 'себя', 'свое', 'какой', 'когда', 'уже', 'для', 'вот', 'кто',
            'да', 'говорить', 'год', 'знать', 'мой', 'до', 'или', 'если', 'время', 'рука', 'нет', 'самый', 'ни',
            'стать', 'большой', 'даже', 'другой', 'наш', 'свой', 'ну', 'под', 'где', 'дело', 'есть', 'сам', 'раз',
            'чтобы', 'два', 'там', 'чем', 'глаз', 'жизнь', 'первый', 'день', 'тута', 'во', 'ничто', 'потом', 'очень',
            'со', 'хотеть', 'ли', 'при', 'голова', 'надо', 'без', 'видеть', 'идти', 'теперь', 'тоже', 'стоять', 'друг',
            'дом', 'сейчас', 'можно', 'после', 'слово', 'здесь', 'думать', 'место', 'спросить', 'через', 'лицо', 'что',
            'тогда', 'ведь', 'хороший', 'каждый', 'новый', 'жить', 'должный', 'смотреть', 'почему', 'потому', 'сторона',
            'просто', 'нога', 'сидеть', 'понять', 'иметь', 'конечный', 'делать', 'вдруг', 'над', 'взять', 'никто', 'сделать'
        ],
        'English' => [
            'one', 'yet', 'would', 'such', 'only', 'yourself', 'his', 'what', 'when', 'already', 'for', 'behold', 'Who',
            'yes', 'speak', 'year', 'know', 'my', 'before', 'or', 'if', 'time', 'arm', 'no', 'most', 'nor', 'become',
            'big', 'even', 'other', 'our', 'his', 'well', 'under', 'where', 'a business', 'there is', 'himself',
            'time', 'that', 'two', 'there', 'than', 'eye', 'a life', 'first', 'day', 'mulberry', 'in', 'nothing',
            'later', 'highly', 'with', 'to want', 'whether', 'at', 'head', 'need', 'without', 'see', 'go', 'now',
            'also', 'stand', 'friend', 'house', 'now', 'can', 'after', 'word', 'here', 'think', 'a place', 'ask',
            'across', 'face', 'what', 'then', 'after all', 'good', 'each', 'new', 'live', 'due', 'look', 'why',
            'because', 'side', 'just', 'leg', 'sit', 'understand', 'have', 'finite', 'do', 'all of a sudden',
            'above', 'to take', 'no one', 'make'
        ]
    ];

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Posts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Generates posts with random values
     */
    public function actionPosts()
    {
        $count = 10;
        $posts = '';

        for ($i = 0; $i < $count; $i++) {
            $source = $this->generateRandomValues();
            $model = new Posts();
            $model->language_id = $source['lang'];
            $model->author_id = $source['author'];
            $model->title = $source['title'];
            $model->text = $source['text'];
            $model->count = $source['count'];
            $model->created_at = $source['randDate'];

            if ($model->save() && $model->hasErrors() == 0) {
                if ($i == $count - 1) {
                    $posts .= " $model->id";
                } else {
                    $posts .= " $model->id,";
                }
            }
        }

        return $this->render('posts', [
            'post' => $posts
        ]);
    }

    public function generateRandomValues()
    {
        $obj = array();

        $lang = Languages::find()->select(['id', 'title'])->orderBy(['RAND()' => SORT_ASC])->one();/*createCommand()->rawSql;*/
        $obj['lang'] = $lang->id;

        //Params
        $titleWords = rand(4, 6); //Слов в заголовке
        $textWords = rand(5, 8); //Слов в тексте
        $sentence = rand(3, 4); //Количество предложений

        $obj['title'] = $this->generateRandomText($lang->title, 'title', $titleWords);

        $obj['text'] = $this->generateRandomText($lang->title, 'text', $textWords, $sentence);


        $author = Authors::find()->select(['id', 'name'])->orderBy(['RAND()' => SORT_ASC])->one();
        $obj['author'] = $author->id;

        $obj['count'] = rand(1, 100);

        //Генерирует случайное число в формате Unix Timestamp затем преобразует к нужному формату
        $dateStart = new DateTime('01.01.2017 00:00:00');
        $dateEnd = new DateTime('09.09.2017 00:00:00');
        $randDate = rand($dateStart->getTimestamp(), $dateEnd->getTimestamp());
        $obj['randDate'] = date('Y-m-d', $randDate);

        return $obj;
    }

    public function generateRandomText($language, $type, $words, $sentence = null)
    {
        /*if (!$object) {
           echo "Object is empty";
           exit;
        }*/

        if ($language == 'Русский') {
            if ($type == 'title') {
                $title = self::$titles['Русский'];
                $str = '';

                $titleRand = array_rand($title, $words);
                $titleLen = count($titleRand);
                $i = 0;
                foreach ($titleRand as $item => $value) {
                    if ($i == 0) {
                        $str .= mb_convert_case($title[$value], MB_CASE_TITLE, 'UTF-8');
                        $str .= ' ';
                    } else {
                        $str .= " $title[$value] ";
                    }

                    $i++;
                }
                $obj['title'] = $str;
                return $obj['title'];

            } else if ($type == 'text') {
                $text = self::$texts['Русский'];
                $str = '';
                for ($j = 0; $j < $sentence; $j++) {

                    $text_rand = array_rand($text, $words);
                    $textLen = count($text_rand);
                    $i = 0; //Счетчик итераций
                    foreach ($text_rand as $item => $value) {
                        if ($i == 0) {
                            $str .= mb_convert_case($text[$value], MB_CASE_TITLE, 'UTF-8');
                            $str .= ' ';

                        } else if ($i == $textLen - 1) {
                            $str .= " $text[$value]. ";
                        } else {
                            $str .= " $text[$value] ";
                        }

                        $i++;
                    }

                }
                $obj['text'] = $str;
                return $obj['text'];
            }
        } else {
            if ($type == 'title') {
                $text = self::$texts['English']; //Текст с которым будем работать
                $title = self::$titles['English'];
                $str = '';

                $titleRand = array_rand($title, $words);
                $titleLen = count($titleRand);
                $i = 0;
                foreach ($titleRand as $item => $value) {
                    if ($i == 0) {
                        $str .= mb_convert_case($title[$value], MB_CASE_TITLE, 'UTF-8');
                        $str .= ' ';
                    } else {
                        $str .= " $title[$value] ";
                    }

                    $i++;
                }
                $obj['title'] = $str;
                return $obj['title'];

            } else if ($type = 'text') {
                $text = self::$texts['English'];
                $str = '';
                for ($j = 0; $j < $sentence; $j++) {

                    $text_rand = array_rand($text, $words);
                    $textLen = count($text_rand);
                    $i = 0; //Счетчик итераций
                    foreach ($text_rand as $item => $value) {
                        if ($i == 0) {
                            $str .= mb_convert_case($text[$value], MB_CASE_TITLE, 'UTF-8');
                            $str .= ' ';

                        } else if ($i == $textLen - 1) {
                            $str .= " $text[$value]. ";
                        } else {
                            $str .= " $text[$value] ";
                        }

                        $i++;
                    }
                }
                $obj['text'] = $str;
                return $obj['text'];
            }
        }
        return false;
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
