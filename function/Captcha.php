<?php

?>
<?php

session_start();

class Captcha
	{
	  function __construct()
	  {
	    $this->captcha = $this->GenCAP();
	    $_SESSION['captcha'] = md5($this->captcha);
		
	  }
	
	  function GenCAP()
	  {
	    for($i = 0; $i <= 9; $i++)
	      $int[] = $i;
	      
	    $st = '0';
	    for($s = 0; $s < 9; $s++)
	    {
	      $str[] = $st;
	      $st++;
	    }
	    
	    $cap = '';
	    for($j = 0; strlen($cap) < 4; $j++)
	    {
	      if(rand(1, 2) == 1)
	        $cap .= $int[rand(0, (count($int) -1))];
	      else
	        $cap .= $str[rand(0, (count($str) -1))];
	    }
	    
	    return $cap;
	  }
	
	  function Init($width, $height)
	  {
	    $this->image    = imagecreate($width, $height) or die("Cannot Initialize new GD image stream");
	    imagecolorallocate($this->image, "0", "0", "0");
	    $this->text_color = imagecolorallocate($this->image, "255", "255", "255");
	  }
	
  function Save($fontSize, $x, $y, $fileName='image')
  {
	$font_file = 'segoesc.ttf';
	header("Content-type: image/png");
	imagestring($this->image, $fontSize, $x, $y,  $this->captcha, $this->text_color);
	imagepng($this->image);
  }
}
	
$Cap = new Captcha;
$Cap->Init(48, 15);
$Cap->Save(15, 0, 0, 'Captcha');
	
?>