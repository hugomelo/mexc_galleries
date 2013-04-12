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

class MexcImage extends MexcGalleriesAppModel
{
	var $name = 'MexcImage';
	
	var $actsAs = array(
		'Containable',
		'JjMedia.StoredFileHolder' => array('img_id'),
		'JjUtils.Ordered' => array(
			'field' => 'order',
			'foreign_key' => 'mexc_gallery_id'
		)
	);
	
	var $belongsTo = array(
		'MexcGallery' => array(
			'className' => 'MexcGalleries.MexcGallery',
			'counterCache' => true
		)
	);
	
	var $validate = array(
		'img_id' => array(
			'rule' => 'notEmpty',
			'required' => true
		),
		'title' => array(
			'rule' => array('maxLength', 250),
			'allowEmpty' => true,
			'required' => true
		)
	);
}
