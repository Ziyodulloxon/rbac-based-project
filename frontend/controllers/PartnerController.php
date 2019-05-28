<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\{db\Exception, filters\VerbFilter};
use yii\web\{BadRequestHttpException, Controller, ForbiddenHttpException, NotFoundHttpException};
use common\models\{PartnerUser, User, Partner, search\PartnerSearch};

/**
 * PartnerController implements the CRUD actions for Partner model.
 */
class PartnerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @inheritDoc
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     * */
    public function beforeAction($action)
    {
        $user = Yii::$app->user;
        $auth = Yii::$app->authManager;
        $permissionName = $action->id . "Partner";
        $partnerId = Yii::$app->request->get('id');

        if (
            $auth->getPermission($permissionName) &&
            !$user->can($permissionName, ['id' => $partnerId])
        ) {
            throw new ForbiddenHttpException();
        }

        return parent::beforeAction($action);
    }

    /**
     * Lists all Partner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Partner model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => new ActiveDataProvider([
                'query' => $model->getPerson()
            ])
        ]);
    }

    /**
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new Partner();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            if ($model->save() && $model->user->activate(User::ROLE_PARTNER)) {
                $transaction->commit();

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $transaction->rollBack();
            }
        }

        return $this->render('create', [
            'model' => $model,
            'vacantUsers' => User::vacantUsers()
        ]);
    }

    /**
     * Updates an existing Partner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Exception
     * @throws \Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldUser = $model->user;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            if ($model->save() && $model->user->activate(User::ROLE_PARTNER) && $oldUser->inactivate()) {
                $transaction->commit();

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $transaction->rollBack();
            }
        }

        return $this->render('update', [
            'model' => $model,
            'vacantUsers' => User::vacantUsers()
        ]);
    }

    /**
     * @throws \Exception
     * */
    public function actionAddPerson($id)
    {
        $request = Yii::$app->request;
        $post = $request->post();
        $partnerId = $request->isPost
            ? $post['PartnerUser']['partner_id']
            : $id;

        if (!Yii::$app->user->can('createPerson')) {
            throw new ForbiddenHttpException();
        }

        $model = new PartnerUser();
        $model->partner_id = $id;

        if ($model->load($post) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            if ($model->save() && $model->user->activate(User::ROLE_PERSON)) {
                $transaction->commit();

                return $this->redirect(['view', 'id' => $model->partner_id]);
            } else {
                $transaction->rollBack();
            }
        }

        return $this->render('add-person', [
            'model' => $model,
            'vacantUsers' => User::vacantUsers()
        ]);
    }

    public function actionDeletePerson($id)
    {
        $person = PartnerUser::findOne($id);
        if (!Yii::$app->user->can('crudPerson', ['person' => $person])) {
            throw new ForbiddenHttpException();
        }

        if ($person) {
            $person->delete();

            return $this->redirect(['view', 'id' => $person->partner_id]);
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTest()
    {
        if (!Yii::$app->user->can('test')) {
            throw new ForbiddenHttpException('access denied');
        }

        echo "test";die();
    }

    /**
     * Deletes an existing Partner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
