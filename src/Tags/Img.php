<?php
namespace PlaynowGames\LaraTag\Tags;

class Img
{
    private $content;
    private $type;
    private $margin;
    private $align;
    private $width;
    private $height;
    private $rotate;
	private $br;

    function __construct($content)
    {
        $size = getimagesize($content);
        $this->type = $size['mime'];

        $imagem = file_get_contents($content);
        $this->content = base64_encode($imagem);
        $this->align = 'left';
    }

    public function setMargin($margin)
    {
        if( is_array($margin) ){
            $margin = implode("mm ",$margin).'mm';
        }else{
            $margin = $margin."mm";
        }
        $this->margin = $margin;
        return $this;
    }

    public function setAlign($align)
    {
        $this->align = $align;
        return $this;
    }

    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    public function rotate($rotate)
    {
        $this->rotate = $rotate;
    }

	public function br()
    {
        $this->br = "<br>";
        return $this;
    }

    public function render()
    {
        if( $this->width !== null ){
            $styles[] = "width: {$this->width}mm";
        }

        if( $this->height !== null ){
            $styles[] = "max-height: {$this->height}mm";
        }

    		if( $this->br == null ){
    			if( $this->align == 'left' ){
    				$styles[] = "float: left";
    			}else{
    				$styles[] = "float: right";
    			}
    		}
		
		$styles[] = "width: 100%; height:auto";
		
        if( $this->margin !== null ){
            $styles[] = "margin: {$this->margin}";
        }

        if( !empty($styles) ){
            $style = "style='".implode(";",$styles)."'";
        }else{
            $style = "";
        }

        if( $this->rotate !== null ){
            $rotate = " rotate='{$this->rotate}'";
        }else{
            $rotate = "";
        }

		if( $this->br !== null ){
            $br = $this->br;
        }else{
            $br = "";
        }

        return "<img {$style} src='data:{$this->type};base64," . $this->content . "'$rotate>" . $br;
    }
}
