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
			case 'unified_search':
				$item = $data['SblSearchItem'];

				echo $this->Bl->h6(array('class' => 'post-type'), array(), 'Galeria');

				if (!empty($data['MexcSpace']['FactSite'][0]['name']))
					echo $this->Bl->div(array('class' => 'project'), array(), $data['MexcSpace']['FactSite'][0]['name']);

				echo $this->Bl->div(array('class' => 'post-date'), array(), date('d/m/Y',strtotime($item['date'])));
				echo $this->Bl->h5(array('class' => 'title'), array(), $item['title']);

				$mexcGallery = ClassRegistry::init('MexcGalleries.MexcGallery');
				$gallery = $mexcGallery->find('first', array(
					'contain' => array('MexcImage'),
					'conditions' => array('MexcGallery.id' => $data['SblSearchItem']['foreign_id'])
				));
				echo $this->Jodel->insertModule('MexcGalleries.MexcImage', array('preview_mini_column'), array('MexcImage' => $gallery['MexcImage'][0]));
			break;
		}
	break;

	case 'column':
		if (!isset($type[1]))
			$type[1] = false;
		
		switch ($type[1])
		{
			case 'related_content':
				echo $this->Jodel->insertModule('MexcGalleries.MexcGallery', array('mini_column'), $data);
			break;
		
			default:
				if ($data['MexcGallery']['mexc_space_id'] != $currentSpace)
					echo $this->Bl->mexcSpaceTag(array(), array('space_id' => $data['MexcGallery']['mexc_space_id']));
		
				echo $this->Bl->sh4();
					echo $this->Bl->anchor(
							array('class' => 'visitable'),
							array(
								'url' => array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'read', $data['MexcGallery']['id']),
								'space' => $data['MexcGallery']['mexc_space_id']
							),
							$data['MexcGallery']['title']
						);
				echo $this->Bl->eh4();
				echo '&ensp;';
				echo $this->Bl->spanDry(date('d/m', strtotime($data['MexcGallery']['date'])));
				if (isset($type[1]) && $type[1] == 'fact_site')
					echo $this->Jodel->insertModule('MexcGalleries.MexcImage', array('preview_column_fact_site'), array('MexcImage' => $data['MexcImage'][0]));
				else
					echo $this->Jodel->insertModule('MexcGalleries.MexcImage', array('preview_column'), array('MexcImage' => $data['MexcImage'][0]));
		
				echo $this->Bl->paraDry(explode("\n", $data['MexcGallery']['description']));
			break;
		}
	break;
	
	case 'column_gd':
		
		//echo $this->Jodel->insertModule('MexcGalleries.MexcImage', array('preview_column_fact_site'), array('MexcImage' => $data['MexcImage'][0]));
		echo $this->Jodel->insertModule('MexcGalleries.MexcImage', array('preview_mini_column'), array('MexcImage' => $data['MexcImage'][0]));
		
		echo $this->Bl->anchor(
			array('class' => 'visitable link_texto link_em_nuvem'),
			array(
				'url' => array('plugin' => 'grandedesafio', 'edicao' => $edicao['Edicao']['id'], 'controller' => 'fotos', 'action' => 'ver_galeria', $data['MexcGallery']['id'])
			),
			$data['MexcGallery']['title']
		);

		echo $this->Bl->paraDry(explode("\n", $data['MexcGallery']['description']));

	break;
	
	case 'mini_column':
		echo $this->Bl->spanDry(date('d/m', strtotime($data['MexcGallery']['date'])));
		echo $this->Bl->br();
		
		if ($currentSpace != $data['MexcGallery']['mexc_space_id'])
			echo $this->Bl->mexcSpaceTag(array(), array('space_id' => $data['MexcGallery']['mexc_space_id']));
		
		echo $this->Bl->sh4();
			echo $this->Bl->anchor(
					array('class' => 'visitable'),
					array(
						'url' => array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'read', $data['MexcGallery']['id']),
						'space' => $data['MexcGallery']['mexc_space_id']
					),
					$data['MexcGallery']['title']
				);
		echo $this->Bl->eh4();
		echo $this->Jodel->insertModule('MexcGalleries.MexcImage', array('preview_mini_column'), array('MexcImage' => $data['MexcImage'][0]));
		echo $this->Bl->paraDry(explode("\n", $data['MexcGallery']['description']));
	break;
	
	case 'column_full':
		echo  $this->Bl->sbox(array('class' => 'gallery_full_preview'), array('size' => array('M' => 4, 'g' => -1), 'type' => 'inner_column'));
			
			echo $this->Bl->span(array('class' => 'light'), array(), date('d/m/Y', strtotime($data['MexcGallery']['date'])));
			
			echo $this->Bl->br();
			
			if ($data['MexcGallery']['mexc_space_id'] != $currentSpace)
				echo $this->Bl->mexcSpaceTag(array(), array('space_id' => $data['MexcGallery']['mexc_space_id']));
			
			echo $this->Bl->anchor(
					array('class' => 'visitable'), 
					array(
						'url' => array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'read', $data['MexcGallery']['id']),
						'space' => $data['MexcGallery']['mexc_space_id']
					),
					$data['MexcGallery']['title']
				);
			
			foreach ($data['MexcImage'] as $cont => $image)
			{
				echo $this->Bl->sdiv(array('class' => ($cont+1) % 2 ? 'odd' : 'even'));
					echo $this->Jodel->insertModule('MexcGalleries.MexcImage', array('mini_preview'), array('MexcImage' => $image));
				echo $this->Bl->ediv();
			}
			
			if (!empty($data['Tag']))
				echo $this->Bl->tagList(array('class' => 'small'), array('tags' => $data['Tag'], 'before' => 'Palavras-chave'));
			
			echo $this->Bl->floatBreak();
		echo $this->Bl->ebox();
	break;
	
	case 'full':
		$dom_id = $this->uuid('gallery', $this->here);
		$images_data = array();
		echo $this->Bl->sdiv(array('id' => $dom_id, 'class' => 'gallery_container'));
			
			// Title, space and tag list
			$space_tag = '';
			if ($data['MexcGallery']['mexc_space_id'] != $currentSpace)
				$space_tag = $this->Bl->mexcSpaceTag(array(), array('space_id' => $data['MexcGallery']['mexc_space_id']));
			echo $this->Bl->h2Dry($data['MexcGallery']['title'] . $space_tag);
			
			if (isset($data['Tag']))
				echo $this->Bl->tagList(array(),array('tags' => $data['Tag']));
			
			echo $this->Bl->boxContainer(
				null, 
				array('size' => array('M' => 9, 'g' => -1, 'm' => -2)), 
				$this->Bl->hr()
			);
			
			
			// Description
			
			echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 4)));
				echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 4, 'g' => -1)));
					
					echo $this->Bl->paraDry(explode("\n", $data['MexcGallery']['description']));
					
					// Social medias
					echo $this->Bl->br();
					echo $this->element('social_medias', array('plugin' => false, 'module' => 'MexcGallery'));
					
				echo $this->Bl->eboxContainer();
			echo $this->Bl->eboxContainer();
			
			
			// Thumbnails
			
			foreach ($data['MexcImage'] as $k => $MexcImage)
			{
				echo $this->Jodel->insertModule('MexcGalleries.MexcImage', array('gallery_thumb', $k+1), compact('MexcImage'));
				$images_data[] = $this->Jodel->insertModule('MexcGalleries.MexcImage', array('js', 'json'), compact('MexcImage'));
			}
			
			echo $this->Bl->floatBreak();
		echo $this->Bl->ediv();
		
		
		// Popup template (for picture vizualization)
		echo $this->Bl->sbox(array('class' => 'gallery_popup'), array('type' => 'cloud', 'size' => array('M' => 11, 'g' => -1)));
			
			echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 1, 'm' => -1)));
				echo $this->Bl->anchor(array(), array('url' => '', 'type' => 'to_left'), $this->Bl->hiddenSpanDry('Anterior'));
			echo $this->Bl->eboxContainer();
			
			echo $this->Bl->sboxContainer(array('class' => 'image_content'), array('size' => array('M' => 9, 'g' => -1)));
			echo $this->Bl->eboxContainer();
			
			echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 1, 'm' => -1)));
				echo $this->Bl->anchor(array(), array('url' => '', 'type' => 'to_right'), $this->Bl->hiddenSpanDry('Próximo'));
			echo $this->Bl->eboxContainer();
			
		echo $this->Bl->ebox();
		
		
		$this->Html->script('/js/prototype.js', array('inline' => false));
		$this->Html->script('/js/effects.js', array('inline' => false));
		$this->Html->script('/mexc_galleries/js/gallery.js', array('inline' => false));
		
		$template = $this->Jodel->insertModule('MexcGalleries.MexcImage', array('js', 'gallery_full_tamplate'));
		$script = $this->Js->domReady(sprintf('new MexcGallery("%s", %s, [%s]);', $dom_id, $this->Js->object($template), implode(',', $images_data)));
		$this->Html->scriptBlock($script, array('defer' => true, 'inline' => false));
	break;
}
