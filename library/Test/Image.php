<?php

require_once 'Test/Exception.php';

/**
 * Image
 */
abstract class Test_Image {
    
    /* --------------------------------------------------------------------------
     * Variables
     * ------------------------------------------------------------------------- */

    const TYPE_JPEG = 0;
    const TYPE_PNG = 1;

    protected $_type;
    protected $_file;
    protected $_image;

    /* --------------------------------------------------------------------------
     * Constructor
     * ------------------------------------------------------------------------- */

    public function __construct($file, $type) {

        if (!file_exists($file)) {
            throw new Test_Exception('El archivo de imagen no existe');
        }

        switch ($type) {
            case self::TYPE_JPEG:
                $this->_image = @imagecreatefromjpeg($file);
                break;

            case self::TYPE_PNG:
                $this->_image = @imagecreatefrompng($file);
                break;

            default:
                break;
        }

        if ($this->_image === false) {
            throw new Test_Exception('Ha habido un error a la hora de cargar la imagen');
        }

        $this->_file = $file;
        $this->_type = $type;
    }

    /* --------------------------------------------------------------------------
     * Factory
     * ------------------------------------------------------------------------- */

    public static function factory($file, $type = null) {

        switch ($type) {
            case self::TYPE_JPEG:
                require_once 'Test/Image/Jpeg.php';
                return new Test_Image_Jpeg($file, $type);

            case self::TYPE_PNG:
                require_once 'Test/Image/Png.php';
                return new Test_Image_Png($file, $type);

            default:
                throw new Test_Exception('Tipo desconocido');
        }
    }

    /* --------------------------------------------------------------------------
     * Transform
     * ------------------------------------------------------------------------- */

    public function flipHorizontal() {
        $tmp = imagecreatetruecolor($this->getWidth(), $this->getHeight());
        imagecopyresampled($tmp, $this->_image, 0, 0, ($this->getWidth() - 1), 0, $this->getWidth(), $this->getHeight(), 0 - $this->getWidth(), $this->getHeight());
        imagedestroy($this->_image);
        $this->_image = $tmp;
    }

    public function flipVertical() {
        $tmp = imagecreatetruecolor($this->getWidth(), $this->getHeight());
        imagecopyresampled($tmp, $this->_image, 0, 0, 0, ($this->getHeight() - 1), $this->getWidth(), $this->getHeight(), $this->getWidth(), 0 - $this->getHeight());
        imagedestroy($this->_image);
        $this->_image = $tmp;
    }

    public function negate() {
        imagefilter($this->_image, IMG_FILTER_NEGATE);
    }

    public function grayscale() {
        imagefilter($this->_image, IMG_FILTER_GRAYSCALE);
    }

    public function edgeDetect() {
        imagefilter($this->_image, IMG_FILTER_EDGEDETECT);
    }
    
    public function copyTo(Test_Image $image, $x, $y, $width, $height) {
        imagecopyresampled($this->_image, $image->getImageResource(), $x, $y, 0, 0, $width, $height, $image->getWidth(), $image->getHeight());
    }

    /* --------------------------------------------------------------------------
     * Getter / Setter
     * ------------------------------------------------------------------------- */

    public function getImageResource() {
        return $this->_image;
    }

    public function getWidth() {
        return imagesx($this->_image);
    }

    public function getHeight() {
        return imagesy($this->_image);
    }

    public function getSize() {
        return new Test_Geometry_Size($this->getWidth(), $this->getHeight());
    }

    /* --------------------------------------------------------------------------
     * Abstract
     * ------------------------------------------------------------------------- */

    abstract public function save($file, $quality, $params = null);

    abstract public function sendToOutput($quality);
}
