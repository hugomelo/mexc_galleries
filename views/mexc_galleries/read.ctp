<?php

/**
 *
 * Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/museudecienciasunicamp/mexc_galleries.git Mexc Galleries public repository
 */

$breakpoints = array(
	'xlarge' => 700,
	'large' => 300,
	'medium' => 200,
	'small' => 140,
	'xsmall' => null
); 

/******* Gamma gallery files ***************/
echo $this->Html->css('/mexc_galleries/GammaGallery/css/style.css');
// modernizr
echo $this->Html->script('/mexc_galleries/GammaGallery/js/modernizr.custom.70736.js');

echo $this->Bl->snoscriptDry();
	echo $this->Html->css('/mexc_galleries/GammaGallery/css/noJS.css');
echo $this->Bl->enoscript();

echo $this->Html->script('/mexc_galleries/GammaGallery/js/jquery.masonry.min.js');
echo $this->Html->script('/mexc_galleries/GammaGallery/js/jquery.history.js');
echo $this->Html->script('/mexc_galleries/GammaGallery/js/js-url.min.js');
echo $this->Html->script('/mexc_galleries/GammaGallery/js/jquerypp.custom.js');
echo $this->Html->script('/mexc_galleries/GammaGallery/js/gamma.js');


echo $this->Html->script('/mexc_galleries/js/gallery');

echo $this->element('header-read', array('title' => $gallery['MexcGallery']['title'], 'slug'=>'gallery'));

echo $this->Bl->floatBreak();
echo $this->Bl->srow(array('class' => 'pages news'));
	echo $this->Bl->hr(array('class' => 'col-xs-12'));
	
	echo $this->Bl->sdiv(array('class' => 'col-xs-12 gamma-container gamma-loading', 'id' => 'gamma-container'), array());
		echo $this->Bl->sul(array('class' => 'gamma-gallery'), array());
			foreach($gallery['MexcImage'] as $image) {
				echo $this->Bl->sliDry();
					echo $this->Bl->sdiv(array('data-alt' => $image['title'], 'data-description' =>$this->Bl->h3Dry($image['subtitle']), 'data-max-width' => 1800), array());
						foreach($breakpoints as $breakpoint => $size) {
							$options = array('data-src' => $this->Bl->imageUrl($image['img_id'], $breakpoint));
							if ($size) $options['data-min-width'] = $size;
							echo $this->Bl->div($options, null);
						}
						echo $this->Bl->snoscript(array(), array());
							echo $this->Bl->img(array('alt' => $image['title']),array('id' => $image['id'], 'version' => 'xsmall'));
						echo $this->Bl->enoscript();
					echo $this->Bl->ediv();
				echo $this->Bl->eli();
			}
		echo $this->Bl->eul();
		echo $this->Bl->div(array('class' => 'gamma-overlay'), array());
	echo $this->Bl->ediv();

echo $this->Bl->erow();
