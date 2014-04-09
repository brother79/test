<?php

class SiteController extends CController
{
    public $layout = 'column1';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $model = new Url;
        if (isset($_POST['Url'])) {
            $url = $model->findByAttributes(array('source' => $_POST['Url']['source']));
            if ($url) {
                $this->redirect(array('index', 'short' => $url->short));
            }
            $model->attributes = $_POST['Url'];
            if ($model->save()) {
                $this->redirect(array('index', 'short' => $model->short));
            }
        }

        $url = $this->loadModel();

        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('index', array(
                'model' => $url,
                'modelNew' => $model,
            ));

        } else {
            $this->render('index', array(
                'model' => $url,
                'modelNew' => $model,
            ));
        }
    }

    /**
     * Redirect to source url
     * @throws CHttpException
     */
    public function actionShort()
    {
        $url = $this->loadModel();
        if ($url === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $this->redirect($url->source);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel()
    {
        if ($this->_model === null) {
            if (isset($_GET['short'])) {
                $this->_model = Url::model()->findByAttributes(array('short' => $_GET['short']));
                if ($this->_model === null) {
                    throw new CHttpException(404, 'The requested page does not exist.');
                }
            }
        }
        return $this->_model;
    }

}
