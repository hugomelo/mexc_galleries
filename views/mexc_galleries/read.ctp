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

echo $this->Bl->sbox(array(), array('size' => array('M' => 9, 'g' => -1), 'type' => 'cloud'));

	echo $this->Jodel->insertModule('MexcGalleries.MexcGallery', array('full'), $gallery);
	
	echo $this->Bl->hr(array('class' => 'double'));
	
	// @todo Thread of comments.
	
echo $this->Bl->ebox();

echo $this->Bl->sbox(array('class' => 'more_content'), array('type' => 'sky', 'size' => array('M' => 3, 'g' => -1)));
	// @todo Link to the right place
	echo $this->Bl->anchor(
		array(), 
		array('url' => array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'index')),
		'Outras galerias da Rede'
	);
	
echo $this->Bl->ebox();

if (!empty($gallery['MexcRelatedContent']))
{
	echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 3)));
		echo $this->Bl->h2Dry(__d('mexc', 'veja também', true));
		echo $this->Jodel->insertModule('MexcRelated.MexcRelatedContent', array('full', 3), $gallery);
	echo $this->Bl->eboxContainer();
}
		//$url = $this->Html->url(array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'another_gallery'));
		//$this->BuroOfficeBoy->addHtmlEmbScript("new Mexc.GalleryRoller('gallery_cloud', '$url');");
		
