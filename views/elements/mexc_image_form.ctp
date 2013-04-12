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

echo $this->Buro->sform(
		array(),
		array(
			'model' => 'MexcGalleries.MexcImage'
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'id',
			'type' => 'hidden'
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'title',
			'label' => __d('mexc_image', 'form - title label', true),
			'instructions' => __d('mexc_image', 'form - title instructions', true)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'subtitle',
			'type' => 'textarea',
			'label' => __d('mexc_image', 'form - subtitle label', true),
			'instructions' => __d('mexc_image', 'form - subtitle instructions', true)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'img_id',
			'type' => 'image',
			'options' => array(
				'version' => 'backstage_preview'
			),
			'label' => __d('mexc_image', 'form - img_id (upload) label', true),
			'instructions' => __d('mexc_image', 'form - img_id (upload) instructions', true)
		)
	);
	
	echo $this->Buro->submit(
		array(),
		array(
			'label' => __d('mexc_image', 'save button label', true),
			'cancel' => array(
				'label' => __d('mexc_image', 'cancel link label', true)
			)
		)
	);
	
echo $this->Buro->eform();
