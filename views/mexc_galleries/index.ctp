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

// @todo Search box

echo $this->Bl->sbox(array(), array('size' => array('M' => 12, 'g' => -1), 'type' => 'cloud'));
	
	echo $this->Bl->h2Dry('galerias de fotos');
	
	echo $this->element('pagination', array('top' => true));
	
	echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 12), 'type' => 'column_container'));
	
		$total_galleries = count($galleries);
		foreach ($galleries as $cont => $gallery)
		{
			echo $this->Jodel->insertModule('MexcGalleries.MexcGallery', array('column_full'), $gallery);
			
			if (($cont+1) % 3 == 0)
			{
				echo $this->Bl->floatBreak();
				if ($cont+1 < $total_galleries)
					echo  $this->Bl->box(
							array(), 
							array('size' => array('M' => 12, 'g' => -1), 'type' => 'inner_column'),
							$this->Bl->hr()
						);
			}
		}
		
		echo $this->Bl->floatBreak();
		echo $this->Bl->br();
	echo $this->Bl->eboxContainer();
	
	echo $this->element('pagination');

echo $this->Bl->ebox();

echo $this->Bl->br();
