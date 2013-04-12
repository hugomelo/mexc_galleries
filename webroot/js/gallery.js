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
 
var MexcGallery = Class.create({
	initialize: function(base_id, template, images)
	{
		this.image_objects = [];
		this.images = images.map(function(total, image, index)
		{
			image.current = index+1;
			image.total = total;
			return image;
		}.bind(this, images.length));
		
		this.template = template;
		this.container = $(base_id);
		if (!this.container)
			return;
		
		this.current = false;
		this.total = this.images.length;
		
		this.thumbs = this.container.select('a.gallery_thumb');
		this.thumbs.invoke('observe', 'click', this.thumbClick.bindAsEventListener(this));
		
		this.popup = this.container.next('.gallery_popup');
		document.body.appendChild(this.popup);
		this.popup.hide().observe('click', function(ev){ev.stop();});
		
		this.imageContent = this.popup.down('.image_content');
		this.prevLink = this.popup.down('.left');
		this.prevLink.observe('click', this.previousPicture.bind(this));
		this.nextLink = this.popup.down('.right');
		this.nextLink.observe('click', this.nextPicture.bind(this));
		
		this.closePictureBinded = this.closePicture.bindAsEventListener(this);
		this.keyPressBinded = this.keyPress.bindAsEventListener(this);
	},
	addToLoadingQueue: function(img_src)
	{
	},
	keyPress: function(ev)
	{
		var code = ev.keyCode;
		switch (code)
		{
			case Event.KEY_ESC:
				ev.stop();
				this.closePicture();
			break;
			
			case Event.KEY_LEFT:
				this.previousPicture(ev);
			break;
			
			case Event.KEY_RIGHT:
				this.nextPicture(ev);
			break;
		}
	},
	thumbClick: function(ev)
	{
		ev.stop();
		var n = parseInt(ev.findElement('a').down('span').innerHTML)-1;
		this.openPicture(n);
	},
	openPicture: function(index)
	{
		this.veil = new Mexc.Veil(this.popup);
		document.observe('keypress', this.keyPressBinded);
		document.observe('click', this.closePictureBinded);
		this.popup.show().setStyle({
			'top': document.viewport.getScrollOffsets().top + 'px',
			'left': (document.viewport.getWidth()-this.popup.getWidth())/2+'px'
		});
		try {
		this.imageContent.down('img').hide();
		} catch(e){}
		this.update(index);
	},
	closePicture: function()
	{
		this.veil.destroy();
		this.veil = null;
		this.current = false;
		
		document.stopObserving('keypress', this.keyPressBinded);
		document.stopObserving('click', this.closePictureBinded);
		this.popup.hide();
	},
	nextPicture: function(ev)
	{
		if (this.current !== false)
			this.update((this.current+1)%this.total)
		ev.stop();
	},
	previousPicture: function(ev)
	{
		if (this.current !== false)
			this.update(!this.current?this.total-1:this.current-1);
		ev.stop();
	},
	update: function(index)
	{
		this.current = index;
		
		new Effect.Opacity(this.imageContent, {
			queue: 'end', duration: 0.3, from: 1, to: 0,
			afterFinish: function(index) {
				this.imageContent.show().update(this.template.interpolate(this.images[index]));
			}.bind(this, index)
		});
		new Effect.Appear(this.imageContent, {
			queue: 'end', duration: 0.3, from: 0, to: 1
		});
	}
});

