<?php

	$createImage = new CreateImage(10, 10);
	$createImage->setHeaderText('Puzzle game', 0, 0, 0);
	$createImage->setTextColor(0, 0, 0);
	$createImage->setLineColor(0, 0, 0);
	$createImage->setLineColor(0, 0, 0);

	$characters = array_merge(range('A', 'Z'));
	$createImage->generateImage($characters);

	/** Helper class to create image */
	class CreateImage
	{
		/** Image name to save */
		const IMAGE_NAME = "gameWindow.png";

		/** Width for the matrix cell in pixels */
		var $cellWidth = 50;

		/** Height for the matrix cell in pixels **/
		var $cellHeight = 50;

		/** Number of rows for the table **/
		var $numberOfRows = 4;

		/** Number of coloumn for the table **/
		var $numberOfColoumn = 4;

		/** Space required in header area **/
		var $headerPadding = 150;

		/** Space required for right area **/
		var $widthPadding = 150;

		/** Start x offset for matrix table **/
		var $startXOffset = 50;

		/** Start y offset for matrix table **/
		var $startYOffset = 50;

		/** x offset for text from origin of rectangle drawn **/
		var $textXoffset = 10;

		/** y offset for text from origin of rectangle drawn **/
		var $textYoffset = 10;

		/** x offset for header text from origin of image **/
		var $headerXoffset = 250;

		/** x offset for header text from origin of image **/
		var $headerYoffset = 25;

		/** Image that is generated **/
		var $my_img;

		/** Colour for header text **/
		var $headerTextColor;

		/** Colour for text **/
		var $textColour;

		/** Line Colour for rectangle boxes **/
		var $line_colour;

		/** background Colour **/
		var $background;

		/** letter size for text **/
		var $letterSize = 10;

		/** letter size for header **/
		var $HeaderSize = 10;

		/** Constuctor class to create image. */
		function CreateImage($row, $coloumn)
		{
			$this->numberOfRows = $row;
			$this->numberOfColoms = $coloumn;
			$this->my_img = imagecreate($this->numberOfRows * $this->cellWidth + $this->widthPadding, $this->cellHeight * $this->numberOfColoms + $this->headerPadding);
			$this->headerTextColor = imagecolorallocate($this->my_img, 255, 255, 0);
			$this->textColour = imagecolorallocate($this->my_img, 255, 255, 0);
			$this->line_colour = imagecolorallocate($this->my_img, 255, 255, 0);
			$this->background = imagecolorallocate($this->my_img, 0, 0, 255);
		}

		/** function to set header text and colour of text */
		public function setHeaderText($text, $r, $g, $b)
		{
			$this->headerText = $text;
			$this->headerTextColor = imagecolorallocate($this->my_img, $r, $g, $b);
		}

		/** function to set colour of text */
		public function setTextColor($r, $g, $b)
		{
			$this->textColour = imagecolorallocate($this->my_img, $r, $g, $b);
		}

		/** function to set line colour  */
		public function setLineColor($r, $g, $b)
		{
			$this->line_colour = imagecolorallocate($this->my_img, $r, $g, $b);
		}

		/** function to set background colour  */
		public function setBackgroundColor($r, $g, $b)
		{
			$this->background = imagecolorallocate($this->my_img, $r, $g, $b);
		}

		/** 
		 * function to generate image from given data
		 *  @params character array to be shown as table
		 */
		public function generateImage($characterArray)
		{
			imagestring($this->my_img, $this->HeaderSize,  $this->headerXoffset,  $this->headerYoffset, $this->headerText, $this->headerTextColor);

			$max = count($characterArray) - 1;

			for ($x = 0; $x < $this->numberOfRows; $x++) {
				for ($y = 0; $y < $this->numberOfColoms; $y++) {
					
					$rand = mt_rand(0, $max);
					/** draw rectangle from given offset */
					imagerectangle($this->my_img, ($x * $this->cellWidth) + $this->startXOffset, $this->startYOffset + ($y * $this->cellHeight), +$this->startXOffset + ($x + 1) * $this->cellWidth, $this->startYOffset + ($y + 1) * $this->cellHeight, $this->line_colour);
					
					/** draw character array alphabets inside boxes with given offsets */
					imagestring($this->my_img, $this->letterSize, ($x * $this->cellWidth) + $this->startXOffset + $this->textXoffset, $this->startYOffset + ($y * $this->cellHeight) + $this->textYoffset, $characterArray[$rand], $this->textColour);


				}
			}
			/** De allocate memmory used */
			imagesetthickness($this->my_img, 5);
			imagepng($this->my_img, self::IMAGE_NAME);
			imagecolordeallocate($this->my_img, $this->headerTextColor);
			imagecolordeallocate($this->my_img, $this->textColour);
			imagecolordeallocate($this->my_img, $this->line_colour);
			imagecolordeallocate($this->my_img, $this->background);
			imagedestroy($this->my_img);

		}
	}


?>