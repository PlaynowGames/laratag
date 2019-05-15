<?php
namespace PlaynowGames\LaraTag\Tags;

class P
{
    private $content;
    private $size;
    private $bold;
	private $margin;
	private $align;

    function __construct($content)
    {
        $this->content = $content;
        $this->bold = false;
		
    }

    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    public function b()
    {
        $this->bold = true;
        return $this;
    }

    public function br()
    {
        $this->content .= "<br>";
        return $this;
    }
	
	public function setAlign($align)
    {
        $this->align = $align;
        return $this;
    }
	
	public function setMargin($margin)
    {
        if( is_array($margin) ){
            $margin = implode("mm ",$margin).'mm';
        }else{
            $margin = $margin."mm";
        }
		
		//print_r($margin);
        $this->margin = $margin;
        return $this;
    }

    public function render()
    {
        $tag = "div";
        if( $this->size !== null ){
            $style[] = "font-size: {$this->size}mm";
        }
        if( $this->bold === true ){
            $style[] = "font-weight: bold";
        }
		
		if( $this->margin !== null ){
            $style[] = "margin: {$this->margin}";
			
        }
		
		if( $this->align !== null ){
            $style[] = "text-align: {$this->align}";
        }


        if( !empty($style) ){
            $content = "<{$tag} style='".implode(";",$style)."; '>{$this->content}</{$tag}>";
        }else{
            $content = "<{$tag}>{$this->content}</{$tag}>";
        }

        return $content;
    }
}