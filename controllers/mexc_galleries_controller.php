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

class MexcGalleriesController extends MexcGalleriesAppController
{
	var $name = 'MexcGalleries';
	var $uses = array('MexcGalleries.MexcGallery');
	var $paginate = array(
		'MexcGallery' => array(
			'limit' => 6,
			'contain' => array('MexcImage' => array('limit' => 4), 'Tag')
		)
	);
	
	
	function index()
	{
		$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace);
		$galleries = $this->paginate('MexcGallery', $conditions);
		$this->set(compact('galleries'));
	}
	
	function read($mexc_gallery_id = null)
	{
		if (empty($mexc_gallery_id))
			$this->cakeError('error404');
		
		$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace);
		$gallery = $this->MexcGallery->find('first', array(
			'contain' => array('MexcImage', 'Tag', 'MexcRelatedContent'),
			'conditions' => array('MexcGallery.id' => $mexc_gallery_id) + $conditions
		));
		
		if (empty($gallery))
			$this->cakeError('error404');
		
		$this->SectSectionHandler->addToPageTitleArray(array(null, null, $gallery['MexcGallery']['title']));
		
		$this->set(compact('gallery'));
	}
	
	function another_gallery()
	{
		$this->view = 'JjUtils.Json';
		
		$ids = array();
		if (!empty($this->data['ids']))
			$ids = explode('|', $this->data['ids']);
		
		$gallery = $this->MexcGallery->find('first', array(
			'contain' => array('MexcImage' => array('limit' => 1)),
			'conditions' => array(
				'not' => array('MexcGallery.id' => $ids)
			)
		));
		
		$this->set(compact('gallery'));
	}
}
