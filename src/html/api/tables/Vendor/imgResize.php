<?php

class imgResize
{
    public function __construct($filename)
    {
        $this->filename = $filename;
        if (empty($this->filename)) {
            throw new Exception('Файл не найден');
        } else {
            $info = getimagesizefromstring($this->filename);
            if (empty($info)) {
                throw new Exception('Файл не найден');
            } else {
                $this->width  = $info[0];
                $this->height = $info[1];
                $this->type   = $info[2];
                switch ($this->type) {
                    case 1:
                        $this->img = imageCreateFromGif($this->filename);
                        break;
                    case 2:
                        $this->img = imageCreateFromJpeg($this->filename);
                        break;
                    case 3:
                        $this->img = imageCreateFromPng($this->filename);
                        imageAlphaBlending($this->img, true);
                        imageSaveAlpha($this->img, true);
                        break;
                    case 18:
                        $this->img = imageCreatefromWebp($this->filename);
                        break;
                    default:
                        throw new Exception('Формат файла не подерживается');
                        break;
                }
            }
        }
    }

    /**
     * Изминение размера изображения.
     */
    public function resize($width, $height)
    {
        if (empty($width)) {
            $width = ceil($height / ($this->height / $this->width));
        }
        if (empty($height)) {
            $height = ceil($width / ($this->width / $this->height));
        }

        $tmp = imageCreateTrueColor($width, $height);
        if ($this->type == 1 || $this->type == 3) {
            imagealphablending($tmp, true);
            imageSaveAlpha($tmp, true);
            $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
            imagefill($tmp, 0, 0, $transparent);
            imagecolortransparent($tmp, $transparent);
        }

        if ($width < $this->width || $height < $this->height) {
            $tw = ceil($height / ($this->height / $this->width));
            if ($tw < $width) {
                imageCopyResampled($tmp, $this->img, ceil(($width - $tw) / 2), ceil(($height - $height) / 2), 0, 0, $tw, $height, $this->width, $this->height);
            } else {
                $th = ceil($width / ($this->width / $this->height));
                imageCopyResampled($tmp, $this->img, ceil(($width - $width) / 2), ceil(($height - $th) / 2), 0, 0, $width, $th, $this->width, $this->height);
            }
        } else {
            imageCopyResampled($tmp, $this->img, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
        }

        $this->img = $tmp;
        unset($tmp);

        $this->width = $width;
        $this->height = $height;
    }

    public function getImg(){
        return $this->filename;
    }

    public function destroy()
    {
        imagedestroy($this->img);
    }
}