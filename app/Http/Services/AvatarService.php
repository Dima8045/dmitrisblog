<?php


namespace App\Http\Services;

use App\Helpers\StorageHelper;
use PHPImageWorkshop\ImageWorkshop;

/**
 * Class AvatarService
 * @package App\Http\Services
 */
class AvatarService
{
    /**
     * @var $backgroundLayer;
     * @var $backgroundColor;
     * @var $backgroundWidth;
     * @var $backgroundHeight;
     *
     * @var $fontColor;
     * @var $fontSize;
     * @var $fontPath;
     * @var $fontRotate;
     * @var $text;
     * @var $textLayer;

     * @var $imageQuality;
     * @var $image;
     */
    protected $backgroundLayer;
    protected $backgroundColor = '#ffffff';
    protected $backgroundWidth = 800;
    protected $backgroundHeight = 800;

    protected $fontColor = '5e72e4';
    protected $fontSize = 500;
    protected $fontPath;
    protected $fontRotate = 0;
    protected $text;
    protected $textLayer;

    protected $imageQuality;
    protected $image;


    /**
     * AvatarService constructor.
     * @param $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
        $this->fontPath = storage_path('fonts/SFUIDisplay-Bold.ttf');
    }

    /**
     * Generate image resourse
     */
    protected function imageGenerate()
    {
        $this->backgroundLayer = ImageWorkshop::initVirginLayer(
            $this->backgroundWidth,
            $this->backgroundHeight,
            $this->backgroundColor
        );


        $this->textLayer = ImageWorkshop::initTextLayer(
            $this->text,
            $this->fontPath,
            $this->fontSize,
            $this->fontColor,
            $this->fontRotate,
            $this->backgroundColor
        );

        $this->backgroundLayer->addLayerOnTop($this->textLayer, 0, 0, 'MM');
    }

    /**
     * Create avatar
     * @return string
     */
    public function creteImage() :string
    {
        $this->imageGenerate();
        $path = 'storage/avatar/';
        $name = StorageHelper::randomName(). '.png';
        $this->image = $this->backgroundLayer->getResult();
        imagepng($this->image, $path . $name, $this->imageQuality);
        return $name;
    }
}