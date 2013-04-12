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

class MexcGallery extends MexcGalleriesAppModel
{
	var $name = 'MexcGallery';
	
	var $order = array('MexcGallery.date' => 'desc', 'MexcGallery.created' => 'desc');
	
	var $actsAs = array(
		'Containable', 
		'Dashboard.DashDashboardable',
		'Tags.Taggable',
		'Status.Status' => array('publishing_status', 'display_level'),
		'MexcRelated.MexcHasRelatedContent' => array(
			'MexcDocuments.MexcDocument',
			'MexcGalleries.MexcGallery',
			'MexcEvents.MexcEvent',
			'MexcNews.MexcNew'
		)
	);
	
	var $belongsTo = array(
		'MexcSpace.MexcSpace',
		'MexcEvents.MexcEvent'
	);
	
	var $hasMany = array(
		'MexcImage' => array(
			'className' => 'MexcGalleries.MexcImage',
			'order' => 'MexcImage.order',
			'dependent' => true
		)
	);
	
	var $validate = array(
		'description' => array(
			'maxLength' => array('rule' => array('maxLength', 400))
		)
	);

/**
 * Creates a blank row in the table. It is part of the backstage contract.
 *
 * @access public
 */
	function createEmpty()
	{
		$data = array();
		$data['MexcGallery']['publishing_status'] = 'draft';
		
		$this->create();
		return $this->save($data, false);
	}
	
/** 
 * The data that must be saved into the dashboard. Part of the Dashboard contract.
 *
 * @access public
 * @param string $id
 */
	function getDashboardInfo($id)
	{
		$this->contain();
		$data = $this->findById($id);
		
		if ($data == null)
			return null;
		
		$dashdata = array(
			'dashable_id' => $id,
			'mexc_space_id' => $data['MexcGallery']['mexc_space_id'],
			'dashable_model' => $this->name,
			'type' => 'gallery',
			'status' => $data['MexcGallery']['publishing_status'],
			'created' => $data['MexcGallery']['created'],
			'modified' => $data['MexcGallery']['modified'],
			'name' => $data['MexcGallery']['title'],
			'info' => $data['MexcGallery']['description'],
			'idiom' => array()
		);
		
		return $dashdata;
	}
	
	/** When data is deleted from the Dashboard. Part of the Dashboard contract.
	 *  @todo Maybe we should study how to do it from Backstage contract.
	 */
	
	function dashDelete($id)
	{
		return $this->delete($id);
	}
}
