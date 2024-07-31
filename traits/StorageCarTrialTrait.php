<?php

namespace app\modules\experience\traits;

use krok\storage\dto\StorageDto;
use League\Flysystem\FilesystemInterface;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

trait StorageCarTrialTrait
{

    /**
     * @var StorageDto
     */
    protected $docGallery;

    /**
     * @var UploadedFile|StorageDto
     */
    private $src1;

    /**
     * @var UploadedFile|StorageDto
     */
    private $src2;

    public $routeRemoveFile = '/experience/car-trial/remove-file';

    /**
     * @param string|null $preset
     * @return string
     */
    public function getPreviewSrc1Url(?string $preset = null): string
    {
        return $this->getPreviewSrcUrlBase("src1", $preset);
    }

    /**
     * @param string|null $preset
     * @return string
     */
    public function getPreviewSrc2Url(?string $preset = null): string
    {
        return $this->getPreviewSrcUrlBase("src2", $preset);
    }

    /**
     * @param $attribute
     * @param string|null $preset
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getPreviewSrcUrlBase($attribute, ?string $preset = null): string
    {
        $config = $preset ? ['p' => $preset] : [];
        if ($this->{$attribute} instanceof StorageDto) {
            $filesystem = Yii::createObject(FilesystemInterface::class);

            return $filesystem->getPublicUrl($this->{$attribute}->getSrc(), $config);
        }

        return '';
    }


    /**
     * @return string
     */
    public function getRouteRemoveFile(): string
    {
        return $this->routeRemoveFile;
    }

    /**
     * @param string $attribute
     * @param StorageDto $file
     * @return array
     */
    private function getFilePreviewConfigItem(string $attribute, StorageDto $file) {
        $filesystem = \Yii::createObject(FilesystemInterface::class);

        return [
            'type'        => 'image',
            'filetype'    => $file->getMime(),
            'caption'     => $file->getTitle(),
            'size'        => $file->getSize(),
            'downloadUrl' => $filesystem->getDownloadUrl($file->getSrc()),
            'key'         => $file->getSrc(),
            'url'         => Url::to([
                $this->getRouteRemoveFile(),
                'id'        => $this->id,
                'attribute' => $attribute,
            ]),
        ];
    }

    /**
     * @param string $attribute
     *
     * @return array
     */
    public function getFilePreviewConfig(string $attribute): array
    {
        $result = [];
        if ($this->{$attribute} !== null) {
            $files = is_array($this->{$attribute}) ?
                $this->{$attribute} :
                (($this->{$attribute} instanceof StorageDto) ? [$this->{$attribute}] : []);

            foreach ($files as $key => $file) {
                if ($file instanceof StorageDto) {
                    $result[] = $this->getFilePreviewConfigItem($attribute, $file);
                }
            }
        }
        return $result;
    }

    /**
     * @param string $attribute
     * @param $config
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function getFilePreview(string $attribute, $config = []): array
    {
        $result = [];
        $filesystem = Yii::createObject(FilesystemInterface::class);

        if ($this->{$attribute} !== null) {
            $files = is_array($this->{$attribute}) ?
                $this->{$attribute} :
                (($this->{$attribute} instanceof StorageDto) ? [$this->{$attribute}] : []);

            foreach ($files as $key => $file) {
                if ($file instanceof StorageDto) {
                    $result[] = $filesystem->getPublicUrl($file->getSrc(), $config);
                }
            }
        }

        return $result;
    }

    /**
     * @param string $attribute
     * @param $config
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function getFileDownload(string $attribute, $config = []): array
    {
        $result = [];
        $filesystem = Yii::createObject(FilesystemInterface::class);

        if ($this->{$attribute} !== null) {
            $files = is_array($this->{$attribute}) ?
                $this->{$attribute} :
                (($this->{$attribute} instanceof StorageDto) ? [$this->{$attribute}] : []);

            foreach ($files as $key => $file) {
                if ($file instanceof StorageDto) {
                    $result[] = $filesystem->getDownloadUrl($file->getSrc(), $config);
                }
            }
        }

        return $result;
    }

    /**
     * @param string $attribute
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function getFilesData(string $attribute): array
    {
        $files = $this->{$attribute} ?? [];
        $result = [];
        $filesystem = Yii::createObject(FilesystemInterface::class);
        foreach ($files as $key => $file) {
            if ($file instanceof StorageDto) {
                $result[] = [
                    'src' => $filesystem->getDownloadUrl($file->getSrc()),
                    'title' => $file->getTitle(),
                ];
            }
        }
        return $result;
    }

    /**
     * @param $attribute
     * @param string $preset
     * @return null|string
     * @throws \yii\base\InvalidConfigException
     */
    public function getPreview($attribute, $preset = ''): ?string
    {
        $config = !empty($preset) ? ['p' => $preset] : [];
        $preview = $this->getFilePreview($attribute, $config);

        if(!empty($preview)) {
            return current($preview);
        }

        return '';
    }

    /**
     * @param array $attributes
     * @param string $preset
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function getImages(array $attributes = [], $preset = ''): ?array
    {
        $config = !empty($preset) ? ['p' => $preset] : [];
        $list = [];

        foreach($attributes as $attribute) {
            $list = ArrayHelper::merge($list, $this->getFilePreview($attribute, $config));
        }

        return $list;
    }

    /**
     * @param $attribute
     * @param string $preset
     * @return null|string
     * @throws \yii\base\InvalidConfigException
     */
    public function getFilePath($attribute, $preset = ''): ?string
    {
        $config = !empty($preset) ? ['p' => $preset] : [];
        $preview = $this->getFileDownload($attribute, $config);

        if(!empty($preview)) {
            return current($preview);
        }

        return '';
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return static::class;
    }

    /**
     * @return int
     */
    public function getRecordId(): int
    {
        return $this->id ?? 0;
    }

    /**
     * @return null|string
     */
    public function getHint(): ?string
    {
        return null;
    }


    /**
     * @return string
     */
    public function getDocGallery()
    {
        return $this->docGallery;
    }

    /**
     * @param $value
     */
    public function setDocGallery($value)
    {
        $this->docGallery = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setSrc1($value)
    {
        $this->src1 = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setSrc2($value)
    {
        $this->src2 = $value;
    }

    /**
     * @return StorageDto
     */
    public function getSrc1()
    {
        return $this->src1;
    }

    /**
     * @return StorageDto
     */
    public function getSrc2()
    {
        return $this->src2;
    }

}
