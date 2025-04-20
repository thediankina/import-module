<?php

namespace app\src\components\importer;

use app\src\base\exceptions\UserException;
use app\src\components\importer\builders\Builder;
use app\src\components\importer\interfaces\FileInterface;
use app\src\helpers\LogHelper;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use yii\base\Exception;

class Component extends \yii\base\Component
{
    public $readerType;

    public function import(FileInterface $file, Builder $builder): bool
    {
        $reader = $this->readerType ?
            IOFactory::createReader($this->readerType) :
            IOFactory::createReaderForFile($file->getPath());

        return $this->process($reader, $file, $builder);
    }

    public function process(IReader $reader, FileInterface $file, Builder $builder): bool
    {
        try {
            $spreadsheet = $reader->load($file->getPath());
            $sheet = $spreadsheet->getActiveSheet();

            $headers = [];
            $headersRowIndex = $sheet->getHighestRow();
            foreach ($sheet->getRowIterator($headersRowIndex, $headersRowIndex) as $row) {
                foreach ($row->getCellIterator() as $cell) {
                    $column = $cell->getColumn();
                    $headers[$column] = $cell->getValue();
                }
            }

            $dataRowIndex = $headersRowIndex + 1;
            foreach ($sheet->getRowIterator($dataRowIndex) as $row) {
                $form = $builder->getForm();
                foreach ($row->getCellIterator() as $cell) {
                    $column = $cell->getColumn();
                    $header = $headers[$column];

                    if ($form->canSetProperty($header)) {
                        $form->{$header} = $cell->getCalculatedValue();
                    }
                }

                $model = $builder->build($form);

                if (!$model->save()) {
                    throw new UserException($model->getErrorSummary(true));
                }
            }
        } catch (Exception $e) {
            LogHelper::exception($e);

            return false;
        }

        return true;
    }
}
