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
		switch ($type[1])
		{
			case 'form':
				echo $this->element('mexc_image_form', array('plugin' => 'mexc_galleries'));
			break;
			
			case 'view':
				echo $this->Bl->img(array(), array('id' => $data['MexcImage']['img_id'], 'version' => 'backstage_list'));
				if (!empty($data['MexcImage']['title']))
					echo $this->Bl->h4Dry($data['MexcImage']['title']);
				if (!empty($data['MexcImage']['subtitle']))
					echo $this->Bl->pDry($data['MexcImage']['subtitle']);
			break;
		}
	break;
	
	case 'preview_column':
	case 'preview_column_fact_site':
	case 'preview_mini_column':
	case 'mini_preview':
		echo $this->Bl->img(array(), array('id' => $data['MexcImage']['img_id'], 'version' => $type[0]));
	break;
	
	case 'gallery_thumb':
		echo $this->Bl->sanchor(array('class' => 'gallery_thumb'), array('url' => $this->Bl->imageURL($data['MexcImage']['img_id'])));
			if (!empty($type[1]))
				echo $this->Bl->spanDry($type[1]);
			
			echo $this->Bl->img(array(), array('id' => $data['MexcImage']['img_id'], 'version' => 'gallery_thumb'));
		echo $this->Bl->eanchor();
	break;
	
	case 'js' :
		switch ($type[1])
		{
			case 'gallery_full_tamplate':
				echo $this->Bl->sdiv(array('class' => 'image_holder'));
					echo $this->Bl->sanchor(array('class' => 'gallery_full_image'), array('url' => '#{img_url}'));
						echo $this->Bl->img(array('src' => '#{img_src}', 'alt' => ''));
					echo $this->Bl->eanchor();
				echo $this->Bl->ediv();
				
				echo $this->Bl->br();
				
				echo $this->Bl->sbox(array('class' => 'gallery_count'), array('size' => array('M' => 1)));
					echo $this->Bl->span(array('class' => 'current_count'), array(), '#{current}');
					echo $this->Bl->spanDry(' / ');
					echo $this->Bl->span(array('class' => 'total_count'), array(), '#{total}');
				echo $this->Bl->ebox();
				
				echo $this->Bl->sbox(array('class' => 'gallery_description'), array('size' => array('M' => 6, 'g' -1)));
					echo $this->Bl->h4Dry('#{title}');
					echo $this->Bl->pDry('#{subtitle}');
				echo $this->Bl->ebox();
				
			break;

			case 'json':
				extract($data['MexcImage']);
				$img_src = $this->Bl->imageURL($data['MexcImage']['img_id'], 'gallery_full');
				$img_url = $this->Bl->imageURL($data['MexcImage']['img_id']);
				echo $this->Js->object(compact('title', 'subtitle', 'img_src', 'img_url'));
			break;
		}
}
