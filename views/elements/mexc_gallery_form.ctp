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

	echo $this->Buro->sform(array(), array(
		'model' => $fullModelName,
		'callbacks' => array(
			'onStart' => array('lockForm', 'js' => 'form.setLoading()'),
			'onComplete' => array('unlockForm', 'js' => 'form.unsetLoading()'),
			'onReject' => array('js' => '$("content").scrollTo(); showPopup("error");', 'contentUpdate' => 'replace'),
			'onSave' => array('js' => '$("content").scrollTo(); showPopup("notice");'),
		)
	));
		echo $this->Buro->input(array(), array('fieldName' => 'id', 'type' => 'hidden'));
		
		// Mexc space 
		echo $this->Buro->input(
			array(),
			array(
				'type' => 'mexc_space'
			)
		);
		
		// Related event
		echo $this->Buro->input(
			array(),
			array(
				'type' => 'mexc_event'
			)
		);
		
		// Display Level
		echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'display_level',
				'type' => 'select',
				'label' => __d('mexc_gallery', 'form - display level label', true),
				'instructions' => __d('mexc_gallery', 'form - display level instructions', true),
				'options' => array('options' => array (
					'general' => 'Geral',
					'fact_site' => 'Só no espaço',
					'private' => 'Privado'
				))
			)
		);
		
		// Gallery name
		echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'title',
				'label' => __d('mexc_gallery', 'form - title label', true),
				'instructions' => __d('mexc_gallery', 'form - title instructions', true)
			)
		);
		
		// Gallery tags
		echo $this->Buro->input(array(), 
			array(
				'type' => 'tags',
				'fieldName' => 'tags',
				'label' => __d('mexc_gallery', 'form - tags input label', true),
				'instructions' => __d('mexc_gallery', 'form - tags input instructions', true),
				'options' => array(
					'type' => 'comma'
				)
			)
		);
		
		echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'date',
				'type' => 'datetime',
				'options' => array(
					'dateFormat' => 'DMY',
					'timeFormat' => false,
					'separator' => '',
					'minYear' => date('Y')-50,
					'maxYear' => date('Y')
				),
				'label' => __d('mexc_gallery', 'form - date label', true),
				'instructions' => __d('mexc_gallery', 'form - date instructions (important to cite future galleries)', true)
			)
		);
		
		echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'description',
				'type' => 'textarea',
				'label' => __d('mexc_gallery', 'form - description label', true),
				'instructions' => __d('mexc_gallery', 'form - description instructions', true),
				'error' => array(
					'maxLength' => __d('mexc_gallery', 'O texto não pode ultrapassar o limite de 400 caracteres.', true)
				)
			)
		);
		
		echo $this->Buro->input(
			array(),
			array(
				'type' => 'relational',
				'label' => __d('mexc_gallery', 'form - images (relational) label', true),
				'instructions' => __d('mexc_gallery', 'form - images (relational) instructions', true),
				'options' => array(
					'type' => 'many_children',
					'model' => 'MexcGalleries.MexcImage',
					'title' => __d('mexc_gallery', 'form - gallery image title', true)
				)
			)
		);
		
		// Related contents
		echo $this->Buro->inputMexcRelatedContent();
		
		echo $this->Buro->submitBox(array(),array('publishControls' => false));
	echo $this->Buro->eform();
