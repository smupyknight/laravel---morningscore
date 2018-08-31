<?php

namespace MorningTrain\Foundation\Api\Fields;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use MorningTrain\Foundation\Api\Field;
use Ramsey\Uuid\Uuid;

class FileField extends Field
{

    /*
     -------------------------------
     Vars
     -------------------------------
     */

    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @var string
     */
    protected $accepts = '*';

    /**
     * @var string
     */
    protected $storagePath = 'app';

    /*
     -------------------------------
     Constructor
     -------------------------------
     */

    public function __construct(string $name = null)
    {
        parent::__construct($name);

        /////////////////////////////////
        // Updater
        /////////////////////////////////

        $this->updates(function (Model $model, string $attribute, $value) {
            // Delete existing file
            if ($model->$attribute &&
                ($path = $this->absolutePath($model->$attribute)) &&
                file_exists($path)
            ) {
                unlink($path);
            }

            $model->$attribute = $value;
        });

    }

    /*
     -------------------------------
     Configuration
     -------------------------------
     */

    public function required(bool $status = true)
    {
        $this->required = $status;
        return $this;
    }

    public function accepts(...$extensions)
    {
        $jumper = $extensions[0] ?: '*';

        if ($jumper === '*') {
            $this->accepts = '*';
            return $this;
        }

        $this->accepts = ($this->accepts === '*' ? '' : ',') . implode(',', $extensions);
        return $this;
    }

    public function storesIn(string $storagePath)
    {
        $this->storagePath = $storagePath;
        return $this;
    }

    /*
     -------------------------------
     Helpers
     -------------------------------
     */

    protected function generateFileName(string $name, string $extension)
    {
        return Uuid::uuid4() . '.' . $extension;
    }

    public function storagePath(string $fileName = null)
    {
        return is_null($fileName) ?
            $this->storagePath :
            "{$this->storagePath}/{$fileName}";
    }

    protected function absolutePath(string $storagePath = null)
    {
        return is_null($storagePath) ?
            storage_path('app') :
            storage_path("app/$storagePath");
    }

    protected function manipulateFile(string $path)
    {
        // ...
    }

    protected function performUpload(UploadedFile $file)
    {
        $fileName = $this->generateFileName(
            $file->getClientOriginalName(),
            $file->getClientOriginalExtension()
        );

        $file->move($this->absolutePath($this->storagePath), $fileName);

        $storagePath = $this->storagePath($fileName);
        $this->manipulateFile($this->absolutePath($storagePath));

        return $storagePath;
    }

    /*
     -------------------------------
     Overrides
     -------------------------------
     */

    protected function processRules(Model $model, $rules)
    {
        $fileRules = [$this->required ? 'required' : 'sometimes', 'file'];

        if ($this->accepts !== '*') {
            $fileRules[] = "mimes:{$this->accepts}";
        }

        $requestName = $this->getRequestName();

        if (isset($rules[$requestName])) {
            $fileRules[] = $rules[$requestName];
        }


        return parent::processRules($model, implode('|', $fileRules));
    }

    protected function processValue(Model $model, $value)
    {
        return parent::processValue(
            $model,
            $value instanceof UploadedFile ? $this->performUpload($value) : null
        );
    }

    protected function checkRequest(Request $request)
    {
        return $request->hasFile($this->getRequestName());
    }

    protected function getRequestValue(Request $request)
    {
        return $request->file($this->getRequestName());
    }

}