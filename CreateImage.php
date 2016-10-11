<?php

	$createImage = new CreateImage(4, 4);
	$createImage->setHeaderText ('Puzzle game');
	$createImage->setTextColor (0, 0, 0);
	$createImage->setLineColor (0, 0, 0);
	$createImage->setBackgroundColor (0, 0, 0);
	$createImage->setLineColor (0, 0, 0);

	$characters = array_merge (range ('A', 'Z'));
	$characters = Array(A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P);
	$colorArray = Array(0, 1, 2, 0, 1, 2, 0, 1, 2, 1, 1, 1, 2, 2, 2, 2);
	$createImage->generateImage ($characters, $colorArray);

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
		var $headerPadding = 100;

		/** Space required for right area **/
		var $widthPadding = 100;

		/** Start x offset for matrix table **/
		var $startXOffset = 50;

		/** Start y offset for matrix table **/
		var $startYOffset = 50;

		/** x offset for text from origin of rectangle drawn **/
		var $textXoffset = 15;

		/** y offset for text from origin of rectangle drawn **/
		var $textYoffset = 15;

		/** x offset for header text from origin of image **/
		var $headerXoffset = 70;

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
		var $letterFontType = 200;

		/** letter size for header **/
		var $headerFontType = 200;

		/** Color variables **/

		var $blueColor;

		var $orangeColor;

		var $whiteColor;

		var $blackColor;

		var $font;


		/** Constuctor class to create image. */
		function CreateImage($row, $coloumn){
			$this->numberOfRows = $row;
			$this->numberOfColoms = $coloumn;
			$this->my_img = imagecreate ($this->numberOfRows * $this->cellWidth + $this->widthPadding, $this->cellHeight * $this->numberOfColoms + $this->headerPadding);
			$this->headerTextColor = imagecolorallocate ($this->my_img, 255, 255, 0);
			$this->textColour = imagecolorallocate ($this->my_img, 255, 255, 0);
			$this->line_colour = imagecolorallocate ($this->my_img, 255, 255, 0);
			$this->background = imagecolorallocate ($this->my_img, 0, 0, 255);

			/** Set default colours */
			$this->blueColor = imagecolorallocate ($this->my_img, 32, 150, 214);
			$this->orangeColor = imagecolorallocate ($this->my_img, 255, 136, 17);
			$this->whiteColor = imagecolorallocate ($this->my_img, 255, 255, 255);
			$this->blackColor = imagecolorallocate ($this->my_img, 0, 0, 0);
			//$this->font = imageloadfont('./Roboto-Bold.ttf');
			imagefill ($this->my_img, 0, 0, $this->blackColor);

		}

		/** function to set header text and colour of text */
		public function setHeaderText($text){
			$this->headerText = $text;
			$this->headerTextColor = $this->whiteColor;
		}

		/** function to set colour of text */
		public function setTextColor($r, $g, $b){
			$this->textColour = imagecolorallocate ($this->my_img, $r, $g, $b);
		}

		/** function to set line colour  */
		public function setLineColor($r, $g, $b){
			$this->line_colour = imagecolorallocate ($this->my_img, $r, $g, $b);
		}

		/** function to set background colour  */
		public function setBackgroundColor($r, $g, $b){
			$this->background = imagecolorallocate ($this->my_img, $r, $g, $b);
		}

		/**
		 * function to generate image from given data
		 * @params character array to be shown as table
		 * @params $colorArray provide colour code for letters
		 */
		public function generateImage($characterArray, $colorArray){
			imagestring ($this->my_img, $this->headerFontType, $this->headerXoffset, $this->headerYoffset, $this->headerText, $this->headerTextColor);

			$index = 0;
			for ($x = 0; $x < $this->numberOfRows; $x++) {
				for ($y = 0; $y < $this->numberOfColoms; $y++) {
					$startX = ($x * $this->cellWidth) + ($this->startXOffset);
					$startY = $this->startYOffset + ($y * $this->cellHeight);
					$endX = $this->startXOffset + ($x + 1) * $this->cellWidth;
					$endY = $this->startYOffset + ($y + 1) * $this->cellHeight;

					$fontXoffset = ($x * $this->cellWidth) + $this->startXOffset + $this->textXoffset;
					$fontYoffset = $this->startYOffset + ($y * $this->cellHeight) + $this->textYoffset;

					if ($colorArray[$index] == 1) {
						/** draw rectangle from given offset */
						self::fillRectangle ($this->my_img, $startX, $startY, $endX, $endY, $this->blueColor);

						/** draw character array alphabets inside boxes with given offsets */
						self::drawText ($this->my_img, $this->letterFontType, $fontXoffset, $fontYoffset, $characterArray[$index], $this->whiteColor);

					} else if ($colorArray[$index] == 2) {
						self::fillRectangle ($this->my_img, $startX, $startY, $endX, $endY, $this->orangeColor);
						self::drawText ($this->my_img, $this->letterFontType, $fontXoffset, $fontYoffset, $characterArray[$index], $this->whiteColor);

					} else {
						self::fillRectangle ($this->my_img, $startX, $startY, $endX, $endY, $this->whiteColor);
						self::drawText ($this->my_img, $this->letterFontType, $fontXoffset, $fontYoffset, $characterArray[$index], $this->blackColor);

					}

					$index++;


				}
			}
			/** De allocate memmory used */
			imagesetthickness ($this->my_img, 5);
			imagepng ($this->my_img, self::IMAGE_NAME);
			imagecolordeallocate ($this->my_img, $this->headerTextColor);
			imagecolordeallocate ($this->my_img, $this->textColour);
			imagecolordeallocate ($this->my_img, $this->line_colour);
			imagecolordeallocate ($this->my_img, $this->background);
			imagecolordeallocate ($this->my_img, $this->blueColor);
			imagecolordeallocate ($this->my_img, $this->orangeColor);
			imagecolordeallocate ($this->my_img, $this->whiteColor);
			imagecolordeallocate ($this->my_img, $this->blackColor);
			imagedestroy ($this->my_img);

		}

		/** function to fill rectangle */
		public function fillRectangle($image, $startX, $startY, $endX, $endY, $color){
			/** draw rectangle from given offset */
			imagefilledrectangle ($image, $startX, $startY, $endX, $endY, $color);

		}

		/** function to draw text and colour of text */
		public function drawText($image, $fontSize, $startX, $startY, $text, $color){
			/** draw character array alphabets inside boxes with given offsets */
			imagestring ($image, $fontSize, $startX, $startY, $text, $color);

		}
	}


?>