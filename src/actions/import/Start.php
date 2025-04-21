<?php

namespace app\src\actions\import;

use app\models\forms\ImportForm;
use app\src\base\exceptions\UserException;
use app\src\components\importer\enums\BuilderType;
use app\src\components\kafka\objects\jobs\ImportJob;
use Yii;
use yii\base\Action;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class Start extends Action
{
    /**
     * @return string
     * @throws UserException
     * @throws ServerErrorHttpException
     */
    public function run(): string
    {
        $form = new ImportForm();

        if (Yii::$app->request->isPost) {
            $form->load(Yii::$app->request->post());
            $form->file = UploadedFile::getInstance($form, 'file');

            if (!$form->validate()) {
                throw new UserException($form->getErrorSummary(true));
            }

            $file = Yii::$app->storage->save($form->file);

            if ($file === null) {
                throw new ServerErrorHttpException('The attempt to save uploaded file failed.');
            }

            $job = new ImportJob([
                'builderType' => BuilderType::CITY,
                'fileBaseName' => $file->getBaseName(),
            ]);

            Yii::$app->kafka->getQueue('importer')->push($job);
            Yii::$app->session->setFlash('success', 'Import started.');
        }

        return $this->controller->render('start', [
            'form' => $form,
        ]);
    }
}
