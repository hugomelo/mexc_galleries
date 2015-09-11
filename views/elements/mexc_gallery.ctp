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

switch ($type[0])
{
	case 'buro':
		if ($type[1] == 'form')
			echo $this->element('mexc_gallery_form', array('plugin' => 'mexc_galleries'));
	break;
	
	case 'preview':
		switch ($type[1])
		{
			case 'box':
			case 'unified_search':
				if (isset($data['MexcGallery'])) {
					$item = $data['MexcGallery'];
					$url = array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'read', $item['id']);
					$id = $item['id'];
				}
				else {
					$item = $data['SblSearchItem'];
					$url = array('plugin' => 'mexc_gallerys', 'controller' => 'mexc_gallerys', 'action' => 'read', $item['foreign_id']);
					$id = $item['foreign_id'];
				}

				echo $this->Bl->h6(array('class' => 'post-type'), array(), 'Galeria');

				if (!empty($data['MexcSpace']['FactSite'][0]['name'])) {
					echo $this->Bl->anchor(array(), array('url' => '/programas/'.$data['MexcSpace']['id']),
						$this->Bl->div(array('class' => 'project'), array(), $data['MexcSpace']['FactSite'][0]['name']));
				}

				echo $this->Bl->div(array('class' => 'post-date'), array(), date('d/m/Y',strtotime($item['date'])));
				echo $this->Bl->anchor(array(), array('url' => $url),
					$this->Bl->h5(array('class' => 'title'), array(), $item['title']));

				$mexcGallery = ClassRegistry::init('MexcGalleries.MexcGallery');
				$gallery = $mexcGallery->find('first', array(
					'contain' => array('MexcImage'),
					'conditions' => array('MexcGallery.id' => $id)
				));
				echo $this->Bl->anchor(array(), array('url' => $url),
					$this->Jodel->insertModule('MexcGalleries.MexcImage', array('preview_mini_column'), array('MexcImage' => $gallery['MexcImage'][0])));
			break;
		}
	break;

	case 'column':
	break;
}
