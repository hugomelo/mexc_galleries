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
	
	$object = array();
	if (!empty($gallery))
	{
		$object['content'] = $this->Jodel->insertModule('MexcGalleries.MexcGallery', array('column'), $gallery);
		$object['id'] = $gallery['MexcGallery']['id'];
	}
	
	echo $this->Js->object($object);
