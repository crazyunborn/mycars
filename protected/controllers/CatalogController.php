<?php

class CatalogController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','getNeededModels','getNeededOptions','getNeededCar'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id,$url1,$url2,$url3)
	{
		$this->createUrl('catalog/view',array('id'=>$id,'url1'=>$url1,'url2'=>$url2,'url3'=>$url3));
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Catalog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Catalog']))
		{
			$model->attributes=$_POST['Catalog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Catalog']))
		{
			$model->attributes=$_POST['Catalog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	* Возврат моделей по марке
	*/
	public function actionGetNeededModels($brand){
        if (empty($brand)){
        	Yii::app()->end();
        }
        $dataProvider = Catalog::selectShowenModels($brand);
        if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('_searchcarsmodel',array('dataProvider'=>$dataProvider),false,true);
            // Завершаем приложение
            Yii::app()->end();
        }
	}

	/**
	* Возврат комплектаций в модели
	*/
	public function actionGetNeededOptions($model){
        if (empty($model)){
        	Yii::app()->end();
        }
        $dataProvider = Catalog::selectShowenOptions($model);
        if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('_searchcarsoption',array('dataProvider'=>$dataProvider),false,true);
            // Завершаем приложение
            Yii::app()->end();
        }
	}

	/**
	* Возврат комплектаций в модели
	*/
	public function actionGetNeededCar($id){
        if (empty($id)){
        	Yii::app()->end();
        }
        $dataProvider = Catalog::model()->findByAttributes(array('id'=>$id));
        $dataProvider['brand'] = mb_strtolower(str_replace(" ","",$dataProvider['brand']));
        $dataProvider['model'] = mb_strtolower(str_replace(" ","",$dataProvider['model']));
        $dataProvider['options'] = mb_strtolower(str_replace(" ","",$dataProvider['options']));
        if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('_searchcar',array('dataProvider'=>$dataProvider),false,true);
            // Завершаем приложение
            Yii::app()->end();
        }
	}
	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Catalog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Catalog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Catalog']))
			$model->attributes=$_GET['Catalog'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Catalog the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Catalog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Catalog $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='catalog-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
